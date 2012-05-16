<?php
/**
  * Debug Helper
  *
  * Outputs the given variable(s) with formatting and location
  *
  * @access        public
  * @param        mixed    variables to be output
  */
function dump()
{
    list($callee) = debug_backtrace();
    $arguments = func_get_args();
    $total_arguments = count($arguments);

    echo '<fieldset style="background: #fefefe !important; border:2px red solid; padding:5px;font-size:12px;">';
    echo '<legend style="background:lightgrey; padding:5px;">'.$callee['file'].' @ line: '.$callee['line'].'</legend><pre>';
    $i = 0;
    foreach ($arguments as $argument)
    {
        echo '<br/><strong>Debug #'.(++$i).' of '.$total_arguments.'</strong>: ';
        var_dump($argument);
    }

    echo "</pre>";
    echo "</fieldset>";
}
?>