<?php
/*
Copyright 2010 Rasmus Berg Palm 

This file is part of AESpad.

AESpad is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

AESpad is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with AESpad.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
class MessagesController extends AppController {

	public $helpers = array('Html', 'Form');

	function messages($chat_id = null, $message_id = null){
        list($chat_id, $message_id) = $this->paranoid(array($chat_id, $message_id));
        if($this->Session->read("chat_$chat_id.access") != true) exit;
        
        $this->set('messages', $this->Message->find('all', array(
            'conditions' => array(
                'Message.chat_id' => $chat_id,
                'Message.id > ' => $message_id            
            ),
            'contain' => array()
        )));    
    }
    
    function add() {
        list($chat_id, $message) = $this->paranoid(array($this->data['Message']['chat_id'], $this->data['Message']['message']));
        if($this->Session->read("chat_$chat_id.access") != true) exit;    
        
        if (!empty($chat_id) && !empty($message)) {  
            $data['Message']['chat_id'] = $chat_id;
            $data['Message']['author'] = $this->Session->read("chat_$chat_id.author");
            $data['Message']['message'] = $message;                        
            $this->Message->create();
            if ($this->Message->save($data)) {
                //$this->Session->setFlash(__('The Message has been saved', true));
            } else {
                //$this->Session->setFlash('The Message could not be saved. Please, try again.', true, array('class' => 'error_message'));
            }
        }
    }


}
