<?php

interface Persistence {

	function persist($data);

	function retrieve($ids);
}

?>
