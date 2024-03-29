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
class Message extends AppModel {

    var $actsAs = array('Containable');

    var $belongsTo = array(
    			'Chat' => array('className' => 'Chat',
    								'foreignKey' => 'chat_id',
    								'dependent' => true,
    								'conditions' => '',
    								'fields' => '',
    								'order' => ''
    			)
    	);
    
    var $validate = array(
            'author' => array(
                'authorRule-1' => array(
                    'rule' => 'notempty',  
                    'message' => 'Author can\'t be empty'
                 ) 
            ),
            'message' => array(
                'messageRule-1' => array(
                    'rule' => 'notempty',  
                    'message' => 'Message can\'t be empty'
                 ) 
            )
        );
        
    public function afterSave(){
        $this->Chat->id = $this->data['Message']['chat_id'];
        $this->Chat->saveField('updated', date('Y-m-d H:i:s', time()));    
    }
}
