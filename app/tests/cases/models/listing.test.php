<?php
/* Listing Test cases generated on: 2011-05-10 13:36:39 : 1305052599*/
App::import('Model', 'Listing');

class ListingTestCase extends CakeTestCase {
	var $fixtures = array('app.listing', 'app.user', 'app.message', 'app.location', 'app.category');

	function startTest() {
		$this->Listing =& ClassRegistry::init('Listing');
	}

	function endTest() {
		unset($this->Listing);
		ClassRegistry::flush();
	}

}
?>