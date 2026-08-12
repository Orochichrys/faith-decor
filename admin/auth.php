<?php
/** Fonctions communes d'authentification de l'administration. */

declare(strict_types=1);

function startAdminSession(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function requireAdmin(): void
{
    startAdminSession();

    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}
