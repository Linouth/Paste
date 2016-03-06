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
		public function __toString() {
			return 'Database helper function.';
		}

		public function delete($table, $id) {
			$sql = $this->DBH->prepare("DELETE FROM $table WHERE `id`=?");
			$sql->execute(array($id));
		}
	}
?>
