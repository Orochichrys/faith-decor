<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/auth.php';
requireAdmin();

$allowedTypes = ['event' => 'Événements', 'location' => 'Lieux de réception', 'option' => 'Options additionnelles'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    try {
        if ($action === 'guest_price') {
            $price = filter_var($_POST['guest_price'] ?? null, FILTER_VALIDATE_FLOAT);
            if ($price === false || $price < 0) throw new RuntimeException('Prix par invité invalide.');
            $stmt = $pdo->prepare("INSERT INTO estimation_settings (setting_key, setting_value) VALUES ('guest_price', :price) ON DUPLICATE KEY UPDATE setting_value = :price");
            $stmt->execute([':price' => $price]);
        } elseif ($action === 'save_item') {
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            $type = $_POST['item_type'] ?? '';
            $label = trim($_POST['label'] ?? '');
            $price = filter_var($_POST['price'] ?? null, FILTER_VALIDATE_FLOAT);
            $sort = filter_var($_POST['sort_order'] ?? 0, FILTER_VALIDATE_INT);
            $active = isset($_POST['is_active']) ? 1 : 0;
            if (!isset($allowedTypes[$type]) || $label === '' || $price === false || $price < 0 || $sort === false || $sort < 0) throw new RuntimeException('Informations invalides.');
            if ($id) {
                $stmt = $pdo->prepare('UPDATE estimation_items SET item_type = :type, label = :label, price = :price, sort_order = :sort, is_active = :active WHERE id = :id');
                $stmt->execute([':type' => $type, ':label' => $label, ':price' => $price, ':sort' => $sort, ':active' => $active, ':id' => $id]);
            } else {
                $stmt = $pdo->prepare('INSERT INTO estimation_items (item_type, label, price, sort_order, is_active) VALUES (:type, :label, :price, :sort, :active)');
                $stmt->execute([':type' => $type, ':label' => $label, ':price' => $price, ':sort' => $sort, ':active' => $active]);
            }
        } elseif ($action === 'delete_item') {
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            if (!$id) throw new RuntimeException('Élément invalide.');
            $stmt = $pdo->prepare('DELETE FROM estimation_items WHERE id = :id');
            $stmt->execute([':id' => $id]);
        }
        header('Location: estimation_settings.php?msg=' . urlencode('Configuration enregistrée.'));
        exit;
    } catch (Throwable $exception) {
        $error = $exception->getMessage();
    }
}

$items = $pdo->query('SELECT * FROM estimation_items ORDER BY item_type, sort_order, label')->fetchAll();
$groups = ['event' => [], 'location' => [], 'option' => []];
foreach ($items as $item) $groups[$item['item_type']][] = $item;
$guestPrice = (float) ($pdo->query("SELECT setting_value FROM estimation_settings WHERE setting_key = 'guest_price'")->fetchColumn() ?: 0);
?>
<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Configuration estimations — FAITH DECOR</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../assets/css/style.css"></head>
<body class="bg-ivory"><header class="admin-header py-4 shadow-sm" style="background-color:var(--color-terracotta);color:#fff"><div class="container d-flex justify-content-between align-items-center"><div><h1 class="h3 serif mb-0 text-gold">Configuration des estimations</h1><small>Choix et tarifs visibles par les clients</small></div><a href="index.php" class="btn btn-outline-light">Retour à l'administration</a></div></header>
<main class="container py-5">
<?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<?php if (isset($_GET['msg'])): ?><div class="alert alert-success"><?= htmlspecialchars($_GET['msg']) ?></div><?php endif; ?>
<section class="card border-gold shadow-sm mb-4"><div class="card-body"><h2 class="h5 text-terracotta">Prix par invité</h2><form method="post" class="row align-items-end g-2"><input type="hidden" name="action" value="guest_price"><div class="col-sm-4"><label class="form-label" for="guest_price">FCFA par invité</label><input class="form-control" id="guest_price" type="number" min="0" step="1" name="guest_price" value="<?= htmlspecialchars((string) $guestPrice) ?>" required></div><div class="col-sm-auto"><button class="btn btn-gold" type="submit">Enregistrer</button></div></form></div></section>
<?php foreach ($allowedTypes as $type => $heading): ?><section class="card border-gold shadow-sm mb-4"><div class="card-body"><h2 class="h5 text-terracotta mb-3"><?= $heading ?></h2><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Libellé</th><th>Prix FCFA</th><th>Ordre</th><th>Actif</th><th></th></tr></thead><tbody>
<?php foreach ($groups[$type] as $item): ?><tr><form method="post"><input type="hidden" name="action" value="save_item"><input type="hidden" name="id" value="<?= $item['id'] ?>"><input type="hidden" name="item_type" value="<?= $type ?>"><td><input class="form-control" name="label" value="<?= htmlspecialchars($item['label']) ?>" required></td><td><input class="form-control" type="number" min="0" step="1" name="price" value="<?= htmlspecialchars((string) $item['price']) ?>" required></td><td><input class="form-control" type="number" min="0" name="sort_order" value="<?= $item['sort_order'] ?>" required></td><td><input class="form-check-input" type="checkbox" name="is_active" <?= $item['is_active'] ? 'checked' : '' ?>></td><td class="text-nowrap"><button class="btn btn-sm btn-outline-dark" type="submit">Modifier</button></form><form method="post" class="d-inline" onsubmit="return confirm('Supprimer cet élément ?');"><input type="hidden" name="action" value="delete_item"><input type="hidden" name="id" value="<?= $item['id'] ?>"><button class="btn btn-sm btn-outline-danger" type="submit">Supprimer</button></form></td></tr><?php endforeach; ?>
<tr class="table-light"><form method="post"><input type="hidden" name="action" value="save_item"><input type="hidden" name="item_type" value="<?= $type ?>"><td><input class="form-control" name="label" placeholder="Nouvel élément" required></td><td><input class="form-control" type="number" min="0" step="1" name="price" value="0" required></td><td><input class="form-control" type="number" min="0" name="sort_order" value="<?= count($groups[$type]) + 1 ?>" required></td><td><input class="form-check-input" type="checkbox" name="is_active" checked></td><td><button class="btn btn-sm btn-gold" type="submit">Ajouter</button></td></form></tr>
</tbody></table></div></div></section><?php endforeach; ?>
</main></body></html>
