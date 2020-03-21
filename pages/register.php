<?php
if (isset($_SESSION['id'])){
    echo '<script> location.replace("' . $url . '"); </script>';
}

if (isset($_POST['email'])){
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_query($link,'INSERT INTO user (
		`name`,
		`email`,
		`password`
		) VALUES ("' . 
		mysqli_real_escape_string($link, $_POST['name']) . '", "' . 
		mysqli_real_escape_string($link, $_POST['email']) . '", "' . 
		mysqli_real_escape_string($link, $_POST['password'])
		. '")');
    echo '<script> location.replace("' . $_SESSION['origURL'] . '"); </script>';
}
else{
    $_SESSION['origURL'] = $url;
    if (isset($_SERVER['HTTP_REFERER'])){
        $_SESSION['origURL'] = $_SERVER['HTTP_REFERER'];
    }
}
?>

<h3>Registrarse</h3>
<form method="post" class="form">
    <div class="row">
        <div class="input-field col s12">
			<i class="material-icons prefix">person</i>
            <input id="name" name="name" type="text" autofocus class="validate">
            <label for="name">Nombre</label>
            <span class="helper-text" data-error="Error" data-success="Correcto">Su nombre completo</span>
        </div>
        <div class="input-field col s12">
			<i class="material-icons prefix">email</i>
            <input id="email" name="email" type="email" class="validate">
            <label for="email">Correo</label>
            <span class="helper-text" data-error="El correo electrónico no es válido" data-success="Correo electrónico válido">Intoduzca una dirección de correo válida</span>
        </div>
        <div class="input-field col s12">
			<i class="material-icons prefix">vpn_key</i>
            <input id="password" name="password" type="password">
            <label for="password">Contraseña</label>
            <span class="helper-text" data-error="Error" data-success="Correcto">Una contraseña segura usualmente involucra letras mayúsculas y minúsculas, números y caracteres especiales.</span>
        </div>
    </div>
<button class="btn" type="submit">Registrarse</button></td></tr></table>
</form>