<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Example structure (check which form submitted based on a unique field)
if (isset($_POST['alphabet_size'])) {
    $item = [
        'type' => 'Alphabet Letter Cake',
        'size' => $_POST['alphabet_size'],
        'color' => $_POST['alphabet_color'],
        'flavor' => $_POST['alphabet_flavor'],
        'letter' => $_POST['alphabet_letter'],
        'message' => $_POST['alphabet_message'],
        'price' => 899
    ];
    $_SESSION['cart'][] = $item;
}

// Same for number or minimalist, just identify with unique field names

header("Location: cart.php"); // redirect to cart or previous page
exit;
?>
