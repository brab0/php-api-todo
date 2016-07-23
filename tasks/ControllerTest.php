<?php
require 'Controller.php';
require_once 'Connection.php';

class ControllerTeste extends PHPUnit_Framework_TestCase{

	private $c;

	public function testTasksEmpty()
	{
		$db = new Connection();
		$ctrl = new Task\Controller($db->get());
		
		$this->assertEquals('Wow. You have nothing else to do. Enjoy the rest of your day!', $ctrl->getAll());
	}

	public function testInsertTypeNotSuported()
	{
		$db = new Connection();
		$ctrl = new Task\Controller($db->get());
				
		$task = new stdClass();
		$task->type = "anything different from work or shopping";
		$task->content = "";
		$task->sort_order = "";
		$task->done = "";

		$this->assertEquals('The task type you provided is not supported. You can only use shopping or work.', $ctrl->insert($task));
	}

	public function testInsertTaskEmpty()
	{
		$db = new Connection();
		$ctrl = new Task\Controller($db->get());
				
		$task = new stdClass();

		$this->assertEquals('Bad move! Try removing the task instead of deleting its content.', $ctrl->insert($task));
	}

	public function testDeleteEmpty()
	{
		$db = new Connection();
		$ctrl = new Task\Controller($db->get());
				
		$uuid = 9999;

		$this->assertEquals('Good news! The task you were trying to delete didn\'t even exist.', $ctrl->delete($uuid));
	}

	public function testUpdateTypeNotSuported()
	{
		$db = new Connection();
		$ctrl = new Task\Controller($db->get());
				
		$task = new stdClass();
		$task->uuid = 1;
		$task->type = "anything different from work or shopping";
		$task->content = "";
		$task->sort_order = "";
		$task->done = "";

		$this->assertEquals('The task type you provided is not supported. You can only use shopping or work.', $ctrl->insert($task));
	}

	public function testUpdateIdNotExist()
	{
		$db = new Connection();
		$ctrl = new Task\Controller($db->get());
				
		$task = new stdClass();
		$task->uuid = 999999;
		$task->type = "work";
		$task->content = "";
		$task->sort_order = "";
		$task->done = "";

		$this->assertEquals('Are you a hacker or something? The task you were trying to edit doesn\'t exist.', $ctrl->insert($task));
	}
}