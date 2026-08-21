<?php
// admin/estimations.php - View received client budget estimations
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/auth.php';
requireAdmin();

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
    if ($id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM project_estimations WHERE id = :id");
            $stmt->execute([':id' => $id]);
            header('Location: estimations.php?msg=' . urlencode('Estimation supprimée avec succès.'));
            exit;
        } catch (Throwable $e) {
            $error = "Erreur lors de la suppression : " . $e->getMessage();
        }
    }
}

// Fetch all estimations
try {
    $stmt = $pdo->query("SELECT * FROM project_estimations ORDER BY id DESC");
    $estimations = $stmt->fetchAll();
} catch (Throwable $e) {
    $error = "Erreur de chargement : " . $e->getMessage();
    $estimations = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estimations Reçues - FAITH DECOR</title>
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
                        <a class="nav-link" href="index.php">Catalogue des articles</a>
                        <a class="nav-link" href="add_product.php">Ajouter un article</a>
                        <a class="nav-link" href="categories.php">Gérer les catégories</a>
                        <a class="nav-link" href="estimation_settings.php">Configurer les estimations</a>
                        <a class="nav-link active" href="estimations.php">Estimations reçues</a>
                        <a class="nav-link" href="creations.php">Galerie d'Inspirations</a>
                        <hr class="my-2">
                        <a class="nav-link" href="../index.php" target="_blank">Voir le site</a>
                        <a class="nav-link text-danger" href="logout.php">Déconnexion</a>
                    </nav>
                </div>
            </aside>
            
            <main class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 serif text-terracotta mb-1">Estimations Reçues</h1>
                        <p class="text-muted mb-0">Historique des simulations de budget des clients</p>
                    </div>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger shadow-sm" role="alert">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['msg'])): ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-gold" role="alert">
                        <?= htmlspecialchars($_GET['msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                <?php endif; ?>

                <div class="card border-gold shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Date</th>
                                        <th>Événement</th>
                                        <th>Lieu</th>
                                        <th>Invités</th>
                                        <th>Options</th>
                                        <th>Budget Estimé</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($estimations)): ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                Aucune estimation enregistrée pour le moment.
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($estimations as $est): ?>
                                            <tr>
                                                <td class="ps-4 text-nowrap">
                                                    <?= date('d/m/Y H:i', strtotime($est['created_at'])); ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary text-uppercase"><?= htmlspecialchars($est['event_label']); ?></span>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($est['location_label']); ?>
                                                </td>
                                                <td>
                                                    <?= (int) $est['guest_count']; ?>
                                                </td>
                                                <td>
                                                    <small class="text-muted"><?= htmlspecialchars($est['options_selected'] ?: 'Aucune'); ?></small>
                                                </td>
                                                <td class="fw-bold text-gold">
                                                    <?= number_format((float) $est['total_price'], 0, ',', ' '); ?> FCFA
                                                </td>
                                                <td class="text-end pe-4">
                                                    <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette estimation ?');" style="display:inline;">
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?= $est['id']; ?>">
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
