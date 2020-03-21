<?php
function getPostsByCriteria($link, $criteria, $value) {
    $query = mysqli_query($link, 'SELECT * FROM post WHERE ' . $criteria . ' LIKE "%' . $value . '%"');
    return $query;
}

function getPurchasedPosts($link) {
    $purchases = mysqli_query($link, 'SELECT post_id FROM purchase WHERE user_id = "' . $_SESSION['id'] . '"');
    $array = array();
    while($post = mysqli_fetch_array($purchases)){
        $array[] = $post['post_id'];
    }
    $array = implode('","',$array);
    $query = mysqli_query($link, 'SELECT * FROM post WHERE id IN ("' . $array . '")');
    return $query;
}

function getPost($link, $title) {
    $title = str_replace("-", " ", $title);
    $query = mysqli_query($link, 'SELECT * FROM post WHERE title = "' . mysqli_real_escape_string($link, $title) . '"');
    return $query;
}

function searchPosts($link, $criteria) {
    $query = mysqli_query($link, 'SELECT * FROM post WHERE title LIKE "%' . $criteria . '%" or content LIKE "%' . $criteria . '%"');
    return $query;
}
?>