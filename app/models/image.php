<?php
class Image extends AppModel {
	var $name = 'Image';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Listing' => array(
			'className' => 'Listing',
			'foreignKey' => 'listing_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>