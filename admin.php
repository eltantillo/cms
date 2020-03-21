<?php
include('controllers/config.php');
include('layout/admin/header.php');
include('controllers/admin/functions.php');
$password = '#Milagros2';

if (!isset($_SESSION['ID'])){
	if (isset($_POST['contrasena'])){
		if ($password == $_POST['contrasena']){
			$_SESSION['ID'] = "admin";
		}
		else{
			echo 'Contraseña incorrecta';
			include('pages/admin/login.php');
			include('layout/admin/footer.php');
			die();
		}
	}
	else{
		include('pages/admin/login.php');
		include('layout/admin/footer.php');
		die();
	}
}

if (isset($_GET['posts'])){
	include('pages/admin/posts.php');
}
else{
	include('controllers/admin/save.php');
	include('pages/admin/form.php');
}
include('layout/admin/footer.php');
?>