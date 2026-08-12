<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/auth.php';

startAdminSession();
if (!empty($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email || $password === '') {
        $error = 'Saisissez une adresse e-mail et un mot de passe valides.';
    } else {
        $statement = $pdo->prepare(
            'SELECT id, full_name, email, password_hash, role FROM admins WHERE email = :email AND is_active = 1 LIMIT 1'
        );
        $statement->execute([':email' => $email]);
        $admin = $statement->fetch();

        if (!$admin || !password_verify($password, $admin['password_hash'])) {
            $error = 'Adresse e-mail ou mot de passe incorrect.';
        } else {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = (int) $admin['id'];
            $_SESSION['admin_name'] = $admin['full_name'];
            $_SESSION['admin_role'] = $admin['role'];

            header('Location: index.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion administration — FAITH DECOR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex align-items-center min-vh-100" style="background: var(--color-ivory);">
    <main class="container" style="max-width: 460px;">
        <section class="card shadow border-0">
            <div class="card-body p-4 p-md-5">
                <h1 class="h3 serif text-terracotta mb-2">FAITH DECOR</h1>
                <p class="text-muted mb-4">Connexion à l'espace administration</p>

                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>

                <form method="post" novalidate>
                    <div class="mb-3">
                        <label class="form-label" for="email">Adresse e-mail</label>
                        <input class="form-control" type="email" id="email" name="email" autocomplete="email" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input class="form-control" type="password" id="password" name="password" autocomplete="current-password" required>
                    </div>
                    <button class="btn btn-gold w-100 fw-bold" type="submit">Se connecter</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
