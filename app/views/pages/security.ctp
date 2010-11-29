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
<div class='infobox image' style='background: url(../img/090348-black-white-pearl-icon-signs-nosign.png) no-repeat 105% 5%'>
    <h1>Not proven secure. Yet.</h1>
    <ul style='width: 350px;'>
        <li>AESpad was created by a single person which is in essence an amateur security enthusiast.</li>
        <li>AESpad is not tried, tested and proven such as other crypthographic software out there.</li>
        <li>You should take a look at the <?php echo $html->link('inner workings', '/pages/innerworkings'); ?> to understand why I think AESpad is pretty secure after all.</li>
        <li>You should take a look at the <?php echo $html->link('list of concerns', '/pages/concerns'); ?> to see what concerns the community and I have.</li>
        <li>You should decide for yourself whether you think AESpad is secure.</li>
        <li>You should look into <?php echo $html->link('other software', 'http://en.wikipedia.org/wiki/Secure_communication#Programs_offering_more_secure_communications'); ?> if you're not comfortable with using AESpad.</li>
    </ul>
</div>
<div class='infobox image' style='background: url(../img/078062-black-white-pearl-icon-business-key1.png) no-repeat 105% 5%'>
    <h1>At best, as secure as the key.</h1>
    <ul style='width: 350px;'>
        <li>AESpad relies on a pre-shared key between the chat participants.</li>
        <li>It is critical that this key is securely transmitted between participants, i.e. not over the internet!</li>
        <li>Preferably the key should be decided upon in face to face conversation.</li>
        <li>The key should be long and complex. A sentence is a good way to ensure this, eg. 'I like my privacy a lot!' which contains both uppercase, lowercase and special characters.</li>
    </ul>
</div>
