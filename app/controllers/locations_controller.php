<?php
class LocationsController extends AppController {

	var $name = 'Locations';

	function index() {
		if ($this->Auth->user('role')>9) {
			$this->Location->recursive = 0;
			$this->set('locations', $this->paginate());
		} else {
			//must be admin to edit locations
			$this->Session->setFlash(__('You do not have access to this.', true));
			$this->redirect(array('controller'=>'listings','action' => 'index'));
		}//endif
	}

/*	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('location', $this->Location->read(null, $id));
	}//*/

	function add() {
		if ($this->Auth->user('role')>9) {
			if (!empty($this->data)) {
				$this->Location->create();
				if ($this->Location->save($this->data)) {
					$this->Session->setFlash(__('The location has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The location could not be saved. Please, try again.', true));
				}
			}
		} else {
			//must be admin to edit locations
			$this->Session->setFlash(__('You do not have access to this.', true));
			$this->redirect(array('controller'=>'listings','action' => 'index'));
		}//endif
	}

	function edit($id = null) {
		if ($this->Auth->user('role')>9) {
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid location', true));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->data)) {
				if ($this->Location->save($this->data)) {
					$this->Session->setFlash(__('The location has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The location could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Location->read(null, $id);
			}
		} else {
			//must be admin to edit locations
			$this->Session->setFlash(__('You do not have access to this.', true));
			$this->redirect(array('controller'=>'listings','action' => 'index'));
		}//endif
	}

	function delete($id = null) {
		if ($this->Auth->user('role')>9) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for location', true));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->Location->delete($id)) {
				$this->Session->setFlash(__('Location deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Location was not deleted', true));
			$this->redirect(array('action' => 'index'));
		} else {
			//must be admin to edit locations
			$this->Session->setFlash(__('You do not have access to this.', true));
			$this->redirect(array('controller'=>'listings','action' => 'index'));
		}//endif
	}
}
?>