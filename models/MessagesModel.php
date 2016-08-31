<?php

class MessagesModel extends BaseModel{

	public function getAllMessages($limit = '0')
	{
		$db = $this->connection();
		$query = "SELECT `m`.*, `u`.`name` AS `user_name` FROM `messages` AS `m` 
            LEFT JOIN `users` AS `u` ON `u`.`id` = `m`.`user_id` 
            ORDER BY `datetime` DESC LIMIT 0,10";
		if($limit !== '0') {
			$query .= " LIMIT {$limit} ";
		}
		
		$result = $db->query($query);
		return $result -> fetchAll();
	}
	
	public function addPost($text, $user_id)
	{
		$db = $this->connection();
		$query = "INSERT INTO `messages` SET `message` = :message, `user_id` = :user_id, `datetime`=NOW()";
		$stmt = $db->prepare($query);
		$stmt->execute(['message' => $text, 'user_id' => $user_id]);
		return $db->lastInsertId();
	}

	public function getPost($id)
	{
		$db = $this->connection();
		$query = "SELECT * FROM `messages` WHERE `id` = :id";
		$stmt = $db->prepare($query);
		$result = $stmt->execute(['id' => $id]);
		return $stmt->fetch();
	}

	public function editPost($id, $text, $user_id)
	{
		$db = $this->connection();

		$queryId = "SELECT `user_id` FROM `messages` WHERE `id` = :id";
		$stmtUserId = $db->prepare($queryId);
		$stmtUserId->execute(['id' => $id]);
		$useIdByMessageId = $stmtUserId->fetch();

		if ($useIdByMessageId['user_id'] != $user_id) {
			return false;
		}

		$query = "UPDATE `messages` SET `message` = :message, `user_id` = :user_id, `datetime`=NOW() WHERE `id` = :id";
		$stmt = $db->prepare($query);
		$stmt->execute(['message' => $text, 'id' => $id, 'user_id' => $user_id]);

		return true;
	}

	public function deletePost($id)
	{
		$db = $this->connection();
		$query = "DELETE FROM `messages` WHERE `id` = :id";
		$stmt = $db->prepare($query);
		$stmt->execute(['id' => $id]);
	}
}
