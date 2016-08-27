<?php

$db = connection($db_config);

//$stmt = $db->prepare('SELECT * FROM `messages` ORDER BY `datetime` DESC LIMIT 0,10');
$stmt = $db->prepare('SELECT `m`.*, `u`.`name` AS `user_name` FROM `messages` AS `m` 
LEFT JOIN `users` AS `u` ON `u`.`id` = `m`.`user_id` 
ORDER BY `datetime` DESC LIMIT 0,10');
$stmt->execute();
$data = $stmt->fetchAll();

echo template('templates/home.php', [
    'posts' => $data
]);
