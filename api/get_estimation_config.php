<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../includes/db.php';

try {
    $items = $pdo->query(
        "SELECT id, item_type, label, price FROM estimation_items WHERE is_active = 1 ORDER BY item_type, sort_order, label"
    )->fetchAll();
    $config = ['events' => [], 'locations' => [], 'options' => [], 'guest_price' => 0];

    foreach ($items as $item) {
        $entry = ['id' => (int) $item['id'], 'label' => $item['label'], 'price' => (float) $item['price']];
        if ($item['item_type'] === 'event') {
            $config['events'][] = $entry;
        } elseif ($item['item_type'] === 'location') {
            $config['locations'][] = $entry;
        } else {
            $config['options'][] = $entry;
        }
    }

    $setting = $pdo->prepare('SELECT setting_value FROM estimation_settings WHERE setting_key = :key');
    $setting->execute([':key' => 'guest_price']);
    $config['guest_price'] = (float) ($setting->fetchColumn() ?: 0);

    echo json_encode(['success' => true, 'config' => $config], JSON_UNESCAPED_UNICODE);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Configuration indisponible.'], JSON_UNESCAPED_UNICODE);
}
