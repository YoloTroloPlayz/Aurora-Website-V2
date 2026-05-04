<?php
session_start();

$fout = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = trim($_POST['gebruikersnaam'] ?? '');
    $wachtwoord = trim($_POST['wachtwoord'] ?? '');

    $conn = mysqli_connect("localhost", "root", "", "login_systeem");
    $stmt = mysqli_prepare($conn, "SELECT wachtwoord FROM gebruikers WHERE gebruikersnaam = ?");
    mysqli_stmt_bind_param($stmt, "s", $gebruikersnaam);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $wachtwoord_db);
    mysqli_stmt_fetch($stmt);

    if ($wachtwoord_db && password_verify($wachtwoord, $wachtwoord_db)) {
        $_SESSION['gebruiker'] = $gebruikersnaam;
        header("Location: index.php");
        exit();
    } else {
        $fout = "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARC – Login</title>
    <link rel="icon" href="./Images/auroralogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <header class="container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center logo-wrapper">
            <img src="Images/auroralogo.png" alt="Aurora Logo" class="logo-img" />
            <h1 class="mb-0">Aurora Research Corporation</h1>
        </div>
        <form class="d-flex" role="search" id="search-form">
            <input class="form-control" type="search" id="searchInput" placeholder="Search documents..." aria-label="Search">
            <ul id="searchResults" class="list-group position-absolute mt-5 w-50 z-3"></ul>
        </form>

    
        <nav>
        <a href="./index.php">Home</a>
        <a href="index.php#features">Features</a>
        <a href="./login.php">Login</a>
        <a href="index.php#discord">
        <i class="fab fa-discord me-1"></i>Discord
        </a>
        </nav>
    </header>

    <div class="login-wrapper">
        <div class="login-box">
            <h2>Login</h2>

            <?php if ($fout !== ""): ?>
                <div class="foutmelding"><?= htmlspecialchars($fout) ?></div>
            <?php endif; ?>

            <form method="post" action="login.php">
                <label for="gebruikersnaam">Username</label>
                <input type="text" id="gebruikersnaam" name="gebruikersnaam" placeholder="Your username" required autofocus>

                <label for="wachtwoord">Password</label>
                <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Your password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <footer>
    <p>&copy; 2025 Aurora Research Corporation. All rights reserved. YoloTrolo_</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="jouw-script.js"></script>
</body>
</html>