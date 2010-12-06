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
<?php echo $this->Html->script('ga', array('inline' => false)); ?>
<div style='left:0 auto; text-align: center;'>
Communicating in a secure and private manner online is difficult.<br />
AESpad makes it easy. No download, no setup, just chat.<br /><br />
<?php
    echo "<h1>1. Check out the ".$html->link('Interactive demo' , array('controller' => 'pages', 'action' => 'display', 'demo'), array('style'=>'color: #363636', 'onclick'=>'Modalbox.show(this.href,{title:"Interactive demo",width:700}); return false;')).'</h1><br />';
    echo '<h1>2. '.$html->link('Create secure chat' , array('controller' => 'chats', 'action' => 'create'), array('style'=>'color: #363636;', 'onclick' => "javascript: pageTracker._trackPageview('/chats/create');")).'</h1><br />';
    echo $html->link($html->image("078082-black-white-pearl-icon-business-lock6-sc48.small.png", array('style' => 'height: 300px;')) , array('controller' => 'chats', 'action' => 'create'), array('escape' => false, 'onclick' => "javascript: pageTracker._trackPageview('/chats/create');"));
    
?>

</div>
<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Faespad.com&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
