<?php

abstract class DoctrineSqlLogger implements \Doctrine\DBAL\Logging\SQLLogger {

    private $log_dir = '/var/www/aims-core/logs/Doctrine/queries';

    public function startQuery($sql, array $params = null, array $types = null) {
        $now = new DateTime;
        $file_name = "{$this->log_dir}/{$now->format('d-m-Y')}.log";

        if (is_writable($this->log_dir)) {
            file_put_contents($file_name, "{$now->format('H:i:s')}: Executing query '{$sql}' with parameters " . implode(', ', $params));
        } else {
            die('Error: Unable to write to the Doctrine log file!');
        }
    }

}

?>
