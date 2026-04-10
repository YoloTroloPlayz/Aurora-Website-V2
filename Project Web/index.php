<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Roblox Game Community</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="styles.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
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
    <a href="./mainARC.html">Home</a>
    <a href="index.html#features">Features</a>
    <a href="index.html#discord">
      <i class="fab fa-discord me-1"></i>Discord
    </a>
    </nav>
  </header>
  
  <main>
    <!-- Eerste container met "About the Game" -->
    <div class="container py-5">
      <section id="about">
        <h2>About the Game</h2>
        <p>The Aurora Research Corporation is an organization dedicated to the exploration and understanding of objects that defy all known laws of natural science. Funded by the British government and various scientific institutions, the corporation aligns itself intending to protect and better humanity.</p>
      </section>
    </div>
    
    <!-- Fullwidth banner buiten container -->
    <div class="fullwidth-banner">
      <div class="quote-overlay">
        <p>“If we knew what we are doing, it wouldn’t be called research.” - Albert Einstein </p>
      </div>
    </div>
    
    <!-- Tweede container met Features & Discord -->
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
      <a href="#" class="btn btn-outline-light mt-3">Join Now</a>
    </section>
  </div>
    
  <div class="fullwidth-banner">
    <div class="quote-overlay">
      <p>“Another quote for another day.” - Your mother</p>
    </div>
  </div>
    
</main>


  <footer>
    <p>&copy; 2025 Aurora Research Corporation. All rights reserved. YoloTrolo_</p>
  </footer>

</body>

</html>