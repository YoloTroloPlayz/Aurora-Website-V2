document.addEventListener("DOMContentLoaded", function(){
    document.querySelector("button").addEventListener("click", async function(){
        console.log("Fetching API-data...");

        let options = {
            headers: new Headers({"X-Api-Key":"webapi123"})
        }

        let response = await fetch("api.php?numberOfDataPoints=1", options);
        let data = await response.json();
        document.querySelector("#VoltageWrapper").innerHTML = data.records[0].Voltage + " V";
    });
});
