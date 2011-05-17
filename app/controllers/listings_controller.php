<?php
class ListingsController extends AppController {

	var $name = 'Listings';

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index','view');
	} 

	function index() {
		$this->Listing->recursive = 0;
		//check for serach
		if ($this->data && !empty($this->data['Listing']['search'])) {
			//add search criteria
			$this->paginate=array('order'=>'Listing.created desc','conditions' => array('text like' => '%'.$this->data['Listing']['search'].'%'));
		} else $this->paginate=array('order'=>'Listing.created desc');
		$this->set('listings', $this->paginate());
		$this->set('role', $this->Auth->user('role'));
		$this->set('uid', $this->Auth->user('id'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid listing', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('listing', $this->Listing->read(null, $id));
		$this->set('role', $this->Auth->user('role'));
		$this->set('uid', $this->Auth->user('id'));
		$r=$this->Listing->read('category_id', $id);
		$this->set('catName',$this->getTrail($r['Listing']['category_id']));
	}

	function add($id = null) {
		if ($this->data['Listing']) $id=$this->data['Listing']['category_id'];
		if ($id) {
			if (!empty($this->data)) {
				$this->Listing->create();
				if ($this->Listing->save($this->data)) {
					$this->Session->setFlash(__('The listing has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The listing could not be saved. Please, try again.', true));
				}
			}
			$users = $this->Listing->User->find('list');
			$locations = $this->Listing->Location->find('list');
			$categories = $this->Listing->Category->find('list');
			$this->set(compact('users', 'locations', 'categories'));
			$this->set('cat',$id);
			$this->set('catName',$this->getTrail($id));
			$this->set('role', $this->Auth->user('role'));
		} else {
			//no ID so redirect to getCat
			$this->redirect(array('action' => 'getCat'));
		}//endif $id set
	}
	
	function getCat($id = null) {
		/**
		$id=selected category
		**/
		if ($this->data) {
			//picked category
			$this->redirect(array('action'=>'add',$this->data['Listing']['cat_id']));
		} else {
			//no selection
			$this->set('role', $this->Auth->user('role'));
			$this->set('cat',$id);
			if ($id) $r=$this->Listing->query("select * from categories where parent_id=".$id);
			else $r=$this->Listing->query("select * from categories where parent_id=0");
			//$r=$r[0];
			$this->set('catList',$r);
			if ($id) $r=$this->Listing->query("select * from categories where id=$id limit 1");
			else $r=null;
			$this->set('root',$r[0]['categories']);
//			print_r($r);
		}//endif
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid listing', true));
			$this->redirect(array('action' => 'index'));
		}
		$r=$this->Listing->read('user_id',$id);
		if ($this->Auth->user('id')==$r['Listing']['user_id']) {
			if (!empty($this->data)) {
				if ($this->Listing->save($this->data)) {
					$this->Session->setFlash(__('The listing has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The listing could not be saved. Please, try again.', true));
				}
			}
			if (empty($this->data)) {
				$this->data = $this->Listing->read(null, $id);
			}
			$users = $this->Listing->User->find('list');
			$locations = $this->Listing->Location->find('list');
			$categories = $this->Listing->Category->find('list');
			$this->set(compact('users', 'locations', 'categories'));
		} else {
			$this->Session->setFlash(__('This is not your listing', true));
			$this->redirect(array('action' => 'index'));
		}//endif
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for listing', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Listing->delete($id)) {
			$this->Session->setFlash(__('Listing deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Listing was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	protected function getTrail($id) {
		/**
		functions returns a trail of nested categories  ex: auto->used->ford->mustang
		**/
		$r=$this->Listing->query("select * from categories where id=$id limit 1");
		$r=$r[0]['categories'];
		if ($r['parent_id']==0) return $r['name'];
		else return $this->getTrail($r['parent_id']).'->'.$r['name'];
	}//end protected function getTrail
}
?>