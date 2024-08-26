<?php

$config= require base_path('config.php');
$database=new \Core\Database($config['database']);
$products=$database->query('select * from products')->get();
$comments=$database->query('select * from comments')->get();

$averageRatings = [];
foreach ($products as $product) {
    $productId = $product['id'];
    $ratings = $database->query('SELECT rate FROM ratings WHERE post_id = ?', [$productId])->get();

    if (count($ratings) > 0) {
        $totalRating = array_sum(array_column($ratings, 'rate'));
        $averageRating = $totalRating / count($ratings);
    } else {
        $averageRating = 0;
    }

    $averageRatings[$productId] = $averageRating;
}

require view('index.php',['products'=>$products,'comments'=>$comments,'averageRatings'=>$averageRatings]);
