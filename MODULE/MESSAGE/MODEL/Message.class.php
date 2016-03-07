<?php

class Message {

	private $id;
	private $id_user; // author
	private $content;
	private $createDate;

	public function getId() {
		return $this->id;
	}

	public function getAuthor() {
		return $this->id_user;
	}

	public function getContent() {
		return $this->content;
	}

	public function getCreateDate() {
		return $this->createDate;
	}

	public function setId($id) {
		if ($id > 0 ) {
			$this->id_user = $id;
		}
	}

	public function setContent($content) {
		if (strlen($content) > 10 && strlen($content) < 1023) {
			$this->content = $content;
		}
	}
}

$test = new Message();
$test->setId(10);
$test->setContent("Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus laboriosam quidem magnam animi quod! Aliquid possimus recusandae quis saepe dolores unde dolorem laborum illo similique eligendi, beatae, deleniti iusto esse.");

var_dump($test);


?>