# logWriter.class.php
Utility to write advanced logs

# Usage
```php
<?php
$errorLog = new logWriter('test.log', 'logs/');
$errorLog -> put('test');
$errorLog -> put(array(1,2,3));

$errorLog -> put_inline('.');
$errorLog -> put_inline('.');
?>
```
