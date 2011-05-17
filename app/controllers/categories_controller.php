<?php
class CategoriesController extends AppController {

	var $name = 'Categories';

	function index() {
//		$this->Category->moveup(1,1);
//		$this->Category->reorder();
		if ($this->Auth->user('role')>9) {
			$this->Category->recursive = 0;
//			$this->paginate['Category'] = array('order'=>array('Category.lft asc')); 
			$this->set('categories',$this->Category->generatetreelist(null,null,null," - "));
//			$this->set('categories', $this->paginate());
//			       $this->data = $this->Category->generatetreelist(null, null, null, '&nbsp;&nbsp;&nbsp;');        debug ($this->data);  
		} else {
			//must be admin to edit locations
			$this->Session->setFlash(__('You do not have access to this.', true));
			$this->redirect(array('controller'=>'listings','action' => 'index'));
		}//endif
	}
	
	function mod() {
		$this->Category->id = 9;
		$this->Category->save(array('parent_id' => 1)); 
		$this->redirect(array('action' => 'index'));
	}

	function view($id = null) {
		if ($this->Auth->user('role')>9) {
			if (!$id) {
				$this->Session->setFlash(__('Invalid category', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->set('category', $this->Category->read(null, $id));
		} else {
			//must be admin to edit locations
			$this->Session->setFlash(__('You do not have access to this.', true));
			$this->redirect(array('controller'=>'listings','action' => 'index'));
		}//endif
	}

	function add() {
		if ($this->Auth->user('role')>9) {
			if (!empty($this->data)) {
				$this->Category->create();
				if ($this->Category->save($this->data)) {
					$this->Session->setFlash(__('The category has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
				}
			}
			$nodelist = $this->Category->generatetreelist(null,null,null," - ");
			$nodelist[0]='[No Parent]';
//			$this->set('parents',$this->Category->generatetreelist());
			$this->set('parents',($nodelist));
		} else {
			//must be admin to edit locations
			$this->Session->setFlash(__('You do not have access to this.', true));
			$this->redirect(array('controller'=>'listings','action' => 'index'));
		}//endif
	}

	function edit($id = null) {
		if ($this->Auth->user('role')>9) {
			if (!$id && empty($this->data)) {
				$this->Session->setFlash(__('Invalid category', true));
				$this->redirect(array('action' => 'index'));
			}
			if (!empty($this->data)) {
				if ($this->Category->save($this->data)) {
					$this->Session->setFlash(__('The category has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Category->read(null, $id);
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
				$this->Session->setFlash(__('Invalid id for category', true));
				$this->redirect(array('action'=>'index'));
			}
			if ($this->Category->delete($id)) {
				$this->Session->setFlash(__('Category deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Category was not deleted', true));
			$this->redirect(array('action' => 'index'));
		} else {
			//must be admin to edit locations
			$this->Session->setFlash(__('You do not have access to this.', true));
			$this->redirect(array('controller'=>'listings','action' => 'index'));
		}//endif
	}
}
?>