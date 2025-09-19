<?php 
$page = $_GET['page'] ?? '';
$module = $_GET['module'] ?? '';

if ($module === 'games' && $page === 'game1over') {
    include 'game1over.php';
} elseif ($page === 'game1') {
    include 'game1.php';
} else {
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Поєдинок Чисел</title>
    <style>
        body {
            background: linear-gradient(to right,rgb(128, 178, 231), #eef2f7);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
            box-sizing: border-box;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 18px;
            background-color:rgb(22, 115, 202);
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: rgb(70, 104, 159);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ласкаво просимо до гри!</h1>
        <a class="button" href="?page=game1&restart=1">Почати гру</a>
    </div>
</body>
</html>
<?php
}
?>

