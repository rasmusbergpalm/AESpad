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
<?php echo '<h1>'.$html->link('Got a concern?</h1>','http://www.assembla.com/spaces/aespad/support/tickets', array('escape'=>false)).'</h1>'; ?>
<?php
    App::import('Core',  'Xml');
    $concerns_xml = Set::reverse(new Xml("http://www.assembla.com/spaces/aespad/tickets/custom_report/18687.xml"));
    //pr($concerns_xml);
    $concerns = array();
    if(empty($concerns_xml['Tickets']['Ticket'][0]['summary'])){
        $concerns[0] = $concerns_xml['Tickets']['Ticket'];    
    }else{
        $concerns = $concerns_xml['Tickets']['Ticket'];
    }
    foreach($concerns as $concern){
        echo "<div class='infobox'>";        
        echo "<h1>".$concern['summary']."</h1>";
        echo "<p>Severity: ".$concern['Custom-fields']['Custom-field'][1]['value'].". Occurence: ".$concern['Custom-fields']['Custom-field'][2]['value'].". Detectability: ".$concern['Custom-fields']['Custom-field'][3]['value'].". Risk priority number: ".$concern['Custom-fields']['Custom-field'][4]['value']."</p>";
        echo nl2br($concern['description']);
        echo "</div>";
    }
?>