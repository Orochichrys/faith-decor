<?php
declare(strict_types=1);
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/auth.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $action = $_POST['action'] ?? '';
        if ($action === 'save') {
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            $slug = strtolower(trim($_POST['slug'] ?? ''));
            $name = trim($_POST['name'] ?? '');
            $order = filter_var($_POST['sort_order'] ?? 0, FILTER_VALIDATE_INT);
            if (!preg_match('/^[a-z0-9-]{2,50}$/', $slug) || $name === '' || $order === false || $order < 0) throw new RuntimeException('Catégorie invalide. Utilisez uniquement des minuscules, chiffres et tirets pour le code.');
            if ($id) {
                $stmt = $pdo->prepare('UPDATE categories SET slug = :slug, name = :name, sort_order = :sort, is_active = :active WHERE id = :id');
                $stmt->execute([':slug' => $slug, ':name' => $name, ':sort' => $order, ':active' => isset($_POST['is_active']) ? 1 : 0, ':id' => $id]);
            } else {
                $stmt = $pdo->prepare('INSERT INTO categories (slug, name, sort_order, is_active) VALUES (:slug, :name, :sort, 1)');
                $stmt->execute([':slug' => $slug, ':name' => $name, ':sort' => $order]);
            }
        } elseif ($action === 'delete') {
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            $stmt = $pdo->prepare('DELETE FROM categories WHERE id = :id AND NOT EXISTS (SELECT 1 FROM products WHERE products.category = categories.slug)');
            $stmt->execute([':id' => $id]);
            if ($stmt->rowCount() === 0) throw new RuntimeException('Cette catégorie est utilisée par un article : désactivez-la plutôt.');
        }
        header('Location: categories.php?msg=' . urlencode('Catégories mises à jour.')); exit;
    } catch (Throwable $exception) { $error = $exception->getMessage(); }
}
$categories = $pdo->query('SELECT * FROM categories ORDER BY sort_order, name')->fetchAll();
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Catégories — FAITH DECOR</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../assets/css/style.css"></head><body class="bg-ivory"><main class="container py-5" style="max-width:900px"><div class="d-flex justify-content-between align-items-center mb-4"><h1 class="h3 serif text-terracotta">Catégories</h1><a href="index.php" class="btn btn-outline-secondary">Retour</a></div><?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?><?php if (isset($_GET['msg'])): ?><div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div><?php endif; ?><div class="card border-gold shadow-sm"><div class="card-body"><p class="text-muted">Une catégorie désactivée n'apparaît plus lors de l'ajout d'un article.</p><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Nom</th><th>Code</th><th>Ordre</th><th>Active</th><th></th></tr></thead><tbody><?php foreach ($categories as $category): ?><tr><form method="post"><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= $category['id'] ?>"><td><input class="form-control" name="name" value="<?= htmlspecialchars($category['name']) ?>" required></td><td><input class="form-control" name="slug" value="<?= htmlspecialchars($category['slug']) ?>" required></td><td><input class="form-control" type="number" min="0" name="sort_order" value="<?= $category['sort_order'] ?>"></td><td><input class="form-check-input" type="checkbox" name="is_active" <?= $category['is_active'] ? 'checked' : '' ?>></td><td class="text-nowrap"><button class="btn btn-sm btn-outline-dark">Modifier</button></form> <form class="d-inline" method="post" onsubmit="return confirm('Supprimer cette catégorie ?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $category['id'] ?>"><button class="btn btn-sm btn-outline-danger">Supprimer</button></form></td></tr><?php endforeach; ?><tr class="table-light"><form method="post"><input type="hidden" name="action" value="save"><td><input class="form-control" name="name" placeholder="Nouvelle catégorie" required></td><td><input class="form-control" name="slug" placeholder="ex: enfants" required></td><td><input class="form-control" type="number" min="0" name="sort_order" value="<?= count($categories) + 1 ?>"></td><td></td><td><button class="btn btn-sm btn-gold">Ajouter</button></td></form></tr></tbody></table></div></div></div></main></body></html>
