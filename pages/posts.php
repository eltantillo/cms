<?php
echo '<div class="row">';
while($post = mysqli_fetch_array($posts)){
    echo '
    <div class="col m4">
        <div class="card hoverable">
            <div class="card-image waves-effect waves-block waves-light">
                <img src="' . $url . '/files/Preview-' . $post['id'] . '.' . $post['preview'] . '" class="activator" style="max-height=100px;">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">' . $post['title'] . '<i class="material-icons right">more_vert</i></span>
                <p><a href="' . $url . '/recurso/' . strtolower(str_replace(" ", "-", $post['title'] )) . '">Ver más</a></p>
            </div>
                <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                <p class="truncate">' . $post['content'] . '</p>
                <p>Publicado el ' . $post['date'] . '<br/>
                En la asinatura ' . $post['subjects'] . '</p>
                <p class="center-align"><a href="' . $url . '/recurso/' . strtolower(str_replace(" ", "-", $post['title'] )) . '" class="btn waves-effect waves-light">Ver más</a></p>
            </div>
        </div>
    </div>
    ';
}
echo '</div>';
?>