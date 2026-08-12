<?php
require_once __DIR__ . '/includes/db.php';

$featuredProducts = $pdo->query(
  'SELECT * FROM products ORDER BY is_popular DESC, id DESC LIMIT 3'
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
      content="Découvrez mon nouveau projet web !"
    />
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
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.1/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>

  <body>

  <?php include "includes/navbar.php";?>

    <section
      id="hero"
      class="hero d-flex align-items-center justify-content-center text-center"
    >
      <div class="hero-overlay"></div>
      <div class="container hero-content position-relative z-1 text-white">
        <h1 class="display-3 mb-3 fw-bold serif">
          L'Art de Célébrer vos Moments Uniques
        </h1>
        <p class="lead mb-4 fs-4">
          Scénographie d'exception & Tenues de Prestige pour des souvenirs
          éternels.
        </p>
        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 hero-actions">
          <a href="#calculator" class="btn btn-gold px-4 py-2 text-uppercase fw-semibold w-100 w-sm-auto"
            >ESTIMER MON PROJET</a
          >
          <a
            href="#services"
            class="btn btn-outline-light px-4 py-2 text-uppercase fw-semibold w-100 w-sm-auto"
            >NOS SERVICES</a
          >
        </div>
      </div>
    </section>

    <section id="services" class="py-5 bg-white">
      <div class="container">
        <div class="text-center mb-5 section-title">
          <span
            class="text-gold d-block mb-2 text-uppercase fw-semibold"
            style="letter-spacing: 3px; font-size: 0.85rem"
            >Excellence & Raffinement</span
          >
          <h2 class="serif text-terracotta fs-2 fw-semibold">
            Nos Services Sur-Mesure
          </h2>
        </div>

        <div class="row g-4">
          <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="icon-wrapper mb-3">
                  <i class="ri-sparkling-line" aria-hidden="true"></i>
                </div>
                <h5 class="card-title">Mariages de Rêve</h5>
                <p class="card-text">
                  De la conception à la réalisation, nous créons des décors
                  somptueux qui racontent votre histoire d'amour.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="icon-wrapper mb-3">
                  <i class="ri-gift-line" aria-hidden="true"></i>
                </div>
                <h5 class="card-title">Baptêmes & Fêtes</h5>
                <p class="card-text">
                  Célébrez les nouveaux départs dans une ambiance douce,
                  élégante et parfaitement coordonnée.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="icon-wrapper mb-3">
                  <i class="ri-vip-crown-line" aria-hidden="true"></i>
                </div>
                <h5 class="card-title">Location de Prestige</h5>
                <p class="card-text">
                  Un catalogue exclusif de tenues traditionnelles sélectionnées
                  pour leur qualité et leur authenticité.
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-3">
            <div class="card h-100">
              <div class="card-body">
                <div class="icon-wrapper mb-3">
                  <i class="ri-camera-line" aria-hidden="true"></i>
                </div>
                <h5 class="card-title">Scénographie Photo</h5>
                <p class="card-text">
                  Des espaces dédiés (Photobooth, murs de fleurs) pour
                  immortaliser chaque sourire.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="position-relative mt-5 overflow-hidden rounded-4" style="height: 20rem">
          <img
            src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?auto=format&fit=crop&q=80&w=1200"
            alt="Decoration Detail"
            class="w-100 h-100 object-fit-cover"
          />
          <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(74, 44, 42, 0.45);"></div>

          <div
            class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white"
          >
            <div class="text-center p-4" style="max-width: 700px;">
              <h3 class="serif fst-italic mb-3 lh-base fs-3" style="color: var(--color-ivory);">
                "Le luxe n'est pas le contraire de la pauvreté, mais celui de la vulgarité."
              </h3>
              <p class="mb-0 text-gold text-uppercase fw-semibold" style="letter-spacing: 3px; font-size: 0.85rem;">Coco Chanel</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="calculator" class="py-5 bg-ivory">
      <div class="container">
        <div class="text-center mb-5 section-title">
          <span class="text-gold d-block mb-2 text-uppercase fw-semibold" style="letter-spacing: 3px; font-size: 0.85rem">Simulateur de Budget</span>
          <h2 class="serif text-terracotta fs-2 fw-semibold">Estimez Votre Projet</h2>
        </div>
        <div class="card w-100 shadow-sm border-0">
          <div class="card-body p-4 p-md-5">
            <form id="estimation-form">
              <div class="row g-5">
                <div class="col-sm-12 col-md-6">
                  <div class="mb-4">
                    <label class="form-label d-block text-terracotta fw-semibold mb-3">Type d'Événement</label>
                    <div class="d-flex flex-wrap gap-2" id="event-type-container">
                      <span class="text-muted small">Chargement des prestations…</span>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label d-block text-terracotta fw-semibold mb-3">Lieu de Réception</label>
                    <div class="d-flex flex-wrap gap-2" id="location-container">
                      <span class="text-muted small">Chargement des lieux…</span>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label for="guests-range" class="form-label d-block text-terracotta fw-semibold mb-2">
                      Nombre d'Invités : <span id="guests-count" class="text-gold fw-bold">100</span>
                    </label>
                    <input type="range" class="form-range w-100" min="10" max="500" value="100" id="guests-range">
                  </div>
                  <div class="mb-3">
                    <label class="form-label d-block text-terracotta fw-semibold mb-3">Options Additionnelles</label>
                    <div class="row g-2" id="options-container">
                      <span class="text-muted small">Chargement des options…</span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-between">
                  <div class="p-4 rounded-3 border d-flex flex-column justify-content-between h-100" style="background-color: rgba(74, 44, 42, 0.02); border-color: rgba(212, 175, 55, 0.25) !important;">
                    <div>
                      <h4 class="serif text-terracotta mb-4 fw-bold">Résumé de l'Estimation</h4>
                      <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                        <span class="text-secondary">Prestation</span>
                        <span id="summary-event" class="fw-semibold text-terracotta text-capitalize">Mariage</span>
                      </div>
                      <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                        <span class="text-secondary">Lieu de réception</span>
                        <span id="summary-location" class="fw-semibold text-terracotta text-capitalize">En plein air</span>
                      </div>
                      <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                        <span class="text-secondary">Nombre de convives</span>
                        <span id="summary-guests" class="fw-semibold text-terracotta">100 invités</span>
                      </div>
                      <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                        <span class="text-secondary">Options sélectionnées</span>
                        <span id="summary-options" class="fw-semibold text-terracotta text-end" style="font-size: 0.9rem;">Aucune</span>
                      </div>
                      <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                        <span class="fw-bold text-dark fs-5">Budget Estimé</span>
                        <span id="summary-total" class="fw-bold text-gold fs-3">900 000 FCFA</span>
                      </div>
                    </div>
                    
                    <button type="button" id="btn-whatsapp" class="btn btn-gold w-100 py-3 mt-4 text-uppercase fw-bold d-flex align-items-center justify-content-center gap-2">
                      <i class="ri-whatsapp-line fs-5" aria-hidden="true"></i>
                      <span class="whatsapp-button-label">Envoyer sur WhatsApp</span>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- PORTFOLIO SECTION -->
    <section id="portfolio" class="py-5 bg-white">
      <div class="container">
        <div class="text-center mb-5 section-title">
          <span class="text-gold d-block mb-2 text-uppercase fw-semibold" style="letter-spacing: 3px; font-size: 0.85rem">Galerie d'Inspirations</span>
          <h2 class="serif text-terracotta fs-2 fw-semibold">Nos Plus Belles Créations</h2>
        </div>
        <div class="row g-4">
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="portfolio-item position-relative overflow-hidden rounded-4 shadow-sm" style="height: 25rem;">
              <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=800" alt="Mariage Scénographie" class="w-100 h-100 object-fit-cover transition-transform duration-500">
              <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4 text-white" style="background: linear-gradient(to top, rgba(74, 44, 42, 0.9), transparent);">
                <span class="text-gold text-uppercase fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 2px;">Mariages</span>
                <h4 class="serif h5 mb-0">Le Château de Bellevue</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="portfolio-item position-relative overflow-hidden rounded-4 shadow-sm" style="height: 25rem;">
              <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&q=80&w=800" alt="Réception Or et Ivoire" class="w-100 h-100 object-fit-cover transition-transform duration-500">
              <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4 text-white" style="background: linear-gradient(to top, rgba(74, 44, 42, 0.9), transparent);">
                <span class="text-gold text-uppercase fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 2px;">Réceptions</span>
                <h4 class="serif h5 mb-0">Sous les Étoiles d'Ivoire</h4>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="portfolio-item position-relative overflow-hidden rounded-4 shadow-sm" style="height: 25rem;">
              <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&q=80&w=800" alt="Fête Florale" class="w-100 h-100 object-fit-cover transition-transform duration-500">
              <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4 text-white" style="background: linear-gradient(to top, rgba(74, 44, 42, 0.9), transparent);">
                <span class="text-gold text-uppercase fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 2px;">Scénographie</span>
                <h4 class="serif h5 mb-0">Jardin Enchanté de Roses</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- LOCATIONS SECTION -->
    <section id="locations" class="py-5 bg-ivory">
      <div class="container">
        <div class="text-center mb-5 section-title">
          <span class="text-gold d-block mb-2 text-uppercase fw-semibold" style="letter-spacing: 3px; font-size: 0.85rem">Tenues & Accessoires</span>
          <h2 class="serif text-terracotta fs-2 fw-semibold">Locations de Prestige</h2>
        </div>
        <div class="row g-4">
          <?php if (empty($featuredProducts)): ?>
            <p class="text-center text-muted mb-0">Aucun article n'est disponible pour le moment.</p>
          <?php else: ?>
            <?php foreach ($featuredProducts as $product): ?>
              <?php
                $price = (float) $product['rental_price'];
                if ($product['promo_percentage'] !== null) {
                  $price *= 1 - ((float) $product['promo_percentage'] / 100);
                }
                $image = $product['image_url'];
              ?>
              <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                  <div class="position-relative" style="height: 22rem;">
                    <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="w-100 h-100 object-fit-cover">
                    <span class="position-absolute top-0 end-0 bg-gold text-terracotta fw-bold px-3 py-1 m-3 rounded-pill" style="font-size: 0.85rem;"><?= number_format($price, 0, ',', ' ') ?> FCFA / jour</span>
                  </div>
                  <div class="card-body p-4 text-center">
                    <h5 class="card-title mb-2"><?= htmlspecialchars($product['title']) ?></h5>
                    <p class="card-text mb-3"><?= htmlspecialchars($product['description'] ?: 'Découvrez cet article de notre collection prestige.') ?></p>
                    <a href="tenues-accessoires.php" class="btn btn-gold w-100 py-2 text-uppercase fw-semibold btn-sm">Voir ce modèle</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <div class="text-center mt-5">
          <a href="tenues-accessoires.html" class="catalog-link text-terracotta text-decoration-none fw-semibold text-uppercase d-inline-flex align-items-center gap-2">
            Découvrir tout le catalogue Tenues & Accessoires
            <i class="ri-arrow-right-line text-gold" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-5 text-white" style="background-color: var(--color-terracotta); border-top: 3px solid var(--color-gold);">
      <div class="container">
        <div class="row g-4 justify-content-between">
          <div class="col-md-4">
            <h4 class="serif text-gold mb-3 fw-bold">FAITH DECOR</h4>
            <p style="color: var(--color-ivory); opacity: 0.8; font-size: 0.9rem;">
              Créateur de décors féeriques et prestataires de tenues d'exception pour sublimer les plus beaux jours de votre vie.
            </p>
          </div>
          <div class="col-md-3">
            <h5 class="text-gold mb-3 fw-bold text-uppercase" style="font-size: 0.9rem; letter-spacing: 2px;">Navigation</h5>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="#hero" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Accueil</a></li>
              <li class="mb-2"><a href="#services" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Nos Services</a></li>
              <li class="mb-2"><a href="#calculator" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Estimer un Projet</a></li>
              <li class="mb-2"><a href="#portfolio" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Notre Portfolio</a></li>
              <li class="mb-2"><a href="tenues-accessoires.html" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Tenues & Accessoires</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5 class="text-gold mb-3 fw-bold text-uppercase" style="font-size: 0.9rem; letter-spacing: 2px;">Contact</h5>
            <p class="mb-2" style="color: var(--color-ivory); opacity: 0.8; font-size: 0.9rem;">📍 Paris & Île-de-France, France</p>
            <p class="mb-2" style="color: var(--color-ivory); opacity: 0.8; font-size: 0.9rem;">📞 +33 6 00 00 00 00</p>
            <p class="mb-0" style="color: var(--color-ivory); opacity: 0.8; font-size: 0.9rem;">✉️ contact@faith-decor.fr</p>
          </div>
        </div>
        <hr class="my-4" style="background-color: var(--color-gold); opacity: 0.3;">
        <div class="d-flex justify-content-between align-items-center flex-wrap" style="color: var(--color-ivory); opacity: 0.7; font-size: 0.85rem;">
          <p class="mb-0">&copy; 2026 FAITH DECOR. Tous droits réservés.</p>
          <p class="mb-0">
            Créé avec raffinement par 
            <a href="https://emmanuel-bissa-portfolio.vercel.app/" target="_blank" rel="noopener noreferrer" class="creator-link">
              <span>Emmanuel Bissa</span>
              <i class="ri-arrow-right-up-line" aria-hidden="true"></i>
            </a>
          </p>
        </div>
      </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
  </body>
</html>
