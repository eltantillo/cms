<?php
function saveFile($type, $name) {
    $target_Path = "../files/";
	$target_Path = $target_Path.basename( $name );
	move_uploaded_file( $_FILES[$type]['tmp_name'], $target_Path );
}
?>