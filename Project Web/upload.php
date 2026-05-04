<?php
session_start();
if (!isset($_SESSION['gebruiker'])) {
    header("Location: login.php");
    exit();
}

//lokale map voor uploads
$uploadDir = "uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$conn = mysqli_connect("localhost", "root", "", "login_systeem");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["files"])) {
    foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
        $originalName = $_FILES["files"]["name"][$key];
        $fileType = $_FILES["files"]["type"][$key];

        if ($fileType !== "application/pdf") continue;

        $name = uniqid() . ".pdf";
        $targetFile = $uploadDir . $name;

        if (move_uploaded_file($tmp_name, $targetFile)) {
            $stmt = $conn->prepare("INSERT INTO files (filename, path) VALUES (?, ?)");
            $stmt->bind_param("ss", $originalName, $targetFile);
            $stmt->execute();
        }
    }
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARC – Upload</title>
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
            <?php
            if (isset($_SESSION['gebruiker'])) {
                echo '<a href="logout.php">Logout <span class="user">from ' . htmlspecialchars($_SESSION['gebruiker']) . '</span></a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }

            if (isset($_SESSION['gebruiker'])) {
                echo '<a href="upload.php">Upload documents</a>';
            }
            ?>
            <a href="index.php#discord">
            <i class="fab fa-discord me-1"></i>Discord
            </a>
        </nav>
    </header>

    <div class="login-wrapper">
        <div class="login-box">

        <h2>Upload files</h2>

        <div id="dropZone">
            <p>Drag files here or</p>
            <button id="selectBtn">Select files</button>
        </div>

        <input type="file" id="fileInput" multiple hidden>

        <div id="fileList"></div>

        <p> Only PDF-files allowed </p>

        <button id="uploadBtn">Upload</button>

        <div id="status"></div>

        </div>
    </div>

    <script src="upload.js"></script>

  <footer>
    <p>&copy; 2025 Aurora Research Corporation. All rights reserved. YoloTrolo_</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="jouw-script.js"></script>
</body>
</html>