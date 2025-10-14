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

    // Bug fix: Add input validation - only allow 1,2,3
    if (!in_array($player_choice, [1, 2, 3], true)) {
        $_SESSION['error'] = "Невалідний вибір! Оберіть число від 1 до 3.";
    } else {
        $enemy_choice = rand(1, 3);
        $damage = rand(1, 4);

        if ($player_choice === $enemy_choice) {
            // Bug fix: Prevent HP from going negative
            $_SESSION['player_hp'] = max(0, $_SESSION['player_hp'] - $damage);
            $_SESSION['log'][] = "Гравець вибрав $player_choice, сервер вибрав $enemy_choice. Значення збігаються! Знято $damage HP з гравця.";
        } else {
            // Bug fix: Prevent HP from going negative
            $_SESSION['enemy_hp'] = max(0, $_SESSION['enemy_hp'] - $damage);
            $_SESSION['log'][] = "Гравець вибрав $player_choice, сервер вибрав $enemy_choice. Значення не збігаються! Знято $damage HP із сервера.";
        }

        // Bug fix: Change condition to <=0 for both HP
        if ($_SESSION['player_hp'] <= 0 || $_SESSION['enemy_hp'] <= 0) {
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
        /* Visual improvement: Removed duplicate button styles, kept improved ones below */
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
        .hp-icon {
            font-size: 20px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .log {
            text-align: left;
            max-height: 200px;
            overflow-y: auto;
            padding-left: 20px;
        }
        .button {
            /* Visual improvement: Added animation and better colors */
            background: linear-gradient(45deg, rgb(22, 115, 202), rgb(70, 104, 159));
            transition: all 0.3s ease;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 18px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            display: inline-block;
            margin: 10px;
        }
        .button:hover {
            background: linear-gradient(45deg, rgb(70, 104, 159), rgb(22, 115, 202));
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Поєдинок Чисел</h1>

        <!-- Visual improvement: Added heart icons for HP display -->
        <div class="stats">
            <p><strong>Ваше HP:</strong> <span class="hp-icon player">❤️</span> <?= max(0, (int)$_SESSION['player_hp']) ?></p>
            <p><strong>HP ворога:</strong> <span class="hp-icon enemy">💙</span> <?= max(0, (int)$_SESSION['enemy_hp']) ?></p>
        </div>

        <!-- Bug fix: Display error message for invalid input -->
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

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

