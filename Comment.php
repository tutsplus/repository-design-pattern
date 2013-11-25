<?php

class Comment {

	private $postId;
	private $author;
	private $authorEmail;
	private $subject;
	private $body;

	function __construct($postId, $author, $authorEmail, $subject, $body) {
		$this->postId = $postId;
		$this->author = $author;
		$this->authorEmail = $authorEmail;
		$this->subject = $subject;
		$this->body = $body;
	}

	public function getPostId() {
		return $this->postId;
	}

	public function getAuthor() {
		return $this->author;
	}

	public function getAuthorEmail() {
		return $this->authorEmail;
	}

	public function getSubject() {
		return $this->subject;
	}

	public function getBody() {
		return $this->body;
	}

}

?>
