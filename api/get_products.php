<?php
// api/get_products.php - Fetch products from database for frontend catalog
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../includes/db.php';

try {
    $category = $_GET['category'] ?? 'all';
    
    if ($category !== 'all') {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category = :category ORDER BY id DESC");
        $stmt->execute([':category' => $category]);
    } else {
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    }

    $products = $stmt->fetchAll();

    // Map fields for frontend JS compatibility
    $formatted = array_map(function($item) {
        return [
            'id' => intval($item['id']),
            'title' => $item['title'],
            'category' => $item['category'],
            'categoryLabel' => $item['category_label'],
            'price' => floatval($item['rental_price']),
            'promoPercentage' => $item['promo_percentage'] !== null ? floatval($item['promo_percentage']) : null,
            'promoPrice' => $item['promo_percentage'] !== null
                ? round(floatval($item['rental_price']) * (1 - floatval($item['promo_percentage']) / 100), 2)
                : null,
            'image' => $item['image_url'],
            'description' => $item['description'],
            'details' => $item['details'],
            'popular' => intval($item['is_popular']) === 1
        ];
    }, $products);

    echo json_encode(['success' => true, 'products' => $formatted]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
