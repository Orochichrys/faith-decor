<?php
require_once __DIR__ . '/includes/db.php';

$featuredProducts = $pdo->query(
  'SELECT * FROM products ORDER BY is_popular DESC, id DESC LIMIT 3'
)->fetchAll();

$creations = $pdo->query(
  'SELECT * FROM creations ORDER BY id DESC'
)->fetchAll();
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>faith-decor</title>
  <meta name="description" content="Site web créé avec CREATE MY SITE" />
  <meta name="author" content="CREATE MY SITE" />

  <meta property="og:title" content="faith-decor" />
  <meta
    property="og:description"
    content="Découvrez mon nouveau projet web !" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="assets/img/og-image.jpg" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="faith-decor" />

  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;500;600&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>

  <?php include "includes/navbar.php"; ?>

  <?php include "includes/sections/hero.php"; ?>

  <?php include "includes/sections/services.php"; ?>

  <?php include "includes/sections/calculator.php"; ?>

  <?php include "includes/sections/portfolio.php"; ?>



  <?php include "includes/footer.php"; ?>
  <?php include "includes/modal/creation-detail.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.js?v=<?= time(); ?>"></script>
  <script src="assets/js/creation-detail.js?v=<?= time(); ?>"></script>
</body>

</html>