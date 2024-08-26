<?php

require base_path('views/partials/head.php');

?>
<style>

    body {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f7f7f7;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    h1 {
        font-size: 3em;
        margin-bottom: 10px;
        color: #333;
    }

    p {
        font-size: 1.2em;
        color: #666;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    .emoji {
        font-size: 5em;
    }

</style>
<div>
    <h1>404 - Page Not Found</h1>
    <p>Oops! Looks like you're lost.</p>
    <p>Let's get you back <a href="/">home</a>.</p>
    <div class="emoji">😟</div>
</div>