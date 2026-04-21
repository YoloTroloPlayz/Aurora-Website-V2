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
</head>

<body class="document-page">
    <header class="container d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center logo-wrapper">
          <img src="images/aurora.png" alt="Aurora Logo" class="logo-img" />
          <h1 class="mb-0">Aurora Research Corporation</h1>
        </div>

        <nav>
          <a href="./index.php">Home</a>
          <a href="index.php#features">Features</a>
          <a href="index.php#discord">
            <i class="fab fa-discord me-1"></i>Discord
          </a>
          <?php
            session_start();
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

          <div class="popular-searches mb-3 text-center">
            <p class="text-white mb-2 fw-semibold">Some popular searches:</p>
          </div>

          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="document.html?id=doc-001" class="nav-link text-white">AID-001 Containment</a>
            </li>
            <li class="nav-item">
              <a href="document.html?id=doc-013" class="nav-link text-white">AID-013 IBDP</a>
            </li>
          </ul>
        </aside>


      <!-- Document content -->
      <div class="doc-main-content container py-5">
        <section class="mt-4">
          <h2 id="doc-title" class="mb-4">Loading...</h2>
          <div id="doc-content"></div>
        </section>
      </div>
    </main>


  <footer>
    <p>&copy; 2025 Aurora Research Corporation. All rights reserved. YoloTrolo_</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="jouw-script.js"></script>
</body>

</html>