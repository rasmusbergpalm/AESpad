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
	var $components = array('Session', 'RequestHandler', 'Base62');
	
    public function signin($chat_id = null, $author = null, $keyhash = null){
        $chat_id = $this->Base62->decode($chat_id);
        list($chat_id, $author, $keyhash) = $this->paranoid(array($chat_id, $author, $keyhash));
        
        if(!empty($chat_id) && !empty($author) && !empty($keyhash)){
            $chat = $this->Chat->read(null,  $chat_id);
            if(empty($chat['Chat']['keyhash'])){ //Chat.keyhash empty
                if($this->Session->read("chat_$chat_id.owner") == true){//is owner of chat 
                    $this->Session->write("chat_$chat_id.access", true);
                    $this->Session->write("chat_$chat_id.author", $author);
                    $this->Chat->Message->create();
                    $this->data = array(
                        'Chat' => array(
                            'id' => $chat_id,
                            'keyhash' => $keyhash 
                        )
                    );
                    $this->Chat->save($this->data);
                }
            }elseif($chat['Chat']['keyhash'] === $keyhash){ //Chat.keyhash not empty AND keyhash right  
                    $this->Session->write("chat_$chat_id.access", true);
                    $this->Session->write("chat_$chat_id.author", $author);
            }else{
                header('HTTP/1.1 403 Forbidden');
                echo "Wrong key. Access denied.";
                exit;
            }
        }else{
            header('HTTP/1.1 403 Forbidden');
            echo "You need to supply chat_id, author and key";
            exit;        
        }                
    }
   
    public function cleanup(){
        if((time()-Cache::read('cleanup')) > 43200){
            $all_chats =  $this->Chat->find('count');
            $started_chats =  $this->Chat->find('count', array('conditions' => array('keyhash' => 'NOT NULL')));
            $all_messages = $this->Chat->Message->find('count');
            file_put_contents(LOGS.'activity.csv',date('d-m-Y').";$all_chats;$started_chats;$all_messages\n",FILE_APPEND); 
            $this->Chat->deleteAll(array(
                'Chat.updated <' => date('Y-m-d H:i:s', strtotime('-24 hours'))           
            ));            
            Cache::write('cleanup', time());
        }
    }
    
   public function view($chat_id = null) {
        $chat_id = $this->Base62->decode($chat_id);
        list($chat_id) = $this->paranoid(array($chat_id));

        if (empty($chat_id)) {
			$this->Session->setFlash(__('Invalid Chat.', true));
			$this->redirect(array('controller' => 'pages', 'action' => 'display', 'index'));
		}
		
        $keyhash = $this->Chat->field('keyhash', array('id' => $chat_id));
        $this->set('chat_id', $this->Base62->encode($chat_id));
        $this->set('keyhash_empty', empty($keyhash));
        $this->set('owner', $this->Session->read("chat_$chat_id.owner"));
	}

	public function create(){
		$this->Chat->create();
        $this->Chat->save(array('Chat' => array('id' => null, 'password' => null, 'updated' => null)));
		$chat_id = $this->Chat->getLastInsertId();
		$this->Session->write("chat_$chat_id.owner", true);
		$this->redirect(array('controller'=>'chats', 'action'=>'view', $this->Base62->encode($chat_id)));
	}

}
