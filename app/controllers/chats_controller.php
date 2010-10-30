<?php
/*
Copyright 2010 Rasmus Berg Palm 

This file is part of Obscura.

Obscura is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Obscura is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Obscura.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
class ChatsController extends AppController {

	public $helpers = array('Html', 'Form');
	
    function signin($chat_id = null){
        if(!empty($this->params['form'])){
            if($this->Session->read("chat_$chat_id.owner") == true){
                $this->Session->write("chat_$chat_id.access", true);
                $this->Session->write("chat_$chat_id.author", $this->params['form']['author']);
                $this->Chat->Message->create();
                $this->data = array(
                    'Chat' => array(
                        'id' => $chat_id,
                        'password' => $this->params['form']['message'] 
                    )
                );
                $this->Chat->save($this->data);
            }else{
                $chat = $this->Chat->read(null, $chat_id);
                if(!empty($chat['Chat']['password']) && $chat['Chat']['password'] === $this->params['form']['message']){
                    $this->Session->write("chat_$chat_id.access", true);
                    $this->Session->write("chat_$chat_id.author", $this->params['form']['author']);
                }else{
                    header('HTTP/1.1 403 Forbidden');
                    echo "Wrong password. Access denied.";
                    exit;
                }
            }
        }else{
            header('HTTP/1.1 403 Forbidden');
            exit;        
        }                
    }  
    
   function view($chat_id = null) {
    //pr($this->Session->read());
        if (!$chat_id) {
			$this->Session->setFlash(__('Invalid Chat.', true));
			$this->redirect(array('controller' => 'pages', 'action' => 'display', 'index'));
		}
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
