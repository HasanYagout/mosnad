<?php
use Core\Database;

$config = require base_path('config.php');
require base_path('Core/Validator.php');
$database = new Database($config['database']);

$errors = [];
$success = [];
$products = $database->query('SELECT * FROM products')->get();
$comments = $database->query('SELECT * FROM comments')->get();
$user = $database->query('SELECT * FROM users where id=:id',['id'=>6])->find();
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
if ($user['email']=='yagouthasan3@gmail.com') {
    if (!Validator::string($_POST['comment'], 1, 300)) {

        $errors['comment'] = "Please enter a comment with 1 to 300 characters.";
    }
    if ($_POST['rating']==0) {
        $errors['rating'] = "Please provide a rating.";
    }
    if (empty($errors)){

        $id = $_POST['post_id'];
        $product = $database->query('SELECT * FROM products WHERE id = ?', [$id])->get();

        if (!$product) {
            $errors['product'] = "Product not found.";
        } else {
            $rating = $_POST['rating'];
            $comment = $database->query('INSERT INTO comments (product_id, user_id, body) VALUES (:product_id, :user_id, :body)', [
                'product_id' => $id,
                'user_id' => 6,
                'body' => $_POST['comment']
            ]);

            $database->query('INSERT INTO ratings (user_id,post_id, rate) VALUES (:user_id,:post_id, :rate)', [
                'user_id' => 6,
                'post_id' => $id,
                'rate' => $rating
            ]);
            $success['comment']="You Commented Successfully";
            sendmail('yagouthasan3@gmail.com');
            header('Location: /');
            exit();

        }
    }
}


else{
    $errors['rating'] = "you are not authenticated";
}


if (!empty($errors)){
    return require view('index.php',[
        'errors'=>$errors,
        'averageRatings'=>$averageRatings,
        'success'=>$success,
        'products'=>$products,
        'comments'=>$comments
    ]);
}