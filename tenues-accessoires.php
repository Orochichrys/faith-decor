<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Tenues & Accessoires de Prestige - FAITH DECOR</title>
    <meta name="description" content="Découvrez notre collection d'exception de tenues traditionnelles, robes de mariée, parures et accessoires en location chez FAITH DECOR." />
    <meta name="author" content="CREATE MY SITE" />

    <meta property="og:title" content="Tenues & Accessoires - FAITH DECOR" />
    <meta property="og:description" content="Catalogue complet des tenues de luxe et accessoires d'exception en location." />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="assets/img/og-image.jpg" />

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
    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.html"
          >FAITH <span class="text-gold">DECOR</span></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.html">ACCUEIL</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html#services">SERVICES</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html#calculator">CALCULATEUR</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html#portfolio">PORTFOLIO</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="tenues-accessoires.html">TENUES & ACCESSOIRES</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- HERO CATALOG SECTION -->
    <section class="hero-catalog d-flex align-items-center justify-content-center text-center">
      <div class="hero-overlay"></div>
      <div class="container position-relative z-1 text-white py-5">
        <span class="text-gold text-uppercase fw-semibold mb-2 d-block" style="letter-spacing: 3px; font-size: 0.9rem;">
          Collection d'Exception
        </span>
        <h1 class="display-4 fw-bold serif mb-3 text-white">
          Tenues & Accessoires de Prestige
        </h1>
        <p class="lead fs-5 text-gold max-w-700 mx-auto" style="max-width: 650px;">
          Sublimez vos événements les plus précieux avec notre sélection raffinée de tenues traditionnelles, bijoux et couronnes de cérémonie.
        </p>
      </div>
    </section>

    <!-- CATALOG SECTION -->
    <section class="py-5 bg-ivory">
      <div class="container">
        
        <!-- SEARCH & FILTERS CONTROLS -->
        <div class="bg-white p-4 rounded-4 shadow-sm border border-gold mb-5">
          <div class="row g-3 align-items-center mb-4">
            <div class="col-md-6">
              <div class="position-relative">
                <input
                  type="text"
                  id="search-input"
                  class="form-control search-box"
                  placeholder="Rechercher une tenue, un accessoire, une parure..."
                />
              </div>
            </div>
            <div class="col-md-3 ms-auto">
              <select id="sort-select" class="form-select search-box text-terracotta fw-medium">
                <option value="default">Trier par : Nouveautés</option>
                <option value="price-asc">Prix : Croissant</option>
                <option value="price-desc">Prix : Décroissant</option>
                <option value="popular">Articles Populaires</option>
              </select>
            </div>
          </div>

          <!-- CATEGORY BADGES -->
          <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start" id="category-filters">
            <button class="btn filter-badge rounded-pill px-4 py-2 active" data-category="all">
              Tous les articles
            </button>
            <button class="btn filter-badge rounded-pill px-4 py-2" data-category="tenues">
              Tenues & Robes
            </button>
            <button class="btn filter-badge rounded-pill px-4 py-2" data-category="bijoux">
              Bijoux & Parures
            </button>
            <button class="btn filter-badge rounded-pill px-4 py-2" data-category="accessoires">
              Accessoires & Couronnes
            </button>
            <button class="btn filter-badge rounded-pill px-4 py-2" data-category="hommes">
              Tenues Hommes
            </button>
          </div>
        </div>

        <!-- COUNTER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="serif text-terracotta fs-4 mb-0 fw-bold">Notre Catalogue Exclusif</h3>
          <span id="product-count" class="badge bg-terracotta text-gold fs-6 px-3 py-2 rounded-pill fw-semibold">
            12 articles trouvés
          </span>
        </div>

        <!-- PRODUCT GRID -->
        <div class="row" id="catalog-grid">
          <!-- Dynamically filled by catalog.js -->
        </div>

      </div>
    </section>

    <!-- BANNER RETURN / CONTACT -->
    <section class="py-5 bg-white border-top border-bottom border-gold">
      <div class="container text-center">
        <h3 class="serif text-terracotta mb-3">Besoin d'un essayage ou d'un conseil sur-mesure ?</h3>
        <p class="text-muted mb-4" style="max-width: 600px; margin: 0 auto;">
          Notre équipe vous accueille dans notre showroom sur rendez-vous pour essayer nos pièces et coordonner la scénographie de votre événement.
        </p>
        <div class="d-flex justify-content-center gap-3">
          <a href="https://wa.me/+2250102797828?text=Bonjour%20FAITH%20DECOR,%20je%20souhaite%20prendre%20rendez-vous%20pour%20un%20essayage" target="_blank" class="btn btn-gold px-4 py-3 text-uppercase fw-bold">
            Prendre Rendez-vous
          </a>
          <a href="index.html#calculator" class="btn btn-outline-dark px-4 py-3 text-uppercase fw-semibold">
            Simuler mon Budget Global
          </a>
        </div>
      </div>
    </section>

    <!-- PRODUCT DETAIL MODAL -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title serif text-gold fw-bold" id="productModalTitle">Détails de l'article</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
          </div>
          <div class="modal-body p-4">
            <div class="row g-4 align-items-center">
              <div class="col-md-6">
                <div class="rounded-3 overflow-hidden shadow-sm" style="height: 300px;">
                  <img id="productModalImage" src="" alt="" class="w-100 h-100 object-fit-cover">
                </div>
              </div>
              <div class="col-md-6">
                <span id="productModalCategory" class="badge bg-gold text-terracotta mb-2 px-3 py-1 rounded-pill uppercase fw-semibold"></span>
                <h4 id="productModalPrice" class="text-terracotta fw-bold mb-3 fs-3"></h4>
                <p id="productModalDescription" class="text-dark mb-3"></p>
                <div class="p-3 bg-light rounded-3 border mb-4">
                  <small class="text-muted d-block fw-bold mb-1">DÉTAILS & INCLUSIONS :</small>
                  <small id="productModalDetails" class="text-dark d-block"></small>
                </div>
                <button id="productModalBtnWhatsApp" type="button" class="btn btn-gold w-100 py-3 text-uppercase fw-bold d-flex align-items-center justify-content-center gap-2">
                  <i class="ri-whatsapp-line fs-5" aria-hidden="true"></i>
                  Réserver cet article sur WhatsApp
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
              <li class="mb-2"><a href="index.html" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Accueil</a></li>
              <li class="mb-2"><a href="index.html#services" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Nos Services</a></li>
              <li class="mb-2"><a href="index.html#calculator" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Estimer un Projet</a></li>
              <li class="mb-2"><a href="index.html#portfolio" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Notre Portfolio</a></li>
              <li class="mb-2"><a href="tenues-accessoires.html" class="text-decoration-none text-gold">Tenues & Accessoires</a></li>
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
    <script src="assets/js/catalog.js"></script>
  </body>
</html>
