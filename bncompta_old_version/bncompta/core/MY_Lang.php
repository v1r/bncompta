<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH."MX/Lang.php";

class MY_Lang extends MX_Lang{

    function line($line, $params=null){

        $return = parent::line($line);
            
        if($return === false){
            return "!-- $line --!";
        }else{
            if (!is_null($params)){
                $return = $this->_ni_line($return, $params); 
            }
            return $return;
        }

    }
    
    private function _ni_line($str, $params){
        $return = $str;
        
        $params = is_array($params) ? $params : array($params);   
        
        $search = array();
        $cnt = 1;
        foreach($params as $param){
            $search[$cnt] = "/\\\${$cnt}/";
            $cnt++;
        }
                
        unset($search[0]);
        
        $return = preg_replace($search, $params, $return);
        
        return $return;
    }
}  
?>