<?php

require_once '../CommentFactory.php';

class CommentFactoryTest extends PHPUnit_Framework_TestCase {

	function testACommentsHasAllItsComposingParts() {
		$postId = 1;
		$commentAuthor = "Joe";
		$commentAuthorEmail = "joe@gmail.com";
		$commentSubject = "Joe Has an Opinion about the Repository Pattern";
		$commentBody = "I think it is a good idea to use the Repository Pattern to persist and retrieve objects.";

		$commentData = array($postId, $commentAuthor, $commentAuthorEmail, $commentSubject, $commentBody);

		$comment = (new CommentFactory())->make($commentData);

		$this->assertEquals($postId, $comment->getPostId());
		$this->assertEquals($commentAuthor, $comment->getAuthor());
		$this->assertEquals($commentAuthorEmail, $comment->getAuthorEmail());
		$this->assertEquals($commentSubject, $comment->getSubject());
		$this->assertEquals($commentBody, $comment->getBody());
	}
}
?>
