<?php

require_once '../InMemoryPersistence.php';

class InMemoryPersistenceTest extends PHPUnit_Framework_TestCase {

	function testItCanPerisistAndRetrieveASingleDataArray() {
		$data = array('data');

		$persistence = new InMemoryPersistence();
		$persistence->persist($data);

		$this->assertEquals($data, $persistence->retrieve(0));
	}

	function testItCanPerisistSeveralElementsAndRetrieveAnyOfThem() {
		$data1 = array('data1');
		$data2 = array('data2');

		$persistence = new InMemoryPersistence();
		$persistence->persist($data1);
		$persistence->persist($data2);

		$this->assertEquals($data1, $persistence->retrieve(0));
		$this->assertEquals($data2, $persistence->retrieve(1));
	}

}

?>
