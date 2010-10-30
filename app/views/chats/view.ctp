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

<script type='text/javascript'>
    
    function periodicalUpdater(message_id) {
        
        new Ajax.Request('/obscura/messages/messages/<?php echo $Chat["Chat"]["id"] ?>/'+message_id, {
            method: 'get',
            onSuccess: function(transport) {
                messages = eval('(' + transport.responseText + ')');
                if (messages.length >= 1) {
                    message_id = messages[messages.length-1].Message.id;
                    
                    messages.each(function(s) {
                        var message_div = new Element('div', { 'id': 'message'+s.Message.id, }).update(decrypt(s.Message.author) + ': ' + nl2br(decrypt(s.Message.message)));
                        $('messages').insert({bottom: message_div});
                    });
                    myScrollTo('messages','message'+message_id);

                }
                setTimeout(periodicalUpdater(message_id), 1000);
            }
        });
    }
    
    function encryptAndSubmit(){
        var password = $('password').value + "<?php echo $Chat['Chat']['salt'] ?>";
        $('MessageMessage').value = Aes.Ctr.encrypt($('MessageMessage').value, password, 256);
        $('MessageAddForm').request();
        $('MessageMessage').value = '';
    }
    
    function decrypt(ciphertext){
        var password = $('password').value + "<?php echo $Chat['Chat']['salt'] ?>";
        var plaintext = Aes.Ctr.decrypt(ciphertext, password, 256);
        return plaintext;   
    }
    
    function nl2br (str) {
        // http://kevin.vanzonneveld.net
        // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Philip Peterson
        // +   improved by: Onno Marsman
        // +   improved by: Atli Þór
        // +   bugfixed by: Onno Marsman
        // +      input by: Brett Zamir (http://brett-zamir.me)
        // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +   improved by: Brett Zamir (http://brett-zamir.me)
        // +   improved by: Maximusya
        // *     example 1: nl2br('Kevin\nvan\nZonneveld');
        // *     returns 1: 'Kevin<br />\nvan<br />\nZonneveld'
        // *     example 2: nl2br("\nOne\nTwo\n\nThree\n", false);
        // *     returns 2: '<br>\nOne<br>\nTwo<br>\n<br>\nThree<br>\n'
        // *     example 3: nl2br("\nOne\nTwo\n\nThree\n", true);
        // *     returns 3: '<br />\nOne<br />\nTwo<br />\n<br />\nThree<br />\n'
    
        var breakTag = '<br />';
    
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
    }
    
    function myScrollTo(container, element){
        container = $(container); 
        element = $(element); 
        var x = element.x ? element.x : element.offsetLeft,
            y = element.y ? element.y : element.offsetTop;
        container.scrollLeft=x-(document.all?0:container.offsetLeft );
        container.scrollTop=y-(document.all?0:container.offsetTop);
        return element;
    }
    
    function enterChat(){
        if($('name').value != '' && $('password').value != ''){
            var password = $('password').value + "<?php echo $Chat['Chat']['salt'] ?>";
        
            new Ajax.Request("/obscura/chats/signin/<?php echo $Chat['Chat']['id'] ?>", {
                method: 'post',
                parameters: "message="+Sha1.hash(password)+"&author="+Aes.Ctr.encrypt($('name').value, password, 256),
                onSuccess: function(transport){
                    Effect.BlindDown('messages', {afterFinish:function(){$('messages').style.overflow='auto'}});
                    periodicalUpdater(0);
                    Effect.BlindDown('addform');
                    Effect.BlindUp('enter');
                    $('addform').observe('keypress', keypressHandler);
                    $('shareurl').toggle();

                    function keypressHandler (event){
                        var key = event.which || event.keyCode;
                        switch (key) {
                            default:
                            break;
                            case Event.KEY_RETURN:
                                encryptAndSubmit(); return false;
                            break;   
                        }
                    }
                },
                onFailure: function(transport){
                    $('enter_warning').update(transport.responseText);
                    Effect.Appear('enter_warning');
                    $('enter_warning').highlight();    
                }
            });
            
        }else{
            $('enter_warning').update("You have to fill in both name and password");
            Effect.Appear('enter_warning');
            $('enter_warning').highlight();
        }
     
    }
</script>
<div id='shareurl' style='display: none;'>Send this URL to the persons you want to chat with <br /><input type='text' size='50' readonly value='<?php echo 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>' /></div>
<div id='messages' style='height: 300px; overflow: auto; display: none; text-align: left;'></div>


<div id='enter'>
    <div id='enter_warning' style='display: none;'></div>
    
    <p>This is a private, secure chat. Please supply the correct password to enter</p>
    <br />
    <input type='password' id='password' style='height: 22px; font-size: 22px; width: 200px;'/>
    <br />
    <input type='text' id='name' value='<type your name here>'/>
    <br />
    <button type='button' onclick='enterChat();'>Enter</button>
</div>
 
<div id='addform' style='display: none'>
    <div class="messages form">
        <?php echo $form->create('Message', array('action' => 'add'));?>
    
        	<?php
        		echo $form->input('chat_id', array('type' => 'hidden', 'value' => $Chat['Chat']['id']));
                echo $form->input('message', array('label' => false));
        	?>
    
        <?php //echo $form->button('Submit', array('type'=> 'button', 'onclick'=> 'encryptAndSubmit();'));?>
        <?php echo $form->end();?>
    </div>
</div>