<?php
session_start();

$player_hp = $_SESSION['player_hp'] ?? 0;
$enemy_hp = $_SESSION['enemy_hp'] ?? 0;

if ($player_hp <= 0 && $enemy_hp <= 0) {
    $result = "Ви перемогли!"; 
} elseif ($player_hp <= 0) {
    $result = "Перемогла система!";
} else {
    $result = "Ви перемогли!";
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кінець гри</title>
    <style>
        body {
            background: linear-gradient(to right, rgb(128, 178, 231), #eef2f7);
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
            background-color: rgb(22, 115, 202);
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
        <h1>Кінець гри</h1>
        <p><?= htmlspecialchars($result) ?></p>
        <a class="button" href="index.php?page=game1&restart=1">Почати нову гру</a>
    </div>
</body>
</html>
