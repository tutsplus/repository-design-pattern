<?php

require_once __DIR__ . '/Persistence.php';

class InMemoryPersistence implements Persistence {
	private $data = array();


	function persist($data) {
		$this->data[] = $data;
	}

	function retrieve($id) {
		return $this->data[$id];
	}

	function retrieveAll() {
		return $this->data;
	}
}

?>
