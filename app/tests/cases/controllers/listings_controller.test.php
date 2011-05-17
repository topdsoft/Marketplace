<?php
/* Listings Test cases generated on: 2011-05-10 13:39:24 : 1305052764*/
App::import('Controller', 'Listings');

class TestListingsController extends ListingsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ListingsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.listing', 'app.user', 'app.message', 'app.location', 'app.category');

	function startTest() {
		$this->Listings =& new TestListingsController();
		$this->Listings->constructClasses();
	}

	function endTest() {
		unset($this->Listings);
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