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
		<?php $type=''; for($i=0; $i<2; $i++){ if($i==1) $type = 'mobile-'; ?>
			<ul id="<?php echo $type; ?>grados" class="dropdown-content">
				<?php
					foreach($GRADES as $grade => $string){
						echo '<li><a href="' . $url . '/filtrar/grado/' . $grade . '/">' . $string . '</a></li>';
					}
				?>
			</ul>
			<ul id="<?php echo $type; ?>asignaturas" class="dropdown-content">
				<?php
					foreach($SUBJECTS as $grade => $string){
						echo '<li><a href="' . $url . '/filtrar/asignatura/' . $grade . '/">' . $string . '</a></li>';
					}
				?>
			</ul>
			<ul id="<?php echo $type; ?>tipo" class="dropdown-content">
				<?php
					foreach($TYPES as $grade => $string){
						echo '<li><a href="' . $url . '/filtrar/tipo/' . $grade . '/">' . $string . '</a></li>';
					}
				?>
			</ul>
		<?php } ?>
		<nav class="nav-extended blue lighten-1">
			<div class="nav-wrapper">
				<a href="<?php echo $url; ?>/" class="brand-logo"><i class="material-icons">school</i>edu-kndo</a>
				<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<ul class="left hide-on-med-and-down">
					<li><a class="dropdown-trigger" href="#!" data-target="grados">Grados<i class="material-icons right">arrow_drop_down</i></a></li>
					<li><a class="dropdown-trigger" href="#!" data-target="asignaturas">Asignaturas<i class="material-icons right">arrow_drop_down</i></a></li>
					<li><a class="dropdown-trigger" href="#!" data-target="tipo">Recursos<i class="material-icons right">arrow_drop_down</i></a></li>
				</ul>
				<ul class="right hide-on-med-and-down">
					<!-- Guest menu -->
					<?php if(!isset($_SESSION['id'])){ ?>
					<li><a href="<?php echo $url; ?>/registrarse/">Registrarse<i class="material-icons right">create</i></a></li>
					<li><a href="<?php echo $url; ?>/identificarse/">Identificarse<i class="material-icons right">https</i></a></li>
					<!-- User menu -->
					<?php }else{ ?>
					<li><a href="<?php echo $url; ?>/usuario/">Perfil<i class="material-icons right">person</i></a></li>
					<li><a href="<?php echo $url; ?>/compras/">Compras<i class="material-icons right">attach_money</i></a></li>
					<!--li><a href="<?php echo $url; ?>/carrito/">Carrito de compras<i class="material-icons right">shopping_cart</i></a></li-->
					<li><a href="<?php echo $url; ?>/cerrar/">Cerrar sesión<i class="material-icons right">power_settings_new</i></a></li>
					<?php } ?>
				</ul>
			</div>
			<div class="nav-content">
				<form method="get" action="<?php echo $url; ?>">
					<div class="input-field" >
						<input id="buscar" name="buscar" type="search" class="search" required>
						<label class="label-icon" for="search" style="padding:2px;"><i class="material-icons">search</i></label>
						<i class="material-icons" style="padding:2px;">close</i>
					</div>
				</form>
			</div>
		</nav>
		
		<ul class="sidenav" id="mobile-demo">
			<!-- Guest menu -->
			<li><a href="<?php echo $url; ?>/registrarse/">Registrarse<i class="material-icons right">create</i></a></li>
			<li><a href="<?php echo $url; ?>/identificarse/">Identificarse<i class="material-icons right">https</i></a></li>
			<!-- User menu -->
			<li><a href="<?php echo $url; ?>/usuario/">Perfil<i class="material-icons right">person</i></a></li>
			<li><a href="<?php echo $url; ?>/compras/">Compras<i class="material-icons right">attach_money</i></a></li>
			<!--li><a href="<?php echo $url; ?>/carrito/">Carrito de compras<i class="material-icons right">shopping_cart</i></a></li-->
			<li><a href="<?php echo $url; ?>/cerrar/">Cerrar sesión<i class="material-icons right">power_settings_new</i></a></li>
			<li><a class="dropdown-trigger" href="#!" data-target="mobile-grados">Grados<i class="material-icons right">arrow_drop_down</i></a></li>
			<li><a class="dropdown-trigger" href="#!" data-target="mobile-asignaturas">Asignaturas<i class="material-icons right">arrow_drop_down</i></a></li>
			<li><a class="dropdown-trigger" href="#!" data-target="mobile-tipo">Recursos<i class="material-icons right">arrow_drop_down</i></a></li>
		</ul>

		<div class="container">