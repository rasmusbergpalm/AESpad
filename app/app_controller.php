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
<?php
App::import('Sanitize');
class AppController extends Controller {
    var $components = array('Session', 'RequestHandler');
    var $helpers = array('Html', 'Form', 'Ajax', 'Session', 'Javascript', 'Cache');

    function paranoid($vars){
        foreach($vars as &$var){
            $var = Sanitize::paranoid($var, array('.', '-', '='));
        }
        return $vars;    
    }
    
        
}
?>