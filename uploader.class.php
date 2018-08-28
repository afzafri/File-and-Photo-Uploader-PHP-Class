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
		$upimg = ($this->upimg != "") ? $this->upimg : false;
		$exists = ($this->exists != "") ? $this->exists : false;

		$uploadOk = 1;
		$typeErr = $existErr = $sizeErr = $formatErr = $imgStatus = "";
		$response = [];

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
				$typeErr = "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;

				$response['success']['type'] = $typeErr;
			} else {
				$typeErr = "File is not an image.";
				$uploadOk = 0;

				$response['errors']['type'] = $typeErr;
			}
		}

		if($exists)
		{
			// Check if file already exists
			if (file_exists($newfilename)) {
				$existErr = "Sorry, file already exists.";
			  $uploadOk = 0;

				$response['errors']['exist'] = $existErr;
			}
		}

		// Check file size
		if ($files["size"] > $size) {
			$sizeErr = "Sorry, your file is too large.";
			$uploadOk = 0;

			$response['errors']['size'] = $sizeErr;
		}
		// Allow certain file formats
		if(!in_array($imageFileType, $filetype)) {
			$formatErr = "Sorry, only ".implode(',', $filetype)." files are allowed.";
			$uploadOk = 0;

			$response['errors']['format'] = $formatErr;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$imgStatus = "File not uploaded.";

			$response['errors']['status'] = $imgStatus;
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($files["tmp_name"], $newfilename)) {
				$imgStatus = "The file has been uploaded.";

				$response['success']['status'] = $imgStatus;
				$response['success']['path'] = $newfilename;
			} else {
				$imgStatus = "Sorry, there was an error uploading your file.";

				$response['errors']['status'] = $imgStatus;
			}
		}

		//return upload result/status
		return json_encode($response);
	}
}

?>
