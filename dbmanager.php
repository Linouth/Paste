<?php
	class DBManager {
		public function __construct($DBH) {
			$this->DBH = $DBH;
		}

		public function changeValue($table, $id, $column, $value) {
			$sql = $this->DBH->prepare("UPDATE $table SET $column=:value WHERE `id`=:id");
			$sql->execute(array(':value' => $value, ':id' => $id));
		}


		/*
		 * Insert INTO Functies
		 */
		public function insertIntoPastes($ID, $title, $content, $IP) {
			$sql = $this->DBH->prepare("INSERT INTO Paster (pasteID, title, content, ip) VALUES (?, ?, ?, ?)");
			$sql->execute(array($ID, $title, $content, $IP));
		}
		/*
		 *
		 */



		public function fetchAll($table, $order = NULL) {
			if ($order == NULL) {
				$sql = $this->DBH->prepare("SELECT * FROM $table");
			} else {
				$sql = $this->DBH->prepare("SELECT * FROM $table ORDER BY $order DESC");
			}
			$sql->execute();
			return $sql->fetchAll();
		}
		public function fetch($table, $id) {
			$sql = $this->DBH->prepare("SELECT * FROM $table WHERE `id`=?");
			$sql->execute(array($id));
			return $sql->fetch();
		}
		public function fetchPaste($ID) {
			$sql = $this->DBH->prepare("SELECT * FROM Paster WHERE `pasteID`=?");
			$sql->execute(array($ID));
			return $sql->fetch();
		}

		public function __toString() {
			return 'Database helper class.';
		}

		public function delete($table, $id) {
			$sql = $this->DBH->prepare("DELETE FROM $table WHERE `id`=?");
			$sql->execute(array($id));
		}
	}
?>
