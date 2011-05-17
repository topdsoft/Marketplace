<?php
class MessagesController extends AppController {

	var $name = 'Messages';

	function index() {
		$this->Message->recursive = 0;
		$this->paginate=array('conditions'=>'Message.user_id='.$this->Auth->user('id'));
		$this->set('messages', $this->paginate());
	}

	function view($id = null) {
		//validate that this message is to current user
		$q=$this->Message->find('first',array('conditions'=>array("Message.user_id=".$this->Auth->user('id'),"Message.id=$id")));
		if (!$q) unset($id);
		if (!$id) {
			$this->Session->setFlash(__('Invalid message', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('message', $this->Message->read(null, $id));
		$this->Message->query("update messages set messages.read=now() where id=$id limit 1");
	}

	function add($id=null) {
		//id is user_id for whom message is sent to
		if (!empty($this->data)) $id=$this->data['Message']['user_id'];
		if ($id) {
			$this->set('to_id',$id);
			$this->set('uid',$this->Auth->user('id'));
			if (!empty($this->data)) {
				$this->Message->create();
				if ($this->Message->save($this->data)) {
					$this->Session->setFlash(__('The message has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The message could not be saved. Please, try again.', true));
				}
			}
//			$users = $this->Message->User->find('list');
//			$froms = $this->Message->From->find('list');
//			$this->set(compact('users', 'froms'));
			$this->set('uname',$this->Message->User->find('first',array('fields' => array('User.username'),'conditions' => array('User.id='.$id))));
		} else {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid message', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash(__('The message has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Message->read(null, $id);
		}
		$users = $this->Message->User->find('list');
		$froms = $this->Message->From->find('list');
		$this->set(compact('users', 'froms'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for message', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Message->delete($id)) {
			$this->Session->setFlash(__('Message deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Message was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>