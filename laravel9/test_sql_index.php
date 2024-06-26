<?php
// Этот файл для теста связи с базой данных, записи и чтения

echo 'Если нет ошибки то есть соединение с базой данных<br>';

$host = 'mysqldb'; // Используем имя сервиса контейнера MySQL из docker-compose.yml
$db = 'ale2'; // Указываем имя базы данных
$user = 'root';
$pass = 'secret';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка соединения с БД ' . $e->getMessage();
    die();
}

// Запрос для создания таблицы и заполнение
$queryCreateTable = "
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `flag` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`name`, `email`, `flag`) VALUES
('name1', 'name1@gmail.com', 1),
('name2', 'name2@gmail.com', 1),
('name3', 'name3@gmail.com', 1);
";

try {
    $pdo->exec($queryCreateTable);
    echo 'Таблица успешно создана и заполнена данными.<br>';
} catch (PDOException $e) {
    echo 'Ошибка при создании таблицы: ' . $e->getMessage();
}

// Retrieve data from table
$query = "SELECT id, name, email FROM users";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Display data
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . ' - ' . $row['email'] . '<br>';
}
?>
