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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
    	<title>
    		AESpad | <?php echo $title_for_layout; ?>
    	</title>
        <?php
            echo $html->meta('icon');
            echo $html->css('color2/style');
            echo $html->css('color2/color2');
            echo $html->css('color2/changes');
    		echo $scripts_for_layout;
    		echo $javascript->link('prototype');
    		echo $javascript->link('scriptaculous');
    		echo $javascript->link('AES');
    		echo $javascript->link('SHA1');
    		echo $javascript->link('soundmanager2-nodebug-jsmin');
        ?>
        <script type="text/javascript">
            soundManager.url = '<?php echo $html->url("/soundmanager2.swf", true); ?>';
            soundManager.onload = function() {
                soundManager.createSound({
                    id: 'click',
                    url: '<?php echo $html->url("/click.mp3", true); ?>',
                    volume: 100
                });
            } 
        </script>
    </head>

    <body>
        <?php echo $html->image('beta.gif', array('style'=>"position: absolute; right: 0px; top: 0px; z-index: 10; margin: 0px; padding: 0px;")); ?>
        <div id="main">
            <div id="menubar">

                <div>
                    <a href='/' style='text-decoration: none;'>
                    <?php echo $html->image('078082-black-white-pearl-icon-business-lock6-sc48.png', array('style'=>"height: 72px; float: left; margin: 0px; padding: 0px;")); ?>
                    <div style='float: left; margin: 10px 0px 0px 0px; padding: 0px;'>
                        <h1 style='color: white; font-size: 300%; text-transform: none; display: inline;'>AESpad</h1>
                    </div>
                    </a>
                </div>
                
            </div>
            <div id="site_content" style='border-radius: 15px 15px 0px 0px; -moz-border-radius: 15px 15px 0px 0px; '>
                <div id="content" >
                    <?php echo $content_for_layout; ?>
                </div>
            
            </div>
            
            <div id="footer" style='border-radius: 0px 0px 15px 15px; -moz-border-radius: 0px 0px 15px 15px;'>
                <div class='column'>
                    <ul>
                        <li class='header'>
                            AESpad
                        </li>
                        <li>
                            <?php echo $html->link('Security', '/pages/security'); ?>
                        </li>
                        <li>
                            <?php echo $html->link('How it works', '/pages/innerworkings'); ?>
                        </li>
                        <li>
                            <?php echo $html->link('Concerns', '/pages/concerns'); ?>
                        </li>
                    </ul>
                </div>
                <div class='column'>
                    <ul>
                        <li class='header'>
                            Community
                        </li>
                        <li>
                            Forums
                        </li>
                        <li>
                            <?php echo $html->link('Twitter', 'http://twitter.com/aespad'); ?>
                        </li>
                        <li>
                            <?php echo $html->link('Facebook', 'http://www.facebook.com/pages/AesPad/164095313611854'); ?>
                        </li>
                    </ul>
                </div>
                <div class='column'>
                    <ul>
                        <li class='header'>
                            Code
                        </li>
                        <li>
                            <?php echo $html->link('Source', 'http://www.assembla.com/code/aespad/subversion/nodes'); ?>
                        </li>
                        <li>
                            Docs
                        </li>
                        <li>
                            Join
                        </li>
                    </ul>
                </div>
                <div class='column'>
                    <ul>
                        <li class='header'>
                            About
                        </li>
                        <li>
                            About AESpad
                            <?php //echo $html->link('About AESpad', '/pages/about'); ?>
                        </li>
                        <li>
                            <?php echo $html->link('Credits', '/pages/credits'); ?>
                        </li>
                        <li>
                            Ethics
                            <?php //echo $html->link('Ethics', '/pages/ethics'); ?>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>               