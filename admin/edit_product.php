<?php
// admin/edit_product.php - Edit product form
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/auth.php';
requireAdmin();

$categories = $pdo->query('SELECT slug, name FROM categories WHERE is_active = 1 ORDER BY sort_order, name')->fetchAll();

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php?msg=' . urlencode("Article non trouvé"));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $rentalPrice = floatval($_POST['rental_price'] ?? 0);
    $promoPercentage = ($_POST['promo_percentage'] ?? '') !== '' ? floatval($_POST['promo_percentage']) : null;
    $description = trim($_POST['description'] ?? '');
    $details = trim($_POST['details'] ?? '');
    $isPopular = isset($_POST['is_popular']) ? 1 : 0;
    $imageUrl = $product['image_url'];

    // Handle File Upload or Image URL
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $uploadsDir = __DIR__ . '/../uploads';
        if (!file_exists($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        $fileTmpPath = $_FILES['image_file']['tmp_name'];
        $fileName = $_FILES['image_file']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $destPath = $uploadsDir . '/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $imageUrl = 'uploads/' . $newFileName;
            } else {
                $error = "Erreur lors du téléversement de l'image.";
            }
        }
    } elseif (!empty($_POST['image_url'])) {
        $imageUrl = trim($_POST['image_url']);
    }

    $categoryNames = array_column($categories, 'name', 'slug');
    if (empty($title) || !isset($categoryNames[$category]) || $rentalPrice <= 0 || empty($imageUrl) || ($promoPercentage !== null && ($promoPercentage <= 0 || $promoPercentage >= 100))) {
        if (empty($error)) {
            $error = "Veuillez remplir tous les champs obligatoires.";
        }
    } else {
        try {
            $updateStmt = $pdo->prepare("
                UPDATE products 
                SET title = :title, 
                    category = :category, 
                    category_label = :category_label, 
                    rental_price = :rental_price, 
                    promo_percentage = :promo_percentage, 
                    image_url = :image_url, 
                    description = :description, 
                    details = :details, 
                    is_popular = :is_popular
                WHERE id = :id
            ");

            $updateStmt->execute([
                ':title' => $title,
                ':category' => $category,
                ':category_label' => $categoryNames[$category],
                ':rental_price' => $rentalPrice,
                ':promo_percentage' => $promoPercentage,
                ':image_url' => $imageUrl,
                ':description' => $description,
                ':details' => $details,
                ':is_popular' => $isPopular,
                ':id' => $id
            ]);

            header('Location: index.php?msg=' . urlencode("Article '" . $title . "' mis à jour avec succès !"));
            exit;
        } catch (Exception $e) {
            $error = "Erreur SQL : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Article #<?= $product['id']; ?> - FAITH DECOR Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { background-color: var(--color-ivory); }
        .admin-header { background-color: var(--color-terracotta); border-bottom: 3px solid var(--color-gold); color: white; }
    </style>
</head>
<body>

    <!-- ADMIN HEADER -->
    <header class="admin-header py-4 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 serif mb-0 text-gold fw-bold">Modifier l'Article #<?= $product['id']; ?></h1>
                <small class="text-white-50"><?= htmlspecialchars($product['title']); ?></small>
            </div>
            <a href="index.php" class="btn btn-outline-light btn-sm fw-semibold">
                &larr; Retour au Tableau de bord
            </a>
        </div>
    </header>

    <div class="container py-5" style="max-width: 800px;">
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger shadow-sm border-0 mb-4"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="card border-gold shadow-sm">
            <div class="card-body p-4 p-md-5">
                <form action="edit_product.php?id=<?= $product['id']; ?>" method="POST" enctype="multipart/form-data">
                    
                    <div class="row g-4">
                        <div class="col-md-8">
                            <label for="title" class="form-label text-terracotta fw-bold">Titre / Nom du modèle *</label>
                            <input type="text" class="form-control border-gold" id="title" name="title" value="<?= htmlspecialchars($product['title']); ?>" required>
                        </div>

                        <div class="col-md-4">
                            <label for="category" class="form-label text-terracotta fw-bold">Catégorie *</label>
                            <select class="form-select border-gold" id="category" name="category" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['slug']); ?>" <?= $product['category'] === $category['slug'] ? 'selected' : ''; ?>><?= htmlspecialchars($category['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="rental_price" class="form-label text-terracotta fw-bold">Prix de Location / jour (FCFA) *</label>
                            <input type="number" step="500" class="form-control border-gold" id="rental_price" name="rental_price" value="<?= $product['rental_price']; ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="promo_percentage" class="form-label text-terracotta fw-bold">Réduction promotionnelle (% - optionnel)</label>
                            <input type="number" min="1" max="99" step="1" class="form-control border-gold" id="promo_percentage" name="promo_percentage" value="<?= htmlspecialchars((string) ($product['promo_percentage'] ?? '')); ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label text-terracotta fw-bold">Photo Actuelle & Modification</label>
                            <div class="d-flex align-items-center gap-3 mb-3 p-2 bg-light rounded border">
                                <img src="<?= str_starts_with($product['image_url'], 'uploads/') ? '../' . $product['image_url'] : $product['image_url']; ?>" alt="" style="width: 70px; height: 70px; object-fit: cover;" class="rounded border border-gold">
                                <small class="text-muted">Image actuelle : <?= htmlspecialchars($product['image_url']); ?></small>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="image_file" class="form-label small text-muted">Changer l'image (Téléverser) :</label>
                                    <input type="file" class="form-control border-gold" id="image_file" name="image_file" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label for="image_url" class="form-label small text-muted">OU saisir une URL d'image web :</label>
                                    <input type="url" class="form-control border-gold" id="image_url" name="image_url" value="<?= str_starts_with($product['image_url'], 'http') ? htmlspecialchars($product['image_url']) : ''; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label text-terracotta fw-bold">Description courte</label>
                            <textarea class="form-control border-gold" id="description" name="description" rows="3"><?= htmlspecialchars($product['description']); ?></textarea>
                        </div>

                        <div class="col-12">
                            <label for="details" class="form-label text-terracotta fw-bold">Détails & Inclusions</label>
                            <textarea class="form-control border-gold" id="details" name="details" rows="2"><?= htmlspecialchars($product['details']); ?></textarea>
                        </div>

                        <div class="col-12">
                            <div class="form-check custom-option-check p-3 rounded border">
                                <input class="form-check-input ms-0 me-2" type="checkbox" id="is_popular" name="is_popular" value="1" <?= $product['is_popular'] ? 'checked' : ''; ?>>
                                <label class="form-check-label fw-bold text-terracotta" for="is_popular">
                                    Mettre cet article en Vedette / Populaire sur la page d'accueil ★
                                </label>
                            </div>
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <a href="index.php" class="btn btn-outline-secondary me-2">Annuler</a>
                            <button type="submit" class="btn btn-gold px-5 py-3 text-uppercase fw-bold">
                                Mettre à jour l'Article
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

</body>
</html>
