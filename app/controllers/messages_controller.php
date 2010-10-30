<?php
/*
Copyright 2010 Rasmus Berg Palm 

This file is part of AesPad.

AesPad is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

AesPad is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with AesPad.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
class MessagesController extends AppController {

	public $helpers = array('Html', 'Form');

	function messages($chat_id = null, $message_id = null){
        if($this->Session->read("chat_$chat_id.access") != true){
            exit;    
        }
        //Configure::write('debug', 0);
        $this->set('messages', $this->Message->find('all', array(
            'conditions' => array(
                'Message.chat_id' => $chat_id,
                'Message.id > ' => $message_id            
            ),
            'contain' => array()
        )));    
    }
    
    function add() {
		if (!empty($this->data)) {
            $chat_id = $this->data['Message']['chat_id'];
		    if($this->Session->read("chat_$chat_id.access") != true){
                exit;    
            }  
            $this->data['Message']['author'] = $this->Session->read("chat_$chat_id.author");
			$this->Message->create();
			if ($this->Message->save($this->data)) {
				//$this->Session->setFlash(__('The Message has been saved', true));
			} else {
				//$this->Session->setFlash('The Message could not be saved. Please, try again.', true, array('class' => 'error_message'));
			}
		}
	}


}
