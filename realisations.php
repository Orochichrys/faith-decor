<?php
require_once __DIR__ . '/includes/db.php';

// Fetch all creations
$stmt = $pdo->query("SELECT * FROM creations ORDER BY id DESC");
$creations = $stmt->fetchAll();

// Get unique categories for dynamic filters
$categories = [];
foreach ($creations as $c) {
    if (!empty($c['category'])) {
        $categories[] = trim($c['category']);
    }
}
$categories = array_unique($categories);
sort($categories);
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Nos Réalisations - FAITH DECOR</title>
    <meta name="description" content="Découvrez la galerie de nos plus belles créations, événements organisés et scénographies d'exception chez FAITH DECOR." />
    <meta name="author" content="CREATE MY SITE" />

    <meta property="og:title" content="Nos Réalisations - FAITH DECOR" />
    <meta property="og:description" content="Découvrez nos scénographies, événements d'exception et mariages élégants." />
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
    <?php include "includes/navbar.php"; ?>

    <!-- HERO CATALOG SECTION -->
    <section class="hero-realisations d-flex align-items-center justify-content-center text-center">
      <div class="hero-overlay"></div>
      <div class="container position-relative z-1 text-white py-5">
        <span class="text-gold text-uppercase fw-semibold mb-2 d-block" style="letter-spacing: 3px; font-size: 0.9rem;">
          Galerie d'Inspirations
        </span>
        <h1 class="display-4 fw-bold serif mb-3 text-white">
          Nos Plus Belles Créations
        </h1>
        <p class="lead fs-5 text-gold max-w-700 mx-auto" style="max-width: 650px;">
          Plongez au cœur de nos réalisations d'exception. Mariages de rêve, réceptions privées et scénographies sur-mesure conçues avec passion.
        </p>
      </div>
    </section>

    <!-- GALLERY SECTION -->
    <section class="py-5 bg-ivory">
      <div class="container">
        
        <!-- FILTER CONTROLS -->
        <div class="bg-white p-4 rounded-4 shadow-sm border border-gold mb-5">
          <div class="row g-3 align-items-center mb-4">
            <div class="col-md-6">
              <div class="position-relative">
                <input
                  type="text"
                  id="search-input"
                  class="form-control search-box"
                  placeholder="Rechercher un événement, un thème, un lieu..."
                />
              </div>
            </div>
          </div>

          <!-- CATEGORY BADGES -->
          <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start" id="category-filters">
            <button class="btn filter-badge rounded-pill px-4 py-2 active" data-category="all">
              Tous nos événements
            </button>
            <?php foreach ($categories as $cat): ?>
              <button class="btn filter-badge rounded-pill px-4 py-2" data-category="<?= htmlspecialchars($cat); ?>">
                <?= htmlspecialchars($cat); ?>
              </button>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- COUNTER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="serif text-terracotta fs-4 mb-0 fw-bold">Découvrez nos créations</h3>
          <span id="creation-count" class="badge bg-terracotta text-gold fs-6 px-3 py-2 rounded-pill fw-semibold">
            <?= count($creations); ?> créations trouvées
          </span>
        </div>

        <!-- GRID -->
        <div class="row g-4" id="creations-grid">
          <?php if (empty($creations)): ?>
            <div class="col-12 text-center py-5">
              <p class="text-muted fs-5">Aucune création enregistrée pour le moment dans notre base de données.</p>
            </div>
          <?php else: ?>
            <?php foreach ($creations as $c): ?>
              <div class="col-sm-12 col-md-6 col-lg-4 creation-card" 
                   data-category="<?= htmlspecialchars($c['category']); ?>"
                   data-title="<?= htmlspecialchars(mb_strtolower($c['title'])); ?>"
                   data-desc="<?= htmlspecialchars(mb_strtolower($c['description'] ?: '')); ?>">
                <div class="portfolio-item position-relative overflow-hidden rounded-4 shadow-sm" style="height: 25rem;">
                  <img src="<?= htmlspecialchars($c['image_url']); ?>" alt="<?= htmlspecialchars($c['title']); ?>" class="w-100 h-100 object-fit-cover transition-transform duration-500">
                  <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4 text-white" style="background: linear-gradient(to top, rgba(74, 44, 42, 0.95), transparent);">
                    <span class="text-gold text-uppercase fw-semibold mb-1" style="font-size: 0.75rem; letter-spacing: 2px;">
                      <?= htmlspecialchars($c['category']); ?>
                    </span>
                    <h4 class="serif h5 mb-2"><?= htmlspecialchars($c['title']); ?></h4>
                    <?php if (!empty($c['description'])): ?>
                      <p class="small text-white-50 mb-2 text-truncate" style="max-width: 100%;"><?= htmlspecialchars($c['description']); ?></p>
                    <?php endif; ?>
                    <a href="#" class="text-gold text-decoration-none small mt-2 fw-semibold d-inline-flex align-items-center gap-1 view-creation-btn" 
                       data-bs-toggle="modal" data-bs-target="#creationDetailModal"
                       data-title="<?= htmlspecialchars($c['title']); ?>"
                       data-category="<?= htmlspecialchars($c['category']); ?>"
                       data-image="<?= htmlspecialchars($c['image_url']); ?>"
                       data-description="<?= htmlspecialchars($c['description'] ?: 'Aucune description disponible pour cette réalisation.'); ?>"
                       data-budget="<?= $c['budget'] ? number_format((float)$c['budget'], 0, ',', ' ') . ' FCFA' : 'Non spécifié'; ?>"
                       data-location="<?= htmlspecialchars($c['location'] ?: 'Non spécifié'); ?>"
                       data-guest-count="<?= $c['guest_count'] ? number_format((int)$c['guest_count']) . ' personnes' : 'Non spécifié'; ?>"
                       data-options="<?= htmlspecialchars($c['options_selected'] ?: 'Aucune option additionnelle'); ?>">
                      En savoir plus <i class="ri-arrow-right-line"></i>
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

      </div>
    </section>

    <!-- BANNER Return / contact -->
    <section class="py-5 bg-white border-top border-bottom border-gold">
      <div class="container text-center">
        <h3 class="serif text-terracotta mb-3">Envie d'un événement unique à votre image ?</h3>
        <p class="text-muted mb-4" style="max-width: 600px; margin: 0 auto;">
          Contactez-nous directement ou faites une estimation en ligne pour concevoir et budgétiser votre décoration de prestige.
        </p>
        <div class="d-flex justify-content-center gap-3">
          <a href="https://wa.me/+2250102797828?text=Bonjour%20FAITH%20DECOR,%20je%20souhaite%20en%20savoir%20plus%20sur%20vos%20prestations%20de%20d%C3%A9coration" target="_blank" class="btn btn-gold px-4 py-3 text-uppercase fw-bold">
            Nous Contacter sur WhatsApp
          </a>
          <a href="index.php#calculator" class="btn btn-outline-dark px-4 py-3 text-uppercase fw-semibold">
            Faire une estimation en ligne
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
              <li class="mb-2"><a href="index.php" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Accueil</a></li>
              <li class="mb-2"><a href="index.php#services" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Nos Services</a></li>
              <li class="mb-2"><a href="index.php#calculator" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Estimer un Projet</a></li>
              <li class="mb-2"><a href="index.php#portfolio" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Notre Portfolio</a></li>
              <li class="mb-2"><a href="realisations.php" class="text-decoration-none text-gold">Nos Réalisations</a></li>
              <li class="mb-2"><a href="tenues-accessoires.php" class="text-decoration-none" style="color: var(--color-ivory); opacity: 0.8;">Tenues & Accessoires</a></li>
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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const filterBadges = document.querySelectorAll('#category-filters .filter-badge');
        const cards = document.querySelectorAll('.creation-card');
        const countBadge = document.getElementById('creation-count');

        let currentCategory = 'all';
        let searchQuery = '';

        function filterCreations() {
          let visibleCount = 0;

          cards.forEach(card => {
            const category = card.getAttribute('data-category');
            const title = card.getAttribute('data-title');
            const desc = card.getAttribute('data-desc');

            const matchesCategory = (currentCategory === 'all' || category === currentCategory);
            const matchesSearch = (!searchQuery || title.includes(searchQuery) || desc.includes(searchQuery));

            if (matchesCategory && matchesSearch) {
              card.style.display = 'block';
              visibleCount++;
            } else {
              card.style.display = 'none';
            }
          });

          // Update count badge
          countBadge.textContent = `${visibleCount} création${visibleCount > 1 ? 's' : ''} trouvée${visibleCount > 1 ? 's' : ''}`;
        }

        // Search input event
        searchInput.addEventListener('input', function(e) {
          searchQuery = e.target.value.toLowerCase().trim();
          filterCreations();
        });

        // Category filter click event
        filterBadges.forEach(badge => {
          badge.addEventListener('click', function() {
            // Remove active class from all
            filterBadges.forEach(b => b.classList.remove('active'));
            // Add active class to this
            this.classList.add('active');

            currentCategory = this.getAttribute('data-category');
            filterCreations();
          });
        });
      });
    </script>
  <!-- CREATION DETAIL MODAL -->
  <div class="modal fade" id="creationDetailModal" tabindex="-1" aria-labelledby="creationModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title serif text-gold fw-bold" id="creationModalTitle">Détails de la Réalisation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row g-4 align-items-center">
            <div class="col-md-6">
              <div class="rounded-3 overflow-hidden shadow-sm" style="height: 350px;">
                <img id="creationModalImage" src="" alt="" class="w-100 h-100 object-fit-cover">
              </div>
            </div>
            <div class="col-md-6">
              <span id="creationModalCategory" class="badge bg-gold text-terracotta mb-2 px-3 py-1 rounded-pill uppercase fw-semibold"></span>
              <h4 id="creationModalTitleHeading" class="text-terracotta serif fw-bold mb-3 fs-3"></h4>
              <p id="creationModalDescription" class="text-dark mb-3"></p>

              <!-- Event Attributes (Budget, Lieu, Invités, Options) -->
              <div class="mb-4 p-3 rounded-3 bg-light border border-gold-subtle">
                <h6 class="serif text-terracotta fw-bold mb-3" style="font-size: 0.95rem; letter-spacing: 1px;">CARACTÉRISTIQUES DE L'ÉVÉNEMENT</h6>
                <div class="row g-2 text-dark" style="font-size: 0.9rem;">
                  <div class="col-6 fw-semibold">Budget Approximatif :</div>
                  <div class="col-6" id="creationModalBudget"></div>
                  
                  <div class="col-6 fw-semibold">Lieu de réalisation :</div>
                  <div class="col-6" id="creationModalLocation"></div>
                  
                  <div class="col-6 fw-semibold">Nombre d'invités :</div>
                  <div class="col-6" id="creationModalGuestCount"></div>

                  <div class="col-6 fw-semibold">Options incluses :</div>
                  <div class="col-6" id="creationModalOptions"></div>
                </div>
              </div>

              <a id="creationModalBtnWhatsApp" href="#" target="_blank" class="btn btn-gold w-100 py-3 text-uppercase fw-bold d-flex align-items-center justify-content-center gap-2">
                <i class="ri-whatsapp-line fs-5" aria-hidden="true"></i>
                Discuter de ce projet sur WhatsApp
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const creationModal = document.getElementById('creationDetailModal');
      if (creationModal) {
        creationModal.addEventListener('show.bs.modal', function(event) {
          const button = event.relatedTarget;
          const title = button.getAttribute('data-title');
          const category = button.getAttribute('data-category');
          const image = button.getAttribute('data-image');
          const description = button.getAttribute('data-description');
          const budget = button.getAttribute('data-budget');
          const location = button.getAttribute('data-location');
          const guestCount = button.getAttribute('data-guest-count');
          const options = button.getAttribute('data-options');

          document.getElementById('creationModalTitleHeading').textContent = title;
          document.getElementById('creationModalCategory').textContent = category;
          document.getElementById('creationModalImage').src = image;
          document.getElementById('creationModalImage').alt = title;
          document.getElementById('creationModalDescription').textContent = description;
          document.getElementById('creationModalBudget').textContent = budget;
          document.getElementById('creationModalLocation').textContent = location;
          document.getElementById('creationModalGuestCount').textContent = guestCount;
          document.getElementById('creationModalOptions').textContent = options;

          const whatsappUrl = "https://wa.me/+2250102797828?text=" + encodeURIComponent("Bonjour FAITH DECOR, je souhaiterais avoir plus d'informations concernant votre réalisation : " + title + " (" + category + ")");
          document.getElementById('creationModalBtnWhatsApp').href = whatsappUrl;
        });
      }
    });
  </script>
  </body>
</html>
