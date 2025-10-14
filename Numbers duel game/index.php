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
        .start-btn {
            background: linear-gradient(45deg, rgb(34, 197, 94), rgb(22, 163, 74));
        }
        .start-btn:hover {
            background: linear-gradient(45deg, rgb(22, 163, 74), rgb(34, 197, 94));
        }
        .rules-btn {
            background: linear-gradient(45deg, rgb(251, 191, 36), rgb(245, 158, 11));
        }
        .rules-btn:hover {
            background: linear-gradient(45deg, rgb(245, 158, 11), rgb(251, 191, 36));
        }
        .rules-modal {
            /* Visual improvement: Modal for rules */
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 12px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ласкаво просимо до гри!</h1>
        <p>Поєдинок Чисел - гра, де ви обираєте число від 1 до 3, а система обирає випадково. Якщо числа збігаються, ви втрачаєте HP, інакше - система.</p>
        <a class="button start-btn" href="?page=game1&restart=1">Почати гру</a>
        <!-- Visual improvement: Rules button -->
        <button class="button rules-btn" onclick="openModal()">Правила гри</button>
    </div>

    <!-- Visual improvement: Rules modal -->
    <div id="rulesModal" class="rules-modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Правила гри</h2>
            <p>1. Оберіть число від 1 до 3.</p>
            <p>2. Система також обирає випадкове число.</p>
            <p>3. Якщо числа збігаються, ви втрачаєте HP.</p>
            <p>4. Якщо числа не збігаються, система втрачає HP.</p>
            <p>5. Гра триває, поки HP одного з гравців не стане 0 або менше.</p>
            <p>6. Переможе той, у кого залишиться HP більше 0.</p>
        </div>
    </div>

    <script>
        // Visual improvement: Modal functions
        function openModal() {
            document.getElementById('rulesModal').style.display = 'block';
        }
        function closeModal() {
            document.getElementById('rulesModal').style.display = 'none';
        }
        window.onclick = function(event) {
            if (event.target == document.getElementById('rulesModal')) {
                closeModal();
            }
        }
    </script>
</body>
</html>
<?php
}
?>

