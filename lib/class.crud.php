<?php

/*
 * class that provides basic CRUD functionality
 */

class crud {
	
	function __construct($table = '') {
		if(!empty($table)) {
			$this->table = $table;
		}
	}

	function create($data) {
		global $sql;
		$table = $this->table;

		if (!is_array($data) OR empty($data)) {
			return false;
		}

		$data = array_diff(array_map(array(&$this, '_prepare_value'), $data), array('', null));

		$keys = '`' . implode('`,`', array_keys($data)) . '`';
		$values = "'" . implode("','", $data) . "'";

		$query = "INSERT INTO {$table} ({$keys}) VALUES ({$values})";
		echo "$query\n";
		if ($sql->query($query)) {
			return $sql->insert_id;
		}

		return false;
	}

	function read($where = array(), $fields = array()) {
		global $sql;
		$table = $this->table;

		$this->_create_where($where);

		if (is_array($fields) && !empty($fields)) {
			$fields = '`' . implode('`,`', $fields) . '`';
		} else {
			$fields = '*';
		}

		$query = "SELECT {$fields} FROM {$table} {$where}";
		echo "$query\n";
		$result = $sql->query($query);
		if (is_a($result, 'mysqli_result')) {
			return $result->fetch_all(MYSQLI_ASSOC);
		}
		return false;
	}

	function update($data, $where, $empty_where_verify = false) {
		global $sql;
		$table = $this->table;

		if (!is_array($data) OR empty($data)) {
			return false;
		}

		$this->_create_where($where);
		if (empty($where) && empty($empty_where_verify)) {
			return false;
		}

		$data = array_map(array(&$this, '_prepare_value'), $data);

		foreach ($data AS $key => &$value) {
			$value = "{$key}='{$value}'";
		}
		unset($value);

		$set = ' SET ' . implode(',', $data);

		$query = "UPDATE {$table} {$set} {$where}";
		echo "$query\n";
		if ($sql->query($query)) {
			return $sql->affected_rows;
		}

		return false;
	}

	function delete($where, $empty_where_verify = false) {
		global $sql;
		$table = $this->table;

		$this->_create_where($where);
		if (empty($where) && empty($empty_where_verify)) {
			return false;
		}

		$query = "DELETE FROM {$table} {$where}";
		echo "$query\n";
		if ($sql->query($query)) {
			return $sql->affected_rows;
		}

		return false;
	}

	private function _create_where(&$where) {
		if (is_array($where) && !empty($where)) {
			foreach ($where AS $key => &$value) {
				if (is_array($value)) {
					$value = "`{$key}` IN ('" . implode("','", array_map(array(&$this, '_prepare_value'), $value)) . "')";
				} else {
					$value = $this->_prepare_value($value);
					$value = "`{$key}` LIKE '{$value}'";
				}
			}
			unset($value);
			$where = ' WHERE ' . implode(' AND ', $where) . ' ';
		} else {
			$where = '';
		}
	}

	private function _prepare_value($value) {
		global $sql;
		if (!is_scalar($value)) {
			$value = serialize($value);
		}
		if (is_bool($value)) {
			$value = $value ? 1 : 0;
		}
		return $sql->escape_string($value);
	}

}
