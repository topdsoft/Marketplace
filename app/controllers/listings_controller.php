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
			$this->set('role', $this->Auth->user('role'));
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
		//validate listing ownership
		$uid=$this->Auth->user('id');
		$q=$this->Listing->query("select * from listings where id=$id and user_id=$uid limit 1");
		if (!$q) {
			$this->Session->setFlash(__('Invalid id for listing', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Listing->delete($id)) {
			//also delete any image files
			$q=$this->Listing->query("select * from images where listing_id=$id");
			if ($q) {
				//delete all files
				foreach($q as $img) unlink(WWW_ROOT.'files/'.$img['images']['filename']);
				$this->Listing->query("delete from images where listing_id=$id");
			}
			$this->Session->setFlash(__('Listing deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Listing was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function upload($id=null) {
		if ($this->data) $id=$this->data['Listing']['listingID'];
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for listing', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->data) {
			// Validate the type. Should be JPEG or PNG.
			$allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
//			debug($_FILES);exit();
			if (in_array($_FILES['data']['type']['Listing']['upload'], $allowed)) {
				// Move the file over.
				if (move_uploaded_file ($_FILES['data']['tmp_name']['Listing']['upload'], WWW_ROOT."files/$id{$_FILES['data']['name']['Listing']['upload']}")) {
					$this->Session->setFlash(__('The file has been uploaded.', true));
					//add to images
					$this->Listing->query("insert into images (filename,created,listing_id) values ('$id{$_FILES['data']['name']['Listing']['upload']}',now(),$id)");
					$this->redirect(array('action'=>'edit',$id));
				} // End of move... IF.
			} else { // Invalid type.
				$this->Session->setFlash(__('Please upload a JPEG or PNG image.', true));
			}//endif
		}
		$this->set('listingID',$id);
		$this->set('role', $this->Auth->user('role'));
	}
	
	function delImage($id=null) {
		if (!$id) {
			$this->redirect(array('action'=>'index'));
		}
		//validate $id
		$uid=$this->Auth->user('id');
		$q=$this->Listing->query("select * from images,listings where images.id=$id and images.listing_id=listings.id and listings.user_id=$uid limit 1");
		if($q) {
			//ok remove file
			unlink(WWW_ROOT.'files/'.$q[0]['images']['filename']);
			//and remove image entry
			$this->Listing->query("delete from images where id=$id limit 1");
			$this->redirect(array('action'=>'edit',$q[0]['listings']['id']));
		} else $this->redirect(array('action'=>'index'));
		debug($q);
		exit();
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