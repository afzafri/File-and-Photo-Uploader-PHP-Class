<!DOCTYPE html>
<html>
<head>
	<title>Upload image demo</title>
</head>
<body>

<form action="demo.php" method="post" enctype="multipart/form-data">
Upload: <input type="file" name="fileupload"><br>
<input type="submit" name="submit">
</form>
</body>
</html>

<?php

if(isset($_POST['submit']))
{
	//include class
	require_once('./uploader.class.php');

	//create new object
	$obj = new Uploader();

	//set the needed values
	$obj->dir = "./images/"; //directory to store the image/file
	$obj->files = $_FILES["fileupload"]; //receive from form
	$obj->filetype = array('png','gif'); //set the allowed image/file extensions
	$obj->nameid = "reaperz"; //image/file name or id
	$obj->size = 100000; //set file/image size limit. note: 100000 is 100KB
	//below is optional. If don't want to use it, remove from code. default for both is false.
	$obj->upimg = true; //set true if want to upload image.
	$obj->exists = true; //set true if want to check if the file already exist, if exist, file will not upload.

	//upload
	$stat = $obj->upload();

	//print upload result/status
	echo $stat;
}


?>