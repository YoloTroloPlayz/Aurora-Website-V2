<?php
    // Deze code maakt een (REST) Web API. Ze kan gebruikt worden om een 'Voltage'-waarde te bewaren 
    // in een MySQL-database (POST), maar ook om de historische gegevens in die database terug op te vragen (GET).
    //
    // Om een geldig verzoek te doen, moet een API-key meegegeven worden in de HTTP-headers. Daarvoor
    // wordt volgende header gebruikt: "X-Api-Key". Daarin moet de waarde "webapi123" zitten...
    //
    // Deze Web API antwoordt steeds met JSON en gebruikt zinvolle 'HTTP response status codes'.
    //
    // De API testen kan via: Postman, PHP, JavaScript, C#, Python, ...

    // Database gegevens.
    define("DATABASE_NAME", "website");
    define("DATABASE_TABLE_NAME", "api");
    define("DATABASE_USER", "root");
    define("DATABASE_PWD", "");

    // Absoluut maximum aantal samples dat opgevraagd mag worden uit de database.
    define("MAXIMUM_NUMBER_OF_QUERYABLE_SAMPLES", 100);

    // Gebruikte API-key.
    define("API_KEY", "webapi123");

    // Tijdelijk foutmeldingen uitzetten zodat de output enkel de eigen JSON teruggeeft (en geen HTML met extra info).
    ini_set('display_errors', '0');

    try
    {
        // API-key correct? Zoek hem op in de HTTP-headers.
        if(isset($_SERVER["HTTP_X_API_KEY"]) && ($_SERVER["HTTP_X_API_KEY"] == API_KEY))
        {
            // Ben je aangekomen met een POST-request? Dan kan je nieuwe gegevens opslaan in de database.
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                // JSON-data ophalen.
                $input = file_get_contents('php://input');

                // Zet JSON om naar een associatief PHP-array.
                $postData = json_decode($input, true);

                // MySQL-verbinding leggen.
                $mysqli = new mysqli("localhost", DATABASE_USER, DATABASE_PWD, DATABASE_NAME);

                // Records toevoegen.
                $result = $mysqli->query("INSERT INTO ".DATABASE_TABLE_NAME .
                    " (Voltage) VALUES (".$mysqli->real_escape_string($postData["Voltage"]).")");

                // Is er een resultaat...? Gebruik daarbij een informerende 'HTTP response status code'.
                if($result)
                    RespondWithJSONMessage(201, "Data saved in MySQL-database.");
                else
                    RespondWithJSONMessage(422, "Unprocessable content.");
            }
            else
            {
                // GET-requests verwerken. Dit onderdeel kan gebruikt worden om de MySQL-data beschikbaar te stellen aan derden.
                if($_SERVER["REQUEST_METHOD"] == "GET")
                {
                    // Standaard object voorbereiden dat dan als JSON geantwoord wordt.
                    $data = new stdClass();
                    $data->tableName = DATABASE_TABLE_NAME;                        

                    // Data opzoeken in MySQL-database, maar eerst MySQL-verbinding leggen.
                    $mysqli = new mysqli("localhost", DATABASE_USER, DATABASE_PWD, DATABASE_NAME);                        

                    // Is de juiste GET-variabele meegegeven?
                    if(isset($_GET["numberOfDataPoints"]))
                    {
                        // Is de maximumvraag niet overschreden?
                        if($_GET["numberOfDataPoints"] <= MAXIMUM_NUMBER_OF_QUERYABLE_SAMPLES)
                            // Query opstellen met de gevraagde parameters.
                            $result = $mysqli->query("SELECT Voltage,TimeStamp FROM ".DATABASE_TABLE_NAME.
                                " ORDER BY TimeStamp DESC LIMIT ".$mysqli->real_escape_string($_GET["numberOfDataPoints"]));
                        else
                            RespondWithJSONMessage(400, "Maximum number of requested data points exceeded.");
                    }
                    else
                    {
                        // Minstens één GET-variabele die meegegeven werd, is ongeldig.
                        RespondWithJSONMessage(400, "GET-variable(s) invalid.");
                    }

                    // Aantal gevonden meetpunten opzoeken (optioneel).
                    $data->numberOfRecords = $result->num_rows;

                    // Alle gevonden meetpunten linken aan het PHP-object, dat straks omgezet wordt naar JSON.
                    // Sortering in SQL van nieuw naar oud gedaan, dus gewoon alle data ophalen.
                    // Indien nodig, kan je array_reverse() ook gebruiken...
                    $data->records = $result->fetch_all(MYSQLI_ASSOC);

                    // Het veld van het type float, nog omzetten van string naar float.
                    $data->records = array_map(function($record){
                            if(isset($record["Voltage"]))
                                $record["Voltage"] = (float)$record["Voltage"];

                            return $record;
                        },
                        $data->records
                    );

                    // Antwoorden met de gevonden data in JSON-formaat.
                    RespondWithJSONData($data);
                }
                else
                {
                    // Er werd geen GET of POST gebruikt tijdens het indienen van het verzoek...
                    // Dit zijn nochtans de enige toegelaten 'HTTP request methods' in deze Web API.
                    RespondWithJSONMessage(405, "Use correct HTTP request methods (GET or POST) to call this API.");
                }
            }
        }
        else
        {
            // De API-key is verkeerd of niet meegegeven.
            RespondWithJSONMessage(401, "Wrong API-key.");
        }
    }
    catch(Exception $ex)
    {
        // Algemene fouten opvangen.
        RespondWithJSONMessage(400, $ex->getMessage());
    }

    // Functie om te antwoorden met een bericht, verpakt in JSON.
    function RespondWithJSONMessage($httpResponseStatusCode, $message)
    {
        // Alle domeinen toelaten een verzoek te doen.
        header("Access-Control-Allow-Origin: *");

        // Content type van het antwoord instellen op JSON.
        header("Content-type: application/json; charset=utf-8");
        
        // HTTP response status code voorbereiden.
        http_response_code($httpResponseStatusCode);

        // Standaard object voorbereiden dat dan als JSON geantwoord wordt.
        $data = new stdClass();
        $data->message = $message;
        echo json_encode($data);

        // Code beëindigen.
        exit();
    }

    // Functie om te antwoorden met de gevonden data uit de database.
    // De data is verpakt in JSON-formaat.
    function RespondWithJSONData($data)
    {
        // Alle domeinen toelaten een verzoek te doen.
        header("Access-Control-Allow-Origin: *");

        // Content type van het antwoord instellen op JSON.
        header("Content-type: application/json; charset=utf-8");
        
        // HTTP response status code voorbereiden.
        http_response_code(200);

        // Standaard object als JSON antwoorden.
        echo json_encode($data);

        // Code beëindigen.
        exit();
    }
?>
