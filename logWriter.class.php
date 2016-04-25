<?php
/**
log writer object

USAGE:
$errorLog = new logWriter('error.log', 'logs/');
$errorLog -> put('test');
*/
class logWriter{
    private $folder;
    private $default_filename;
    public $off;
    public $format = '{date} {ip} {str}';
    function __construct($filename = null, $folder = 'logs', $off = false, $format = null){
        if(substr($folder, -1) != '/'){
            $folder .= '/';
        }
        if($filename === null){
            $filename = 'log-'.date('Y.m.d').'.log';
        }
        $this -> folder = $folder;
        $this -> default_filename = $filename;
        $this -> off = !!$off;
        if($format !== null){
            $this -> format = $format;
        }
    }
    /**
    write text to log file

    $filename - custom filename of log-file
    $return - if true - method will return log string, if false - write to file
    */
    public function put($str, $filename = null, $return = false){
        if($this -> off){
            return;
        }
        if($filename === null){
            $filename = $this -> default_filename;
        }
        if(is_scalar($str) === false){
            $str = print_r($str, true);
        }
        $date = date('Y-m-d H:i:s');
        $ip = $this -> getClientIP();
        $log_str = strtr($this -> format, array('{ip}' => $ip, '{date}' => $date, '{str}' => $str))."\n";
        if($return === false){
            try{
                @file_put_contents($this -> folder.$filename, $log_str, FILE_APPEND);
            }catch(Exception $e){
                // report about error
            }
            return null;
        }else{
            return $log_str;
        }
    }
    function put_inline($str, $filename = null){
        if($this -> off){
            return;
        }
        if($filename === null){
            $filename = $this -> default_filename;
        }
        if(is_scalar($str) === false){
            $str = print_r($str, true);
        }
        try{
            @file_put_contents($this -> folder.$filename, $str, FILE_APPEND);
        }catch(Exception $e){
            // report about error
        }
    }    
    private function getClientIP(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
?>
