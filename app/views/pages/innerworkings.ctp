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
<div class='infobox image' style='background: url(../img/078043-black-white-pearl-icon-business-gears-sc37.png) no-repeat 105% 5%'>
    <h1>Uses top grade encryption.</h1>
    <ul style='width: 350px;'>
        <li>AESpad uses the <?php echo $html->link('AES', 'http://en.wikipedia.org/wiki/Advanced_Encryption_Standard'); ?> encryption algorithm, which is good enough for 'Top Secret' documents according to the NSA.</li>
        <li>AESpad uses 256 bit key lengths, the most secure way to use AES.</li>
    </ul>
</div>
<div class='infobox image' style='background: url(../img/078053-black-white-pearl-icon-business-home6.png) no-repeat 105% 5%'>
    <h1>Your key and plaintext never <br />leaves your computer.</h1>
    <ul style='width: 350px;'>
        <li>AESpad encrypts all messages before they are sent to the server.</li>
        <li>AESpad never sends your key to the server. You enter it locally and it stays there.</li>
        <li>In other words, everything that leaves your computer is incomprehensible gorb.</li>
        <li>Noone, not even the server admin can read your messages. The only thing stored in the database is encrypted messages. Utterly incomprehensible gorb without the key.</li>
    </ul>
</div>
<div class='infobox image' style='background: url(../img/017654-black-white-pearl-icon-symbols-shapes-comment-bubbles.png) no-repeat 105% 5%'>
    <h1>Open source project. Peer reviewed.</h1>
    <ul style='width: 350px;'>
        <li>AESpad's source code is freely available for download and review.</li>
        <li>No backdoors, no master keys. Take a look for yourself.</li>
        <li>If you don't trust this AESpad server, you can host one yourself.</li>
        <li>Open policy: All concerns raised by the community are made available <?php echo $html->link('here', 'pages/concerns'); ?>.</li>
    </ul>
</div>
