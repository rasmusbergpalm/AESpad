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
class Chat extends AppModel {

    var $actsAs = array('Containable');
    
    var $hasMany = array(
		'Message' => array('className' => 'Message',
							'foreignKey' => 'chat_id',
							'dependent' => true,
							'conditions' => '',
							'fields' => '',
							'order' => '',
							'limit' => '',
							'offset' => '',
							'exclusive' => '',
							'finderQuery' => '',
							'counterQuery' => ''
		)
	);
}
