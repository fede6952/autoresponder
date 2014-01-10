<?php

/**
 * Class that provides basic CRUD functionality
 * @author Mike Lopez <e@coderscult.com>
 */

class crud {

	/**
	 * Constructor
	 * @param string $table Optional table parameter
	 */
	function __construct($table = '') {
		if(!empty($table)) {
			$this->table = $table;
		}
	}

	/**
	 * Add data to table
	 * @global \mysqli $sql
	 * @param array $data Associative array of data to add
	 * @return mixed \mysqli::$insert_id|false
	 */
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

	/**
	 * Read data from table
	 * @global \mysqli $sql
	 * @param array $where Associative array of fields to match rows for reading
	 * @param array $fields Optional Associative array of fields to return
	 * @return mixed array|false
	 */
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

	/**
	 * Update data on table
	 * @global \mysqli $sql
	 * @param array $data Associative array of fields to update
	 * @param array $where Associative array of fields to match rows for updating
	 * @param type $empty_where_verify Optional verification if $where is empty
	 * @return mixed \mysqli::$affected_rows|false
	 */
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

	/**
	 * Delete data from table
	 * @global \mysqli $sql
	 * @param array $where Associative array of fields to match rows for deleting
	 * @param type $empty_where_verify Optional verification if $where is empty
	 * @return mixed \mysqli::$affected_rows|false
	 */
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

	/**
	 * Converts passed array to a mysql WHERE statement
	 * @param array &$where
	 */
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

	/**
	 * Serializes and escapes data. Serialization only happens if needed
	 * @global \mysqli $sql
	 * @param mixed $value
	 * @return string
	 */
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
