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

<script type='text/javascript'>
    updateMessages = function(){
        $('server_message').value = Aes.Ctr.encrypt($('alice_message').value,  $('alice_password').value, 256);
        updateBob();
    }
    
    updateBob = function(){
        $('bob_message').value = Aes.Ctr.decrypt($('server_message').value,  $('bob_password').value, 256);    
    }
    
    updateMessages();
       
</script>
<p style='margin-left: 8px;'>
Alice and Bob would like to communicate in a secure and private manner over the internet. 
<br />
Unfortunately, the internet is an insecure medium. Evesdropping is easy, and surveilance is institutionalized.  
<br /> 
As such Alice and Bob will need to employ encryption so that the messages exchanged can't be understood by evesdroppers.
<br />
The interactive demo below features the above example seen from Alice's, Bob's and the evedroppers point of view.
<br />
<strong>Fill in Alice's key and her message. Next, fill in Bob's key.</strong>
</p>
<div id='alice' style='clear: both'>
    <?php echo $html->image('060830-black-white-pearl-icon-people-things-people-woman2.png', array('style'=>'width: 120px;float: left;')); ?>
    <div style='float: left;'>
        <h1>Alice</h1>
        Alice's key<br />
        <input type='password' id='alice_password' onkeyup='updateMessages();' value='' /><br />
        Message<br />
        <textarea style='height: 4em; width: 400px;' id='alice_message' onkeyup='updateMessages();'></textarea>
    </div>
</div>
<div id='evesdropper' style='clear: both'>
    <?php echo $html->image('060821-black-white-pearl-icon-people-things-people-security.png', array('style'=>'width: 120px;float: left;')); ?>
    <div style='float: left;'>
        <h1>Evesdropper</h1>
        256-bit AES encrypted message<br />
        <textarea style='height: 4em; width: 400px;' id='server_message' readonly='readonly'></textarea>
    </div>
</div>
<div id='bob' style='clear: both'>
    <?php echo $html->image('060816-black-white-pearl-icon-people-things-people-man4.png', array('style'=>'width: 120px;float: left;')); ?>
    <div style='float: left;'>
        <h1>Bob</h1>
        Bob's key<br />
        <input type='password' id='bob_password' onkeyup='updateBob();'/><br /> 
        Message<br />
        <textarea style='height: 4em; width: 400px;' id='bob_message' readonly='readonly'></textarea>
    </div>
</div>
<br />