<?php
// admin/index.php - Administration Dashboard for FAITH DECOR
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/auth.php';
requireAdmin();

// Fetch products
$productsStmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $productsStmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administration - FAITH DECOR</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { background-color: var(--color-ivory); }
        body { padding-top: 76px; }
        .admin-sidebar { background: #fff; border: 1px solid rgba(212, 175, 55, .35); border-radius: 12px; }
        .admin-sidebar .nav-link { color: var(--color-dark); border-radius: 8px; font-weight: 600; }
        .admin-sidebar .nav-link:hover, .admin-sidebar .nav-link.active { background: var(--color-terracotta); color: #fff; }
        @media (min-width: 992px) { .admin-sidebar { position: sticky; top: 96px; } }
        .badge-promo { background-color: #dc3545; color: white; font-weight: 600; }
        .img-preview-sm { width: 55px; height: 55px; object-fit: cover; border-radius: 8px; border: 1px solid var(--color-gold); }
    </style>
</head>
<body>

    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container justify-content-center">
            <a class="navbar-brand" href="../index.php">FAITH <span class="text-gold">DECOR</span></a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row g-4">
            <aside class="col-lg-3">
                <div class="admin-sidebar p-3">
                    <p class="text-uppercase text-muted small fw-bold mb-3">Espace administration</p>
                    <nav class="nav flex-column gap-2">
                        <a class="nav-link active" href="index.php">Catalogue des articles</a>
                        <a class="nav-link" href="add_product.php">Ajouter un article</a>
                        <a class="nav-link" href="categories.php">Gérer les catégories</a>
                        <a class="nav-link" href="estimation_settings.php">Configurer les estimations</a>
                        <a class="nav-link" href="estimations.php">Estimations reçues</a>
                        <a class="nav-link" href="creations.php">Galerie d'Inspirations</a>
                        <hr class="my-2">
                        <a class="nav-link" href="../index.php" target="_blank">Voir le site</a>
                        <a class="nav-link text-danger" href="logout.php">Déconnexion</a>
                    </nav>
                </div>
            </aside>
            <main class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div><h1 class="h3 serif text-terracotta mb-1">Catalogue des articles</h1><p class="text-muted mb-0">Gestion des tenues et accessoires</p></div>
                    <a href="add_product.php" class="btn btn-gold fw-bold">Ajouter un article</a>
                </div>
        
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-gold" role="alert">
                <?= htmlspecialchars($_GET['msg']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        <?php endif; ?>

            <!-- PRODUCTS PANEL -->
            <div>
                <div class="card border-gold shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Photo</th>
                                        <th>Titre / Modèle</th>
                                        <th>Catégorie</th>
                                        <th>Prix Location</th>
                                        <th>Promotion</th>
                                        <th>Popularité</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($products)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                Aucun article dans le catalogue. Cliquez sur "Ajouter un Article" pour commencer.
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($products as $p): ?>
                                            <tr>
                                                <td class="ps-4">
                                                    <img src="<?= htmlspecialchars($p['image_url']); ?>" alt="<?= htmlspecialchars($p['title']); ?>" class="img-preview-sm">
                                                </td>
                                                <td>
                                                    <strong class="text-terracotta d-block"><?= htmlspecialchars($p['title']); ?></strong>
                                                    <small class="text-muted text-truncate d-inline-block" style="max-width: 250px;">
                                                        <?= htmlspecialchars($p['description']); ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary"><?= htmlspecialchars($p['category_label']); ?></span>
                                                </td>
                                                <td>
                                                    <strong class="text-dark"><?= number_format($p['rental_price'], 0, ',', ' '); ?> FCFA</strong>
                                                </td>
                                                <td>
                                                    <?php if (!empty($p['promo_percentage'])): ?>
                                                        <span class="badge badge-promo">-<?= number_format($p['promo_percentage'], 0, ',', ' '); ?> %</span>
                                                    <?php else: ?>
                                                        <span class="text-muted fs-7">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($p['is_popular']): ?>
                                                        <span class="badge bg-gold text-terracotta fw-semibold">Vedette ★</span>
                                                    <?php else: ?>
                                                        <span class="text-muted fs-7">Standard</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="edit_product.php?id=<?= $p['id']; ?>" class="btn btn-outline-dark" title="Modifier">
                                                            Modifier
                                                        </a>
                                                        <a href="delete_product.php?id=<?= $p['id']; ?>" class="btn btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');" title="Supprimer">
                                                            Supprimer
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </main>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
