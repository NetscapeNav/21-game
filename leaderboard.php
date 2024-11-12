<?php
header('Content-Type: application/json');

// Путь к файлу с лидербордом
$leaderboardFile = 'leaderboard.json';

// Функция для чтения лидерборда
function getLeaderboard($file) {
    if (!file_exists($file)) {
        return [];
    }
    $data = file_get_contents($file);
    $leaderboard = json_decode($data, true);
    if (!$leaderboard) {
        return [];
    }
    return $leaderboard;
}

// Функция для записи лидерборда
function saveLeaderboard($file, $leaderboard) {
    $data = json_encode($leaderboard, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($file, $data, LOCK_EX);
}

// Обработка GET запроса для получения лидерборда
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $leaderboard = getLeaderboard($leaderboardFile);
    echo json_encode(['status' => 'success', 'leaderboard' => $leaderboard]);
    exit;
}

// Обработка POST запроса для добавления нового результата
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из тела запроса
    $input = json_decode(file_get_contents('php://input'), true);
    if (!isset($input['name']) || !isset($input['chips'])) {
        echo json_encode(['status' => 'error', 'message' => 'Неверные данные']);
        exit;
    }

    $name = htmlspecialchars(strip_tags($input['name']));
    $chips = intval($input['chips']);

    if ($chips <= 0 || empty($name)) {
        echo json_encode(['status' => 'error', 'message' => 'Неверные данные']);
        exit;
    }

    // Чтение текущего лидерборда
    $leaderboard = getLeaderboard($leaderboardFile);

    // Добавление нового результата
    $leaderboard[] = ['name' => $name, 'chips' => $chips];

    // Сортировка по убыванию фишек
    usort($leaderboard, function($a, $b) {
        return $b['chips'] - $a['chips'];
    });

    // Ограничение до топ-10
    $leaderboard = array_slice($leaderboard, 0, 10);

    // Сохранение обновленного лидерборда
    saveLeaderboard($leaderboardFile, $leaderboard);

    echo json_encode(['status' => 'success', 'leaderboard' => $leaderboard]);
    exit;
}

// Если метод запроса не GET и не POST
echo json_encode(['status' => 'error', 'message' => 'Недопустимый метод запроса']);
exit;
?>
