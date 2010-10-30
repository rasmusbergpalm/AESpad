<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
    	<title>
    		Obscura | <?php echo $title_for_layout; ?>
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
        ?>
    </head>

    <body>
        <div id="main">
            <div id="menubar">
            </div>
            <div id="site_content">
                <div id="content">
                    <p class='flash_messages'>
                        <?php echo $this->Session->flash(); ?>
                    </p>
                    <?php echo $content_for_layout; ?>
                </div>
            
            </div>
            
            <div id="footer">
                OBSCURA by <a href='http://bergpalm.dk'>Rasmus Berg Palm</a>
                |
                design by <a href="http://www.dcarter.co.uk">dcarter</a> 
                | 
                <a href="http://www.movable-type.co.uk/">AES & SHA1 javascript implementation</a> © 2005-2010 Chris Veness
            </div>
        
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>               