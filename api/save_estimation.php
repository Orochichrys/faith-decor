<?php
// api/save_estimation.php - Save client budget estimation to database
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée. Seul POST est accepté.'], JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    // Get raw POST data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Données JSON invalides.'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Extract and validate parameters
    $eventLabel = trim((string) ($data['event_label'] ?? ''));
    $locationLabel = trim((string) ($data['location_label'] ?? ''));
    $guestCount = (int) ($data['guest_count'] ?? 0);
    $optionsSelected = isset($data['options_selected']) ? trim((string) $data['options_selected']) : null;
    $totalPrice = (float) ($data['total_price'] ?? 0.0);

    if ($eventLabel === '' || $locationLabel === '' || $guestCount <= 0 || $totalPrice < 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Champs obligatoires manquants ou invalides.'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Insert into database
    $stmt = $pdo->prepare("
        INSERT INTO project_estimations (event_label, location_label, guest_count, options_selected, total_price)
        VALUES (:event_label, :location_label, :guest_count, :options_selected, :total_price)
    ");

    $stmt->execute([
        ':event_label' => $eventLabel,
        ':location_label' => $locationLabel,
        ':guest_count' => $guestCount,
        ':options_selected' => $optionsSelected,
        ':total_price' => $totalPrice
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Estimation enregistrée avec succès.',
        'estimation_id' => $pdo->lastInsertId()
    ], JSON_UNESCAPED_UNICODE);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de l\'enregistrement de l\'estimation : ' . $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
