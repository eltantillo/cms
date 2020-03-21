<?php
if (isset($_SESSION['id'])){
    echo '<script> location.replace("' . $url . '"); </script>';
}
        
if (isset($_POST['email'])){
    $user = mysqli_fetch_array(mysqli_query($link,'SELECT id,password FROM user WHERE email = "' . $_POST['email'] . '"'));
    if(password_verify($_POST['password'], $user['password'])){
        $_SESSION['id'] = $user['id'];
        echo '<script> location.replace("' . $_SESSION['origURL'] . '"); </script>';
    }
}
else{
    $_SESSION['origURL'] = $url;
    if (isset($_SERVER['HTTP_REFERER'])){
        $_SESSION['origURL'] = $_SERVER['HTTP_REFERER'];
    }
}
?>

<h3>Identificarse</h3>
<form method="post" class="form">
    <div class="row">
        <div class="input-field col s12">
			<i class="material-icons prefix">email</i>
            <input id="email" name="email" type="text" autofocus>
            <label for="email">Correo</label>
        </div>
        <div class="input-field col s12">
			<i class="material-icons prefix">vpn_key</i>
            <input id="password" name="password" type="password">
            <label for="password">Contrasena</label>
        </div>
    </div>
<button class="btn" type="submit">Identificarse</button></td></tr></table>
</form>