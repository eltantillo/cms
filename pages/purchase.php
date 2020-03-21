<?php
// Logged in user only
if (isset($_SESSION['id'])){
    
    var_dump(get_include_path());
    include(dirname(__FILE__) . '/../controllers/payment.php');
    // Payment was made in paypal
    if (isset($_GET['paymentId']) and isset($_GET['PayerID'])){
        
            $valid = process($_GET['paymentId'], $_GET['PayerID']);
            // Valid Payment
            if ($valid){
                $id = $_GET['payment'];
                mysqli_query($link,'INSERT INTO purchase (
            		`user_id`,
            		`post_id`
            		) VALUES ("' . 
            		mysqli_real_escape_string($link, $_SESSION['id']) . '", "' . 
            		mysqli_real_escape_string($link, $id)
            		. '")');
            	$post = mysqli_fetch_array(mysqli_query($link,'SELECT title FROM post WHERE id = "' . $id . '"'));
            	echo '<script> location.replace("' . $url . '/recurso/' . strtolower(str_replace(" ", "-", $post['title'] )) . '"); </script>
            	';
            }
            // Payment could not be verified
    		else{
    			echo 'Error';
    		}
    }
    // Request purchase to paypal
    else{
    	$id = $category;
    	$product = mysqli_fetch_array(mysqli_query($link,'SELECT title,price FROM post WHERE id = "' . $id . '"'));
    	checkout($id, $product['title'], $product['price'], $url);
    }
}
// User not logged in
else{
    //Redirect to login/register Page, then login and register will redirect back to this page and proccess
    echo '
        <h1>Regístrese</h1>
        <h2>Para continuar con su compra</h2>
        <p>Para poder proceder con su compra es necesario que se registre o inicie sesión utilizando cualquiera de los botones de abajo. También puede utilizar los botones del menú principal.</p>
        <a class="btn-large" href="' . $url . '/registrarse/">Registrarse</a> <a class="btn-large light-blue lighten-1" href="' . $url . '/identificarse/">Identificarse</a>
    ';
}
    
?>