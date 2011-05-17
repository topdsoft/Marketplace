<?php
/* Categories Test cases generated on: 2011-05-10 13:38:38 : 1305052718*/
App::import('Controller', 'Categories');

class TestCategoriesController extends CategoriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CategoriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.category');

	function startTest() {
		$this->Categories =& new TestCategoriesController();
		$this->Categories->constructClasses();
	}

	function endTest() {
		unset($this->Categories);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>