<?php echo $html->link('<h1>Got a concern?</h1>','http://www.assembla.com/spaces/aespad/support/tickets', array('escape'=>false)); ?>
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
<!--div class='infobox'>
    <h1>The client must trust the content sent by the server.</h1>
    <p>Severity: 10. Occurence: 8. Detectability: 5. Risk priority number: 400</p>
    <ul style='width: 350px;'>
        <li>Concern raised by <?php echo $html->link('Yakk', 'http://forums.xkcd.com/memberlist.php?mode=viewprofile&u=4253'); ?> in a xkcd forum thread <?php echo $html->link('here', 'http://forums.xkcd.com/viewtopic.php?f=11&t=65584'); ?>
        <li>If the AesPad server was compromised OR if a man-in-the-middle could intercept and change the http stream, the content sent to the client could be changed.</li>
        <li>Specifically, the javascript could be modified to send the keys or the plaintext messages to an attacker.</li>
        <li>Man-in-the-middle attack is mitigated by use of https and SSL certificates.</li>
        <li>The user could inspect everything sent by the server, but this is not practically possible.</li>
        <li>Automatic verification of the content sent should somehow be established. Ideas anyone?</li>
    </ul>
</div-->