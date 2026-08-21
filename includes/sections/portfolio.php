<!-- PORTFOLIO SECTION -->
<section id="portfolio" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5 section-title">
            <span class="text-gold d-block mb-2 text-uppercase fw-semibold"
                style="letter-spacing: 3px; font-size: 0.85rem">Galerie d'Inspirations</span>
            <h2 class="serif text-terracotta fs-2 fw-semibold">Nos Plus Belles Créations</h2>
        </div>
        <div class="row g-4">
            <?php if (empty($creations)): ?>
                <p class="text-center text-muted py-4">Aucune création dans la galerie pour le moment.</p>
            <?php else: ?>
                <?php foreach ($creations as $creation): ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="portfolio-item position-relative overflow-hidden rounded-4 shadow-sm"
                            style="height: 25rem;">
                            <img src="<?= htmlspecialchars($creation['image_url']); ?>"
                                alt="<?= htmlspecialchars($creation['title']); ?>"
                                class="w-100 h-100 object-fit-cover transition-transform duration-500">
                            <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-4 text-white"
                                style="background: linear-gradient(to top, rgba(74, 44, 42, 0.95), transparent);">
                                <span class="text-gold text-uppercase fw-semibold mb-1"
                                    style="font-size: 0.75rem; letter-spacing: 2px;"><?= htmlspecialchars($creation['category']); ?></span>
                                <h4 class="serif h5 mb-2"><?= htmlspecialchars($creation['title']); ?></h4>
                                <?php if (!empty($creation['description'])): ?>
                                    <p class="small text-white-50 mb-2 text-truncate" style="max-width: 100%;">
                                        <?= htmlspecialchars($creation['description']); ?></p>
                                <?php endif; ?>
                                <a href="#"
                                    class="text-gold text-decoration-none small mt-2 fw-semibold d-inline-flex align-items-center gap-1 view-creation-btn"
                                    data-bs-toggle="modal" data-bs-target="#creationDetailModal"
                                    data-title="<?= htmlspecialchars($creation['title']); ?>"
                                    data-category="<?= htmlspecialchars($creation['category']); ?>"
                                    data-image="<?= htmlspecialchars($creation['image_url']); ?>"
                                    data-description="<?= htmlspecialchars($creation['description'] ?: 'Aucune description disponible pour cette réalisation.'); ?>"
                                    data-budget="<?= $creation['budget'] ? number_format((float) $creation['budget'], 0, ',', ' ') . ' FCFA' : 'Non spécifié'; ?>"
                                    data-location="<?= htmlspecialchars($creation['location'] ?: 'Non spécifié'); ?>"
                                    data-guest-count="<?= $creation['guest_count'] ? number_format((int) $creation['guest_count']) . ' personnes' : 'Non spécifié'; ?>"
                                    data-options="<?= htmlspecialchars($creation['options_selected'] ?: 'Aucune option additionnelle'); ?>">
                                    En savoir plus <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="realisations.php"
                class="catalog-link text-terracotta text-decoration-none fw-semibold text-uppercase d-inline-flex align-items-center gap-2">
                Découvrir tous nos événements organisés
                <i class="ri-arrow-right-line text-gold" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>