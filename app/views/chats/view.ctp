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
<script type='text/javascript'>
/* <![CDATA[ */
    var message_focus = false;
    var message_id = 0;
    
    function updateChat() { 
        
        new Ajax.Request('<?php echo $html->url(array("controller" => "messages", "action" => "messages", $chat_id)); ?>/'+message_id, {
            method: 'get',
            onSuccess: function(transport) {
                msgs = transport.responseText.evalJSON();
                if (msgs.length >= 1) {
                    play_sound = false;
                    message_id = msgs[msgs.length-1].Message.id;
                   
                    msgs.each(function(s) {
                        author = decrypt(s.Message.author);
                        if($('name').value != author){
                            play_sound = true;    
                        }
                        var message_div = new Element('div', { 'id': 'message'+s.Message.id}).update('<strong>'+author + '</strong>: ' + nl2br(decrypt(s.Message.message)));
                        $('messages').insert({bottom: message_div});
                    });
                    if(play_sound==true){
                        soundManager.play('click'); 
                    }
                    myScrollTo('messages','message'+message_id);
                }
            }
        });
    }
    
    function encryptAndSubmit(){
        if($('MessageMessage').value != ''){
            var password = $('password').value;
            $('MessageMessage').value = Aes.Ctr.encrypt($('MessageMessage').value, password, 256);
            $('MessageAddForm').request();
            $('MessageMessage').value = '';
        }
    }
    
    function decrypt(ciphertext){
        var password = $('password').value;
        var plaintext = Aes.Ctr.decrypt(ciphertext, password, 256);
        return sanitize(plaintext);   
    }
    
    function sanitize(str){ //TODO: Will this really protect against all injection attacks?
        str = str.replace(/[<]/g, '&lt;');
        str = str.replace(/[>]/g, '&gt;');
        return str;
    }
    
    function enterChat(){
        if($('name').value != '' && $('password').value != ''){
            var password = $('password').value;
            new Ajax.Request("<?php echo $html->url(array('controller' => 'chats', 'action' => 'signin', $chat_id)); ?>/"+Aes.Ctr.encrypt($('name').value, password, 256)+"/"+Sha1.hash(password), {
                method: 'get',
                onSuccess: function(transport){
                    
                    $('MessageMessage').observe('focus', function(){message_focus = true});
                    $('MessageMessage').observe('blur', function(){message_focus = false});
                    Effect.BlindDown('messages', {afterFinish:function(){$('messages').style.overflow='auto'}});
                    new PeriodicalExecuter(updateChat, 1);
                    Effect.BlindDown('addform');
                    Effect.BlindUp('enter');
                    $('MessageMessage').onkeydown = function(e){
                        e = e || event;
                        if (!e.shiftKey && e.keyCode === 13) {
                            encryptAndSubmit();
                            return false;
                        }
                        return true;
                    }
                    $('shareurl').toggle();

                },
                onFailure: function(transport){
                    $('enter_warning').update(transport.responseText);
                    Effect.Appear('enter_warning');
                    $('enter_warning').highlight();    
                }
            });
            
        }else{
            $('enter_warning').update("You have to fill in both key and name");
            Effect.Appear('enter_warning');
            $('enter_warning').highlight();
        }
     
    }
    
    function testPassword(password){
        var goodPassword = /(?=^.{20,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z\s]).*$/;        
        if(goodPassword.test(password) == true){
            $("password_strength").update('Strong key.');
            $('password').setStyle({
              backgroundColor: '#D2F5D0'
            });
        }else{
            $('password').setStyle({
              backgroundColor: '#F5D0D0'
            });
            $("password_strength").update('Weak key.');
        }
    }
    
    function acceptTOS(){
        if($('accept_checkbox').checked==true){
            $("enterbutton").disabled="";
        }else{
            $("enterbutton").disabled="disabled";            
        }
    }
    
    Event.observe(window, 'load',
      function() { $('password').focus() }
    );
    
/* ]]> */
</script>

    <div id='shareurl' class='center' style='display: none;'>Send this URL to the persons you want to chat with.<br /><input type='text' size='50' readonly='readonly' value='<?php echo 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>' /></div>
    <div id='messages' class='center' style='height: 280px; padding: 2px; width: 400px; overflow: auto; display: none; text-align: left; margin-top: 8px; margin-bottom: 8px; border: 1px solid lightgrey;'></div>

    
    <div id='enter'>
        <div id='enter_warning' style='display: none;'></div>
        
        <?php if($owner && $keyhash_empty === true): ?>
            <h1>You are creating a chat.</h1>
            <br />
            <h2>You'll need to choose a key for this chat. The key will be needed to join the chat.</h2>
            <br /> 
            <?php echo $html->image('090383-black-white-pearl-icon-signs-warning-sign.png', array('style'=>'float: left; height: 200px;')); ?>
            <br />
            <h4>A warning about keys</h4>
            <p>
            If anyone gets hold of the key, they can read the chat.<br />
            It is critical that you do not transmit this key in an insecure way. No, the internet is not a secure way.<br />
            Preferably the key should have been decided upon beforehand in a face to face conversation.<br />
            Keys should be 20+ characters, have at least one capital letter, one small letter and one non letter. <br />
            </p>
            <br style='clear: both;'/>
            <br />
        <?php else: ?>
            <h1>You are trying to join a chat.</h1> 
            <p>
                This is a private, secure chat. Please supply the correct key to enter.
            </p>
            <br />
        <?php endif ?>
        <dl>
        <dt>Key</dt>
        <dd><input type='password' id='password' style='height: 22px; font-size: 22px; width: 300px;' onkeyup='javascript:testPassword(this.value);'/><span id='password_strength' style='margin-left: 6px;'></span></dd>
        <dt>Display name</dt>
        <dd><input type='text' id='name' style='height: 22px; font-size: 22px; width: 300px;' /></dd>
        </dl>
        <input type='checkbox' id='accept_checkbox' onclick='javascript:acceptTOS();' /> I have read and agree to the <?php echo $html->link('terms of service', array('controller' => 'pages', 'action' => 'display', 'terms'), array('onclick'=>'Modalbox.show(this.href,{title:"Terms of service",width:700}); return false;'));?>.        
        <br />
        <button type='button' id='enterbutton' disabled='disabled' onclick='javascript:enterChat();'>Enter</button>
    </div>
     
    <div id='addform' style='display: none'>
        <div class="messages form">
            <?php 
                echo $form->create('Message', array('action' => 'add'));
           		echo "<div class='center'>";
                echo $form->input('chat_id', array('type' => 'hidden', 'value' => $chat_id));
                echo $form->input('message', array('label' => false, 'style'=>'height: 4em; width: 400px;'));
                echo "</div>";
                echo $form->end();
            ?>
        </div>
    </div>
