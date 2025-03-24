  <?php
require 'database.php';

// Debugging: print the contents of $_POST
file_put_contents('debug.txt', print_r($_POST, true));

if (isset($_POST['UIDresult'])) {
    $UIDresult = $_POST['UIDresult'];
    $Write = "<?php $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('UIDContainer.php', $Write);
} else {
    // If UIDresult is not set, log an error
    file_put_contents('debug.txt', "UIDresult not set\n", FILE_APPEND);
}
?>  
