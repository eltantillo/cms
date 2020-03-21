<?php
include('controllers/config.php');
include('controllers/functions.php');
include('layout/header.php');

if (isset($_GET['buscar'])){
    $posts = searchPosts($link, $_GET['buscar']);
    if ($posts->num_rows > 0){
        include('pages/posts.php');
    }
}
else{
    $path = explode('/', $_SERVER['REQUEST_URI']);
    $len = count($path);
    $depth = 1;
    $category = $path[count($path) - $depth];
    
    if ($len > 3 or $category != null){
        if ($category == null){
            $depth += 1;
            $category = $path[count($path) - $depth];
        }
        $type = $path[2];

        if ($type == 'registrarse'){
            include('pages/register.php');
        }
        else if ($type == 'identificarse'){
            include('pages/login.php');
        }
        else if ($type == 'cerrar'){
            include('pages/logout.php');
        }
        else if ($type == 'compras'){
            if ($category !== $type){
                include('pages/purchase.php');
            }
            else{
                $posts = getPurchasedPosts($link);
                if ($posts->num_rows > 0){
                    include('pages/posts.php');
                }
            }
        }
        else if ($type == 'usuario'){
            if ($category !== $type){
                include('pages/profile.php');
            }
            else{
                include('pages/user.php');
            }
        }
        else if ($type == 'filtrar'){
            $depth += 1;
            $value = $category;
            $category = $path[count($path) - $depth];
            
            $posts = getPostsByCriteria($link, $CATEGORIES[$category], $value);
            if ($posts->num_rows > 0){
                include('pages/posts.php');
            }
        }
        else if ($type == 'recurso'){
            $post = $category;
            // Search Post in Category and display, else show 404
            $post = getPost($link, $post);
            if ($post->num_rows > 0){
                include('pages/post.php');
            }
            else{
                include('pages/404.php');
            }
        }
        else{
            include('pages/404.php');
        }
    }
    else{
        include('pages/home.php');
    }
}

include('layout/footer.php');
?>