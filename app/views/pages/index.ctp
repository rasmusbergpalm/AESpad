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
<div style='left:0 auto; text-align: center;'>
AESpad is a secure, private, use-and-dispose online chat.
<br />
 
<br />
<?php
    
    echo $html->link($html->image("078082-black-white-pearl-icon-business-lock6-sc48.small.png", array('style' => 'height: 300px;'))."<br /><h1>Create secure chat.</h1>" , array('controller' => 'chats', 'action' => 'create'), array('escape' => false, 'style'=>'text-decoration: none;'));
?>
</div>