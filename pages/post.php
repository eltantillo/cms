<?php
$post = mysqli_fetch_array($post);
$purchased = false;
if (isset($_SESSION['id'])){
    $purchased = mysqli_fetch_array(mysqli_query($link, 'SELECT id FROM purchase WHERE user_id = "' . $_SESSION['id'] . '" and post_id = "' . $post['id'] . '"'));

    if (isset($_POST['comment'])){
        mysqli_query($link,'INSERT INTO comment (
    		`post_id`,
    		`user_id`,
    		`comment`,
    		`rating`
    		) VALUES ("' . 
    		mysqli_real_escape_string($link, $post['id']) . '", "' . 
    		mysqli_real_escape_string($link, $_SESSION['id']) . '", "' . 
    		mysqli_real_escape_string($link, $_POST['comment']) . '", "' . 
    		mysqli_real_escape_string($link, $_POST['rating'])
    		. '")');
    }
}
$price = '<h2 class="top">Gratis</h2>';
$download = '<a class="btn-large" href="' . $url . '/files/Resource-' . $post['id'] . '.' . $post['file'] . '" download="' . $post['title'] . '.' . $post['file'] . '">Descargar</a>';
if ($post['price'] === '0'){
    if (!isset($_SESSION['id'])){
        $price = '<h4 class="top">Regístrese para descargar gratis</h4>';
        $download = '<a class="btn" href="' . $url . '/registrarse/">Registrarse</a> <a class="btn light-blue lighten-1" href="' . $url . '/identificarse/">Identificarse</a>';
    }
}
else if ($post['price'] !== null){
    $price = '<h2 class="top">' . money_format('%.2n', $post['price']) . ' <small>(USD)</small></h2>';
    if (!$purchased){
        $download = '<a class="btn-large" href="' . $url . '/compras/' . $post['id'] . '">Comprar</a>';
    }
}
// Post Content
echo '
    <div class="row">
        <div class="col m10">
            <h1>' . $post['title'] . '</h1>
        </div>
    </div>
    <div class="row">
        <div class="col m4">
            <img src="' . $url . '/files/Preview-' . $post['id'] . '.' . $post['preview'] . '" class="responsive-img">
        </div>
        <div class="col m5">
            <p><small>Grados</small><br/>'. $post['grades'] . '</p>
            <p><small>Asignaturas</small><br/>'. $post['subjects'] . '</p>
            <p><small>Recursos</small><br/>'. $post['types'] . '</p>
            <p><small>Número de páginas</small><br/>'. $post['pages'] . '</p>
            <p><small>Duración aproximada</small><br/>'. $post['duration'] . '</p>
        </div>
        <div class="col m3 center-align">
            ' . $price . '
            <p>Descarga digital</p>
            ' . $download . '
        </button>
        </div>
        <div class="col m12">
            <h5>Descripción</h5>
            <p>' . $post['content'] . '</p>
        </div>
    </div>
';

// Comment Form
if (isset($_SESSION['id'])){
    $comment = mysqli_fetch_array(mysqli_query($link, 'SELECT id FROM comment WHERE post_id = "' . $post['id'] . '" AND  user_id = "' . $_SESSION['id'] . '"'));
    if (!$comment){
        echo'
            <form method="POST" class="form col s12" enctype="multipart/form-data">
            	<div class="row">
            		<div class="input-field col s12 m10">
            			<i class="material-icons prefix">comment</i>
            			<input name="comment" id="comment" type="text" autofocus>
            			<label for="comment">Comentario</label>
            		</div>
            		
                    <div class="input-field col s12 m2">
                        <select id="rating" name="rating">
                            <option value="5" selected>5 Estrellas</option>
                            <option value="4">4 Estrellas</option>
                            <option value="3">3 Estrellas</option>
                            <option value="2">2 Estrellas</option>
                            <option value="1">1 Estrella</option>
                        </select>
                        <label>Calificación</label>
                    </div>
        
            		<div class="input-field col s12">
            			<button type="submit" class="btn">Publicar</button>
            		</div>
            	</div>
            </form>
        ';
    }
}

// Comments
$comments = mysqli_query($link, 'SELECT * FROM comment WHERE post_id = "' . $post['id'] . '"');
while($comment = mysqli_fetch_array($comments)){
    $stars = '';
    for ($i = 0; $i < (int)$comment['rating']; $i++) {
        $stars .= '<i class="material-icons blue-text text-lighten-1">grade</i>';
    }
    $user = mysqli_fetch_array(mysqli_query($link, 'SELECT name FROM user WHERE id = "' . $comment['user_id'] . '"'));;
    echo '
        <ul class="collection">
            <li class="collection-item avatar">
                <img src="' . $url . '/../cms/img/avatar.png" class="circle">
                <b class="title">' . $user['name'] . '</b>
                <p>' . $stars . '</p>
                <p>
                    <small>' . $comment['date'] . '</small><br/>
                    ' . $comment['comment'] . '
                </p>
            </li>
        </ul>
    ';
}
?>