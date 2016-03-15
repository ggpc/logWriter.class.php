# logWriter.class.php
Utility to write advanced logs

# Usage
$errorLog = new logWriter('test.log', 'logs/');
$errorLog -> put('test');
$errorLog -> put(array(1,2,3));
