<!-- LOCATIONS SECTION -->
<section id="locations" class="py-5 bg-ivory">
    <div class="container">
        <div class="text-center mb-5 section-title">
            <span class="text-gold d-block mb-2 text-uppercase fw-semibold"
                style="letter-spacing: 3px; font-size: 0.85rem">Tenues & Accessoires</span>
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
                                <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($product['title']) ?>"
                                    class="w-100 h-100 object-fit-cover">
                                <span
                                    class="position-absolute top-0 end-0 bg-gold text-terracotta fw-bold px-3 py-1 m-3 rounded-pill"
                                    style="font-size: 0.85rem;"><?= number_format($price, 0, ',', ' ') ?> FCFA / jour</span>
                            </div>
                            <div class="card-body p-4 text-center">
                                <h5 class="card-title mb-2"><?= htmlspecialchars($product['title']) ?></h5>
                                <p class="card-text mb-3">
                                    <?= htmlspecialchars($product['description'] ?: 'Découvrez cet article de notre collection prestige.') ?>
                                </p>
                                <a href="tenues-accessoires.php"
                                    class="btn btn-gold w-100 py-2 text-uppercase fw-semibold btn-sm">Voir ce modèle</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mt-5">
            <a href="tenues-accessoires.html"
                class="catalog-link text-terracotta text-decoration-none fw-semibold text-uppercase d-inline-flex align-items-center gap-2">
                Découvrir tout le catalogue Tenues & Accessoires
                <i class="ri-arrow-right-line text-gold" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>