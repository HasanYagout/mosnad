<?php


$router->get('/','controllers/index.php');
$router->post('/comment/store','controllers/comment/store.php');
$router->post('/comment','controllers/comment/comment.php');
$router->post('/comment/delete','controllers/comment/destroy.php');

$router->get('/products','controllers/posts/show.php');
$router->post('/posts/create','controllers/posts/store.php');
?>