<?php
session_start();

$basehp = 10;

if (isset($_GET['restart'])) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['player_hp'] = $basehp;
    $_SESSION['enemy_hp'] = $basehp;
    $_SESSION['log'] = [];

    header("Location: index.php?page=game1");
    exit();
}

if (!isset($_SESSION['player_hp'], $_SESSION['enemy_hp'])) {
    $_SESSION['player_hp'] = $basehp;
    $_SESSION['enemy_hp'] = $basehp;
    $_SESSION['log'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['choice'])) {
    $player_choice = (int)$_POST['choice'];

    if (in_array($player_choice, [1, 2, 3], true)) {
        $enemy_choice = rand(1, 3);
        $damage = rand(1, 4);

        if ($player_choice === $enemy_choice) {
            $_SESSION['player_hp'] -= $damage;
            $_SESSION['log'][] = "Гравець вибрав $player_choice, сервер вибрав $enemy_choice. Значення збігаються! Знято $damage HP з гравця.";
        } else {
            $_SESSION['enemy_hp'] -= $damage;
            $_SESSION['log'][] = "Гравець вибрав $player_choice, сервер вибрав $enemy_choice. Значення не збігаються! Знято $damage HP із сервера.";
        }

        if ($_SESSION['player_hp'] <= 1 || $_SESSION['enemy_hp'] <= 0) {
            header("Location: index.php?module=games&page=game1over");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Поєдинок Чисел</title>
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
        .choice-form input[type="number"] {
            width: 60px;
            padding: 8px;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .stats {
            margin: 20px 0;
        }
        .log {
            text-align: left;
            max-height: 200px;
            overflow-y: auto;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Поєдинок Чисел</h1>

        <div class="stats">
            <p><strong>Ваше HP:</strong> <?= max(0, (int)$_SESSION['player_hp']) ?></p>
            <p><strong>HP ворога:</strong> <?= max(0, (int)$_SESSION['enemy_hp']) ?></p>
        </div>

        <form method="post" class="choice-form">
            <label>Оберіть число (1-3):</label><br>
            <input type="number" name="choice" min="1" max="3" required>
            <button type="submit" class="button">Атакувати</button>
        </form>

        <h2>Журнал бою:</h2>
        <ul class="log">
        <?php foreach (array_reverse($_SESSION['log']) as $entry): ?>
            <li><?= htmlspecialchars($entry) ?></li>
        <?php endforeach; ?>
        </ul>

        <form method="get">
            <input type="hidden" name="page" value="game1">
            <input type="hidden" name="restart" value="1">
            <button type="submit" class="button">Почати спочатку</button>
        </form>
    </div>
</body>
</html>

