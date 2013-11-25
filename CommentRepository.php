<?php

require_once __DIR__ . '/InMemoryPersistence.php';
require_once __DIR__ . '/CommentFactory.php';

class CommentRepository {

	private $persistence;
	private $commentFactory;

	function __construct(Persistence $persistence = null) {
		$this->persistence = $persistence ? : new InMemoryPersistence();
		$this->commentFactory = new CommentFactory();
	}

	function add($commentData) {
		if (is_array($commentData))
			foreach ($commentData as $comment)
				$this->addOne($comment);
		else
			$this->addOne($commentData);
	}

	function findAll() {
		$allCommentsData = $this->persistence->retrieveAll();
		$comments = array();
		foreach ($allCommentsData as $commentData)
			$comments[] = $this->commentFactory->make($commentData);
		return $comments;
	}

	function findByPostId($postId) {
		return array_values(
			array_filter($this->findAll(), function ($comment) use ($postId) {
				return $comment->getPostId() == $postId;
			})
		);
	}

	private function addOne(Comment $comment) {
		$this->persistence->persist(array(
			$comment->getPostId(),
			$comment->getAuthor(),
			$comment->getAuthorEmail(),
			$comment->getSubject(),
			$comment->getBody()
		));
	}

}

?>
