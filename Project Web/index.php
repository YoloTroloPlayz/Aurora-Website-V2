<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ARC - Home</title>
  <link rel="icon" href="./Images/auroralogo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <link href="style.css" rel="stylesheet" />
  <?php
    session_start();
  ?>
</head>

<body>
  <header class="container d-flex align-items-center justify-content-between">
  <div class="d-flex align-items-center logo-wrapper">
    <img src="images/auroralogo.png" alt="Aurora Logo" class="logo-img" />
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
        echo '<a href="upload.php">Upload</a>';
      }
    ?>
    <a href="index.php#discord">
      <i class="fab fa-discord me-1"></i>Discord
    </a>
    </nav>
  </header>
  
  <main>
    <!-- eerste container -->
    <div class="container py-5">
      <section id="about">
        <h2>About the Game</h2>
        <p>The Aurora Research Corporation is an organization dedicated to the exploration and understanding of objects that defy all known laws of natural science. Funded by the British government and various scientific institutions, the corporation aligns itself intending to protect and better humanity.</p>
      </section>
    </div>
    
    <!-- achtergrond met quote -->
    <div class="fullwidth-banner" id="banner1">
      <div class="quote-overlay">
        <p>“If we knew what we are doing, it wouldn’t be called research.” - Albert Einstein </p>
      </div>
    </div>
    
    <!-- tweede container -->
    <div class="container py-5">
    <section id="features">
      <h2 class="mb-4">Why Aurora Research Corporation?</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card p-3">
            <h5>The paranormal</h5>
            <p>We were heavily inspired by the SCP foundation but we wanted to take a different approuch</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3">
            <h5>Community teams</h5>
            <p>Unlike other games where you unlock teams, here you will have to join them in the Discord, Bigger events are hosted and your team will be called for action!</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3">
            <h5>The cold war</h5>
            <p>The game is set in the cold war, which makes for a older look. In this way our game stands out even more.</p>
          </div>
        </div>
      </div>
    </section>

    <section id="discord" class="mt-5">
      <h2>Join our Discord</h2>
      <p>Stay up-to-date with the latest updates and join the community, events are hosted regulary.</p>
      <a class="btn btn-outline-light mt-3" id="discord-btn">Join Now</a>
    </section>
  </div>

  <div class="fullwidth-banner" id="banner2">
    <div class="quote-overlay">
      <p>“A community isn't souly a group of people, it should idealy be more of a family.” - YoloTrolo_</p>
    </div>
  </div>

  <!-- derde container -->
  <div class="container py-5">

    <section id="features" class="mt-5">
      <h2>Our documents</h2>
      <p>We keep our research information neatly sorted in documents. Redaction can occur when account does not have the required authorization level.</p>
      <a class="btn btn-outline-light mt-3" id="doc-btn">Go view documents</a>
    </section>

    <section id="features" class="mt-5">
      <h2>Have a look at the teams</h2>
      <p>In this research facility there are obviously departements with each their role. Best examples of these are the research departement tasked with studying found anomalies and testing. Security departement tasked with guarding the site or even the military police who keep the riots down and make sure the people follow the rules.</p>
      <a class="btn btn-outline-light mt-3">Go view teams</a>
    </section>
  </div>
    
  <div class="fullwidth-banner" id="banner3">
    <div class="quote-overlay">
      <p>“Somewhere, something incredible is waiting to be known” - Carl Sagan</p>
    </div>
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