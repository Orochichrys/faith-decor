<?php
// admin/creations.php - Manage Portfolio / Galerie d'Inspirations
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/auth.php';
requireAdmin();

$msg = $_GET['msg'] ?? '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    try {
        if ($action === 'save') {
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            $title = trim($_POST['title'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $imageUrl = trim($_POST['image_url'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $budget = $_POST['budget'] !== '' ? (float)$_POST['budget'] : null;
            $location = trim($_POST['location'] ?? '') !== '' ? trim($_POST['location']) : null;
            $guestCount = $_POST['guest_count'] !== '' ? (int)$_POST['guest_count'] : null;
            
            $optionsArray = $_POST['options_selected'] ?? [];
            $optionsSelected = !empty($optionsArray) ? implode(', ', array_map('trim', $optionsArray)) : null;

            if ($title === '' || $category === '' || $imageUrl === '') {
                throw new RuntimeException('Le titre, la catégorie et l\'image sont obligatoires.');
            }

            if ($id) {
                // Update
                $stmt = $pdo->prepare("
                    UPDATE creations 
                    SET title = :title, category = :category, image_url = :image_url, description = :description, budget = :budget, location = :location, guest_count = :guest_count, options_selected = :options_selected 
                    WHERE id = :id
                ");
                $stmt->execute([
                    ':title' => $title,
                    ':category' => $category,
                    ':image_url' => $imageUrl,
                    ':description' => $description,
                    ':budget' => $budget,
                    ':location' => $location,
                    ':guest_count' => $guestCount,
                    ':options_selected' => $optionsSelected,
                    ':id' => $id
                ]);
                $msg = 'Création modifiée avec succès.';
            } else {
                // Insert
                $stmt = $pdo->prepare("
                    INSERT INTO creations (title, category, image_url, description, budget, location, guest_count, options_selected) 
                    VALUES (:title, :category, :image_url, :description, :budget, :location, :guest_count, :options_selected)
                ");
                $stmt->execute([
                    ':title' => $title,
                    ':category' => $category,
                    ':image_url' => $imageUrl,
                    ':description' => $description,
                    ':budget' => $budget,
                    ':location' => $location,
                    ':guest_count' => $guestCount,
                    ':options_selected' => $optionsSelected
                ]);
                $msg = 'Nouvelle création ajoutée avec succès.';
            }

            header('Location: creations.php?msg=' . urlencode($msg));
            exit;
        } elseif ($action === 'delete') {
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            if ($id) {
                $stmt = $pdo->prepare("DELETE FROM creations WHERE id = :id");
                $stmt->execute([':id' => $id]);
                header('Location: creations.php?msg=' . urlencode('Création supprimée avec succès.'));
                exit;
            }
        }
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }
}

// Fetch all creations
$stmt = $pdo->query("SELECT * FROM creations ORDER BY id DESC");
$creations = $stmt->fetchAll();

// Fetch estimation configuration items
$estimationItems = $pdo->query("SELECT * FROM estimation_items WHERE is_active = 1 ORDER BY item_type, sort_order ASC")->fetchAll();
$eventTypes = [];
$locations = [];
$optionsList = [];

foreach ($estimationItems as $item) {
    if ($item['item_type'] === 'event') {
        $eventTypes[] = $item['label'];
    } elseif ($item['item_type'] === 'location') {
        $locations[] = $item['label'];
    } elseif ($item['item_type'] === 'option') {
        $optionsList[] = $item['label'];
    }
}

// Fetch single creation if editing
$editItem = null;
if (isset($_GET['edit'])) {
    $editId = filter_var($_GET['edit'], FILTER_VALIDATE_INT);
    if ($editId) {
        $stmt = $pdo->prepare("SELECT * FROM creations WHERE id = :id");
        $stmt->execute([':id' => $editId]);
        $editItem = $stmt->fetch();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la Galerie - FAITH DECOR</title>
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
                        <a class="nav-link" href="index.php">Catalogue des articles</a>
                        <a class="nav-link" href="add_product.php">Ajouter un article</a>
                        <a class="nav-link" href="categories.php">Gérer les catégories</a>
                        <a class="nav-link" href="estimation_settings.php">Configurer les estimations</a>
                        <a class="nav-link" href="estimations.php">Estimations reçues</a>
                        <a class="nav-link active" href="creations.php">Galerie d'Inspirations</a>
                        <hr class="my-2">
                        <a class="nav-link" href="../index.php" target="_blank">Voir le site</a>
                        <a class="nav-link text-danger" href="logout.php">Déconnexion</a>
                    </nav>
                </div>
            </aside>
            
            <main class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 serif text-terracotta mb-1">Galerie d'Inspirations</h1>
                        <p class="text-muted mb-0">Gérez les plus belles créations présentées sur la page d'accueil</p>
                    </div>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger shadow-sm" role="alert">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($msg)): ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-gold" role="alert">
                        <?= htmlspecialchars($msg); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                    </div>
                <?php endif; ?>

                <!-- FORM PANEL -->
                <div class="card border-gold shadow-sm mb-4">
                    <div class="card-header bg-light py-3">
                        <h5 class="card-title mb-0 text-terracotta serif fw-bold">
                            <?= $editItem ? 'Modifier la création' : 'Ajouter une création' ?>
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST">
                            <input type="hidden" name="action" value="save">
                            <?php if ($editItem): ?>
                                <input type="hidden" name="id" value="<?= $editItem['id'] ?>">
                            <?php endif; ?>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Titre / Modèle</label>
                                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($editItem['title'] ?? '') ?>" placeholder="ex: Le Château de Bellevue" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Catégorie (Type d'événement)</label>
                                    <select name="category" class="form-select" required>
                                        <option value="">-- Sélectionner une catégorie --</option>
                                        <?php foreach ($eventTypes as $type): ?>
                                            <option value="<?= htmlspecialchars($type) ?>" <?= (isset($editItem['category']) && $editItem['category'] === $type) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($type) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">URL de l'image</label>
                                    <input type="url" name="image_url" class="form-control" value="<?= htmlspecialchars($editItem['image_url'] ?? '') ?>" placeholder="ex: https://images.unsplash.com/..." required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Coût estimé / Budget (FCFA)</label>
                                    <input type="number" name="budget" class="form-control" value="<?= htmlspecialchars($editItem['budget'] ?? '') ?>" placeholder="ex: 850000">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Lieu de réalisation</label>
                                    <select name="location" class="form-select">
                                        <option value="">-- Sélectionner un lieu --</option>
                                        <?php foreach ($locations as $loc): ?>
                                            <option value="<?= htmlspecialchars($loc) ?>" <?= (isset($editItem['location']) && $editItem['location'] === $loc) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($loc) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Nombre de personnes</label>
                                    <input type="number" name="guest_count" class="form-control" value="<?= htmlspecialchars($editItem['guest_count'] ?? '') ?>" placeholder="ex: 150">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold d-block">Options additionnelles incluses</label>
                                    <div class="row g-2 p-3 rounded-3 bg-light border">
                                        <?php if (empty($optionsList)): ?>
                                            <div class="col-12 text-muted small">Aucune option active configurée dans les paramètres d'estimation.</div>
                                        <?php else: ?>
                                            <?php 
                                            $selectedOptions = isset($editItem['options_selected']) ? array_map('trim', explode(',', $editItem['options_selected'])) : [];
                                            foreach ($optionsList as $opt): 
                                            ?>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="options_selected[]" value="<?= htmlspecialchars($opt) ?>" id="opt_<?= md5($opt) ?>" <?= in_array($opt, $selectedOptions) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="opt_<?= md5($opt) ?>">
                                                            <?= htmlspecialchars($opt) ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Description détaillée</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Description des fleurs, ornements, styles..."><?= htmlspecialchars($editItem['description'] ?? '') ?></textarea>
                                </div>
                                <div class="col-12 text-end">
                                    <?php if ($editItem): ?>
                                        <a href="creations.php" class="btn btn-outline-secondary me-2">Annuler</a>
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-gold fw-bold"><?= $editItem ? 'Enregistrer les modifications' : 'Ajouter à la Galerie' ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- LIST PANEL -->
                <div class="card border-gold shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Image</th>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Budget</th>
                                        <th>Lieu</th>
                                        <th>Invités</th>
                                        <th>Options</th>
                                        <th>Description</th>
                                        <th class="text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($creations)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                Aucune création dans la galerie. Ajoutez-en une ci-dessus.
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($creations as $c): ?>
                                            <tr>
                                                <td class="ps-4">
                                                    <img src="<?= htmlspecialchars($c['image_url']); ?>" alt="<?= htmlspecialchars($c['title']); ?>" class="img-preview-sm">
                                                </td>
                                                <td>
                                                    <strong class="text-terracotta d-block"><?= htmlspecialchars($c['title']); ?></strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary"><?= htmlspecialchars($c['category']); ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-success fw-bold"><?= $c['budget'] ? number_format((float)$c['budget'], 0, ',', ' ') . ' FCFA' : '-' ?></span>
                                                </td>
                                                <td>
                                                    <span><?= htmlspecialchars($c['location'] ?: '-') ?></span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark border"><?= $c['guest_count'] ? number_format((int)$c['guest_count']) . ' pers.' : '-' ?></span>
                                                </td>
                                                <td>
                                                    <small class="text-muted d-inline-block text-truncate" style="max-width: 150px;" title="<?= htmlspecialchars($c['options_selected'] ?? '') ?>">
                                                        <?= htmlspecialchars($c['options_selected'] ?: '-'); ?>
                                                    </small>
                                                </td>
                                                <td>
                                                    <small class="text-muted d-inline-block text-truncate" style="max-width: 150px;">
                                                        <?= htmlspecialchars($c['description'] ?: '-'); ?>
                                                    </small>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a href="creations.php?edit=<?= $c['id']; ?>" class="btn btn-outline-dark btn-sm me-1">Modifier</a>
                                                    <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette création ?');" style="display:inline;">
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?= $c['id']; ?>">
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
