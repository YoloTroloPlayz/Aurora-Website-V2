<?php
  session_start();
  $conn = mysqli_connect("com-linweb644.srv.combell-ops.net", "ID497499_loginsysteem", "IkHaatLarpers1010", "ID497499_loginsysteem");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ARC - Teams</title>
  <link rel="icon" href="./Images/auroralogo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <link href="style.css" rel="stylesheet" />
  <link href="achtergronden.css" rel="stylesheet" />
  <meta name="description" content="Aurora Research Corporation - Teams page">
  <meta name="keywords" content="aurora, research, corporation, roblox, paranormal, SCP">
  <meta name="author" content="YoloTrolo_">
  <meta property="og:title" content="ARC - Teams">
  <meta property="og:description" content="Departementen of the Aurora Research Corporation.">
  <meta property="og:image" content="https://auroracorporation.be/Images/auroralogo.png">
  <meta property="og:url" content="https://auroracorporation.be">
</head>

<body>
  <header class="container d-flex align-items-center justify-content-between">
  <div class="d-flex align-items-center logo-wrapper">
    <img src="Images/auroralogo.png" alt="Aurora Logo" class="logo-img" />
    <h1 class="mb-0">Aurora Research Corporation</h1>
  </div>

  <form class="d-flex" role="search" id="search-form">
    <!--<input class="form-control" type="search" id="searchInput" placeholder="Search documents..." aria-label="Search">-->
    <form action="document.php" method="GET">
    <input class="form-control"
           type="search"
           id="searchInput"
           name="q"
           placeholder="Search documents..."
           aria-label="Search">
    </form>
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
        echo '<a href="upload.php">Upload</a>';
      }
    ?>
    <a href="index.php#discord">
      <i class="fab fa-discord me-1"></i>Discord
    </a>
    </nav>
  </header>
  
  <main>
    <!-- teamnaam 1 -->
    <div class="fullwidth-banner" id="banner4">
      <div class="quote-overlay">
        <p>Scientific Departement</p>
      </div>
    </div>
    <!-- eerste container -->
    <div class="container py-5">
      <section id="about">
        <p>The Aurora Research Corporation is an organization dedicated to the exploration and understanding of objects that defy all known laws of natural science. Funded by the British government and various scientific institutions, the corporation aligns itself intending to protect and better humanity.</p>
      </section>
    </div>
    
    <!-- teamnaam 2 -->
    <div class="fullwidth-banner" id="banner5">
      <div class="quote-overlay">
        <p>Security Departement</p>
      </div>
    </div>
    <!-- tweede container -->
    <div class="container py-5">
      <section id="about">
        <p>The Aurora Research Corporation is an organization dedicated to the exploration and understanding of objects that defy all known laws of natural science. Funded by the British government and various scientific institutions, the corporation aligns itself intending to protect and better humanity.</p>
      </section>
    </div>

    <!-- teamnaam 3 -->
    <div class="fullwidth-banner" id="banner6">
      <div class="quote-overlay">
        <p>Military Police</p>
      </div>
    </div>
    <!-- derde container -->
    <div class="container py-5">
      <section id="about">
        <p>The Aurora Research Corporation is an organization dedicated to the exploration and understanding of objects that defy all known laws of natural science. Funded by the British government and various scientific institutions, the corporation aligns itself intending to protect and better humanity.</p>
      </section>
    </div>

    <!-- teamnaam 4 -->
    <div class="fullwidth-banner" id="banner7">
      <div class="quote-overlay">
        <p>Engineering Department</p>
      </div>
    </div>
    <!-- vierde container -->
    <div class="container py-5">
      <section id="about">
        <p>The Aurora Research Corporation is an organization dedicated to the exploration and understanding of objects that defy all known laws of natural science. Funded by the British government and various scientific institutions, the corporation aligns itself intending to protect and better humanity.</p>
      </section>
    </div>

    <!-- teamnaam 5 -->
    <div class="fullwidth-banner" id="banner8">
      <div class="quote-overlay">
        <p>Ethics Committee</p>
      </div>
    </div>
    <!-- vijfde container -->
    <div class="container py-5">
      <section id="about">
        <p>The Aurora Research Corporation is an organization dedicated to the exploration and understanding of objects that defy all known laws of natural science. Funded by the British government and various scientific institutions, the corporation aligns itself intending to protect and better humanity.</p>
      </section>
    </div>

<?php
$departementen = [
    "Scientific Departement",
    "Security Departement",
    "Military Police",
    "Engineering Department",
    "Ethics Committee"
];

// Comment opslaan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['gebruiker'])) {
    $tekst = trim($_POST['tekst']);
    $dep = $_POST['comment_dep'];
    if (in_array($dep, $departementen)) { // validatie
        $gebruiker = $_SESSION['gebruiker'];
        $stmt = mysqli_prepare($conn, "INSERT INTO comments (gebruiker, departement, tekst) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $gebruiker, $dep, $tekst);
        mysqli_stmt_execute($stmt);
    }
}

// Alle comments ophalen
$result = mysqli_query($conn, "SELECT gebruiker, departement, tekst, datum FROM comments ORDER BY datum DESC");
?>

<!-- Onderaan de pagina, voor de footer -->
<div class="container py-5">
    <h3>Comments</h3>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="comment-box">
            <strong><?= htmlspecialchars($row['gebruiker']) ?></strong>
            <span class="comment-dept"><?= htmlspecialchars($row['departement']) ?></span>
            <span class="comment-date"><?= $row['datum'] ?></span>
            <p><?= htmlspecialchars($row['tekst']) ?></p>
        </div>
    <?php endwhile; ?>

    <?php if (isset($_SESSION['gebruiker'])): ?>
        <form method="POST" class="mt-4">
            <label>Departement:</label>
            <select name="comment_dep">
                <?php foreach ($departementen as $d): ?>
                    <option value="<?= $d ?>"><?= $d ?></option>
                <?php endforeach; ?>
            </select>
            <textarea name="tekst" placeholder="Schrijf een comment..." required></textarea>
            <button type="submit">Plaatsen</button>
        </form>
    <?php endif; ?>
</div>
    
    
</main>


  <footer>
    <p>&copy; 2025 Aurora Research Corporation. All rights reserved. YoloTrolo_</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="script.js"></script>
</body>

</html>