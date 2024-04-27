<?php
echo '111111111111111';

$host = 'mysqldb';
$db = 'ale2';
$user = 'root';
$pass = 'secret';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка соединения с БД ' . $e->getMessage();
    die();
}

// Запрос для создания таблицы
$queryCreateTable = "
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

// CREATE DATABASE `ale3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
// USE `ale3`;

CREATE TABLE `users_1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `flag` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users_1` (`id`, `name`, `email`, `flag`) VALUES
(1, 't', 't1', 1),
(4, 'dsdsdsq', 'w1w1wq', 1),
(6, 'aaaa1', 'a1', 0),
(7, 'ae', 'a1e', 0),
(8, '', 'qqqq', 1),
(9, 'www', 'eee', 1),
(12, 'ww', 'wwqq', 1),
(13, 'edit', 'edit', 0),
(14, 'qwwqaq', 'wqwqw', 0);
";

try {
    $pdo->exec($queryCreateTable);
    echo 'Таблица успешно создана и заполнена данными.';
} catch (PDOException $e) {
    echo 'Ошибка при создании таблицы: ' . $e->getMessage();
}

// Retrieve data from table
$query = "SELECT * FROM users_1";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Display data
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['name'] . ' - ' . $row['email'] . '<br>';
}
?>
