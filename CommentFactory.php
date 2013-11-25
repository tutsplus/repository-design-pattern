<?php

require_once __DIR__ . '/Factory.php';
require_once __DIR__ . '/Comment.php';

class CommentFactory implements Factory {

	function make($components) {

		return new Comment($components[0], $components[1], $components[2], $components[3], $components[4]);
	}

}

?>
