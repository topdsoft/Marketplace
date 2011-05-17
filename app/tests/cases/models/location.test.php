<?php
/* Location Test cases generated on: 2011-05-10 13:37:20 : 1305052640*/
App::import('Model', 'Location');

class LocationTestCase extends CakeTestCase {
	var $fixtures = array('app.location', 'app.listing', 'app.user', 'app.message', 'app.category');

	function startTest() {
		$this->Location =& ClassRegistry::init('Location');
	}

	function endTest() {
		unset($this->Location);
		ClassRegistry::flush();
	}

}
?>