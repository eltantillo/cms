<?php
if (isset($_POST['title'])){
	$grades = '';
	$subjects =  '';
	$types = '';
	
	if (isset($_POST['grades'])){
		$grades = join(",",$_POST['grades']);
	}
	if (isset($_POST['subjects'])){
		$subjects =  join(",",$_POST['subjects']);
	}
	if (isset($_POST['types'])){
		$types = join(",",$_POST['types']);
	}
	
	// Set price and pages to null if empty
	if ($_POST['price'] == ''){
		$_POST['price'] = 'null';
	}
	if ($_POST['pages'] == ''){
		$_POST['pages'] = 'null';
	}
	
	$file = '';
	$preview = '';
	$fileExt = '';
	$previewExt = '';
	
	if ($_FILES['resource']['name'] !== ''){
		$ext = explode('.', $_FILES['resource']['name']);
		$fileExt = end($ext);
		$file = ', `file`="' . $fileExt . '"';
	}
	if ($_FILES['preview']['name'] !== ''){
		$ext = explode('.', $_FILES['preview']['name']);
		$previewExt = end($ext);
		$preview = ', `preview`="' . $previewExt . '"';
	}
	
	if ($edit){
		mysqli_query($link,'UPDATE `post` SET 
			`title`="' . mysqli_real_escape_string($link, $_POST['title']) . '",
			`price`=' . mysqli_real_escape_string($link, $_POST['price']) . ',
			`pages`=' . mysqli_real_escape_string($link, $_POST['pages']) . ',
			`duration`="' . mysqli_real_escape_string($link, $_POST['duration']) . '",
			`grades`="' . mysqli_real_escape_string($link, $grades) . '",
			`subjects`="' . mysqli_real_escape_string($link, $subjects) . '",
			`types`="' . mysqli_real_escape_string($link, $types) . '",
			`content`="' . mysqli_real_escape_string($link, $_POST['content']) . '"
			' . $file . '
			' . $preview . '
			WHERE id ="' . $_GET['id'] . '"');
	}
	else{
		mysqli_query($link,'INSERT INTO post (
			`title`,
			`price`,
			`pages`,
			`duration`,
			`grades`,
			`subjects`,
			`types`,
			`content`,
			`file`,
			`preview`
			) VALUES ("' . 
			mysqli_real_escape_string($link, $_POST['title']) . '", ' . 
			mysqli_real_escape_string($link, $_POST['price']) . ', ' . 
			mysqli_real_escape_string($link, $_POST['pages']) . ', "' . 
			mysqli_real_escape_string($link, $_POST['duration']) . '", "' . 
			mysqli_real_escape_string($link, $grades) . '", "' . 
			mysqli_real_escape_string($link, $subjects) . '", "' . 
			mysqli_real_escape_string($link, $types) . '", "' . 
			mysqli_real_escape_string($link, $_POST['content']) . '", "' . 
			mysqli_real_escape_string($link, $fileExt) . '", "' . 
			mysqli_real_escape_string($link, $previewExt)
			. '")');
	}
	
	$id = mysqli_query($link,'SELECT id FROM post WHERE title = "' . $_POST['title'] . '"');
	$id = mysqli_fetch_array($id)['id'];

	// Files
	if ($fileExt !== ''){
		saveFile('resource', 'Resource-' . $id . '.' . $fileExt);
	}
	if ($previewExt !== ''){
		saveFile('preview', 'Preview-' . $id . '.' . $previewExt);
	}
}

if ($edit){
	$post = mysqli_query($link,'SELECT * FROM post WHERE id = "' . $_GET['id'] . '"');
	$post = mysqli_fetch_array($post);
}
?>