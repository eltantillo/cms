<?php
unset($_SESSION['id']);
echo '<script> location.replace("' . $_SERVER['HTTP_REFERER'] . '"); </script>';
?>