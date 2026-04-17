<?php
// functions.php
function getProductsByCategory($pdo, $category) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ? ORDER BY id DESC");
    $stmt->execute([$category]);
    return $stmt->fetchAll();
}

function getCategoryStats($pdo, $category) {
    $stats = [];
    $stmt = $pdo->prepare("SELECT SUM(stock) as total_stock, COUNT(*) as total_items FROM products WHERE category = ?");
    $stmt->execute([$category]);
    $stats['stock'] = $stmt->fetch()['total_stock'] ?? 0;
    
    $stmt = $pdo->