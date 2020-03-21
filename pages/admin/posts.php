<div class="collection">
<?php
$posts = mysqli_query($link,'SELECT * FROM post ORDER BY id DESC');
if ($posts){
	while($temp = mysqli_fetch_array($posts)){
		echo '<a href="?id=' . $temp['id'] . '" class="collection-item"> ' . $temp['title'] . '</a>';
	}
}
?>
</div>
