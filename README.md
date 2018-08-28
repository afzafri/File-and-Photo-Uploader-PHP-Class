# File and Photo Uploader PHP Class
- Upload photo or file easily using this customizable php class
- There are other file upload libraries out there that are more efficient, secure and good.
- I created my own library solely for my OOP PHP learning process and my personal projects.
- This class can be used for both Image Upload or File Upload

# Installation
- Drop the `uploader.class.php` into your project directory.

# Usage
```php
<?php
  //include class
	require_once('./PathToClass/uploader.class.php');

	//create new object
	$obj = new Uploader();

	//set the needed values
	$obj->dir = "./images/"; //directory to store the image/file
	$obj->files = $_FILES["fileupload"]; //receive from form
	$obj->filetype = array('png','gif'); //set the allowed image/file extensions
	$obj->size = 100000; //set file/image size limit. note: 100000 is 100KB
	//below is optional. If don't want to use it, remove from code. Default for upload image and exists is false, and null for filename
	$obj->upimg = true; //set true if want to upload image.
	$obj->exists = true; //set true if want to check if the file already exist, if exist, file will not upload.
	$obj->nameid = "reaperz"; //image/file name or id. Do not set or leave it null if want the original file name.

	//upload
	$stat = $obj->upload();

    //print upload result/status
    echo $stat;
?>

```
# License
This library is under MIT license, please look at the `LICENSE` file
