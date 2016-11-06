<?php

class Uploader
{
	public $dir;
	public $files;
	public $filetype;
	public $nameid;
	public $size;
	public $upimg;
	public $exists;
	
	public function upload()
	{
		//set values
		$dir = $this->dir;
		$files = $this->files;
		$filetype = $this->filetype;
		$nameid = $this->nameid;
		$size = $this->size;
		$upimg = $this->upimg;
		$exists = $this->exists;

		$uploadOk = 1;
		$err1 = $err2 = $err3 = $err4 = $err5 = "";

		//upload image
		$target_dir = $dir;
		$target_file = $target_dir . basename($files["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$newfilename = $target_dir . $nameid . "." . $imageFileType;
		
		if($upimg)
		{
			// Check if image file is a actual image or fake image
			$check = getimagesize($files["tmp_name"]);
			if($check !== false) {
				$err1 = "<br>File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$err2 = "<br>File is not an image.";
				$uploadOk = 0;
			}
		}

		if($exists)
		{
			// Check if file already exists
			if (file_exists($newfilename)) {
				$err3 = "<br>Sorry, file already exists.";
			    $uploadOk = 0;
			}
		}

		// Check file size
		if ($files["size"] > $size) {
			$err4 = "<br>Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if(!in_array($imageFileType, $filetype)) {
			$err5 = "<br>Sorry, only ".implode(',', $filetype)." files are allowed.";
			$uploadOk = 0;
		}
		
		$imgstat = "";
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$imgstat = "<br>File not uploaded.".$err1.$err2.$err3.$err4.$err5;
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($files["tmp_name"], $newfilename)) {
				$imgstat = "The file has been uploaded.";
			} else {
				$imgstat = "Sorry, there was an error uploading your file.".$err1.$err2.$err3.$err4.$err5;
			}
		}

		//return upload result/status
		return $imgstat;
	}
}

?>