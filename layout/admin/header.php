<?php $edit = isset($_GET['id']); ?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link rel="stylesheet" href="<?php echo $url; ?>/../cms/css/main.css">
		
		<title><?php echo $name; ?></title>
		<link rel="shortcut icon" type="image/png" href="<?php echo $url; ?>/../cms/img/logo.png"/>
	</head>
	<body>
		<nav class="blue lighten-1">
			<div class="nav-wrapper">
				<a href="<?php echo $url; ?>/" class="brand-logo"><i class="material-icons">school</i>edu-kndo</a>
				<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<?php if ($edit){
						$post = mysqli_query($link,'SELECT title FROM post WHERE id = "' . $_GET['id'] . '"');
						$post = mysqli_fetch_array($post);
					?>
						<li><a href="../recurso/<?php echo str_replace(" ", "-", $post['title']); ?>/" target="_blank">Vista previa<i class="material-icons right">web</i></a></li>
					<?php }?>
					<li><a href="<?php echo $url; ?>/admin">Nueva publicación<i class="material-icons right">message</i></a></li>
					<li><a href="<?php echo $url; ?>/admin/?posts">Ver todas las publicaciones<i class="material-icons right">view_list</i></a></li>
				</ul>
			</div>
		</nav>
		
		<ul class="sidenav" id="mobile-demo">
					<?php if ($edit){ ?>
						<li><a href="../recurso/<?php echo str_replace(" ", "-", $post['title']); ?>/" target="_blank">Vista previa<i class="material-icons right">web</i></a></li>
					<?php }?>
					<li><a href="<?php echo $url; ?>/admin">Nueva publicación<i class="material-icons right">message</i></a></li>
					<li><a href="<?php echo $url; ?>/admin/?posts">Ver todas las publicaciones<i class="material-icons right">view_list</i></a></li>
		</ul>

		<div class="container">
			<br/>