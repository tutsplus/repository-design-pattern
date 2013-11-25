<?php

require_once '../../../vendor/autoload.php';
require_once '../CommentRepository.php';
require_once '../CommentFactory.php';
require_once '../InMemoryPersistence.php';

class RepositoryTest extends PHPUnit_Framework_TestCase {

	protected function tearDown() {
		\Mockery::close();
	}

	function testItCallsThePersistenceWhenAddingAComment() {

		$persistanceGateway = \Mockery::mock('Persistence');
		$commentRepository = new CommentRepository($persistanceGateway);

		$commentData = array(1, 'x', 'x', 'x', 'x');
		$comment = (new CommentFactory())->make($commentData);

		$persistanceGateway->shouldReceive('persist')->once()->with($commentData);

		$commentRepository->add($comment);
	}

	function testAPersistedCommentCanBeRetrievedFromTheGateway() {

		$persistanceGateway = new InMemoryPersistence();
		$commentRepository = new CommentRepository($persistanceGateway);

		$commentData = array(1, 'x', 'x', 'x', 'x');
		$comment = (new CommentFactory())->make($commentData);

		$commentRepository->add($comment);

		$this->assertEquals($commentData, $persistanceGateway->retrieve(0));
	}

	function testItCanAddMultipleCommentsAtOnce() {

		$persistanceGateway = \Mockery::mock('Persistence');
		$commentRepository = new CommentRepository($persistanceGateway);

		$commentData1 = array(1, 'x', 'x', 'x', 'x');
		$comment1 = (new CommentFactory())->make($commentData1);
		$commentData2 = array(2, 'y', 'y', 'y', 'y');
		$comment2 = (new CommentFactory())->make($commentData2);

		$persistanceGateway->shouldReceive('persist')->once()->with($commentData1);
		$persistanceGateway->shouldReceive('persist')->once()->with($commentData2);

		$commentRepository->add(array($comment1, $comment2));
	}

	function testItCanFindAllComments() {
		$repository = new CommentRepository();

		$commentData1 = array(1, 'x', 'x', 'x', 'x');
		$comment1 = (new CommentFactory())->make($commentData1);
		$commentData2 = array(2, 'y', 'y', 'y', 'y');
		$comment2 = (new CommentFactory())->make($commentData2);

		$repository->add($comment1);
		$repository->add($comment2);

		$this->assertEquals(array($comment1, $comment2), $repository->findAll());
	}

	function testItCanFindCommentsByBlogPostId() {
		$repository = new CommentRepository();

		$commentData1 = array(1, 'x', 'x', 'x', 'x');
		$comment1 = (new CommentFactory())->make($commentData1);
		$commentData2 = array(1, 'y', 'y', 'y', 'y');
		$comment2 = (new CommentFactory())->make($commentData2);
		$commentData3 = array(3, 'y', 'y', 'y', 'y');
		$comment3 = (new CommentFactory())->make($commentData3);

		$repository->add(array($comment1, $comment2));
		$repository->add($comment3);

		$this->assertEquals(array($comment1, $comment2), $repository->findByPostId(1));
		$this->assertEquals(array($comment3), $repository->findByPostId(3));
	}

}

?>
