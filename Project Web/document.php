<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ARC - Document Viewer</title>
  <link rel="icon" href="./Images/auroralogo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <link href="style.css" rel="stylesheet" />
  <meta name="description" content="Aurora Research Corporation - Documents">
  <meta name="keywords" content="aurora, research, corporation, roblox, paranormal, SCP">
  <meta name="author" content="YoloTrolo_">
  <meta property="og:title" content="ARC - Documents">
  <meta property="og:description" content="Lore searchmachine for the Aurora Research Corporation.">
  <meta property="og:image" content="https://auroracorporation.be/Images/auroralogo.png">
  <meta property="og:url" content="https://auroracorporation.be">
</head>

<body class="document-page">
    <header class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center logo-wrapper">
        <img src="Images/auroralogo.png" alt="Aurora Logo" class="logo-img" />
        <h1 class="mb-0">Aurora Research Corporation</h1>
      </div>

      <nav>
        <a href="./index.php">Home</a>
        <a href="index.php#features">Features</a>
        <a href="index.php#discord">
          <i class="fab fa-discord me-1"></i>Discord
        </a>
        <?php
          if (isset($_SESSION['gebruiker'])) {
            echo '<a href="logout.php">Logout <span class="user">from ' . htmlspecialchars($_SESSION['gebruiker']) . '</span></a>';
          } else {
            echo '<a href="login.php">Login</a>';
          }

          if (isset($_SESSION['gebruiker'])) {
            echo '<a href="upload.php">Upload</a>';
          }
        ?>
      </nav>
    </header>

    <div class="overlay"></div>
    <main class="doc-flex">

      <!-- Sidebar -->
      <aside class="doc-sidebar p-3">
        <input type="text" class="form-control mb-4" id="searchInput" placeholder="Search documents...">
        <ul class="nav flex-column" id="docList"></ul>
      </aside>

      <!-- PDF viewer -->
      <div id="pdfContainer" class="doc-main-content container py-5">
        <iframe id="pdfViewer" src="" style="width:100%; height:80vh; border:none;"></iframe>
      </div>
    </main>

  <footer>
    <p>&copy; 2025 Aurora Research Corporation. All rights reserved. YoloTrolo_</p>
  </footer>

  <script>
    function loadPDF(path) {
      document.getElementById('pdfViewer').src = path;
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="upload.js"></script>
</body>

</html>