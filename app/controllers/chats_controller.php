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
class ChatsController extends AppController {

	public $helpers = array('Html', 'Form');
	
    function signin($chat_id = null, $author = null, $password = null){
        list($chat_id, $author, $password) = $this->paranoid(array($chat_id, $author, $password));
        if(!empty($chat_id) && !empty($author)  && !empty($password)){
            if($this->Session->read("chat_$chat_id.owner") == true){
                $this->Session->write("chat_$chat_id.access", true);
                $this->Session->write("chat_$chat_id.author", $author);
                $this->Chat->Message->create();
                $this->data = array(
                    'Chat' => array(
                        'id' => $chat_id,
                        'password' => $password 
                    )
                );
                $this->Chat->save($this->data);
            }else{
                $chat = $this->Chat->read(null, $chat_id);
                if(!empty($chat['Chat']['password']) && $chat['Chat']['password'] === $password){
                    $this->Session->write("chat_$chat_id.access", true);
                    $this->Session->write("chat_$chat_id.author", $author);
                }else{
                    header('HTTP/1.1 403 Forbidden');
                    echo "Wrong key. Access denied.";
                    exit;
                }
            }
        }else{
            header('HTTP/1.1 403 Forbidden');
            exit;        
        }                
    }  
    
   function view($chat_id = null) { //TODO: Think up some way of not letting the user know whether chat X exists. Right now he can see it on the salt and id not being set
        list($chat_id) = $this->paranoid(array($chat_id));

        if (empty($chat_id)) {
			$this->Session->setFlash(__('Invalid Chat.', true));
			$this->redirect(array('controller' => 'pages', 'action' => 'display', 'index'));
		}
        $this->set('owner', $this->Session->read("chat_$chat_id.owner"));
        $this->set('Chat', $this->Chat->read(null, $chat_id));                    
	}

	function create(){
		$this->Chat->create();
        $this->Chat->save(array('Chat' => array('id' => null, 'salt' => Security::hash(microtime().rand(1000000, 9999999)))));
		$id = $this->Chat->getLastInsertId();
		$this->Session->write("chat_$id.owner", true);
		$this->redirect(array('controller'=>'chats', 'action'=>'view', $id));
	}

}
