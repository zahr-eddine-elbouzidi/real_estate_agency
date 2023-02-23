<?php 
 
namespace Admin\Model;
use Laminas\Validator\Explode;
    
class Upload{

		/**
		*
		*	attributs
		*
		*
		**/
		private $tempPath ;

		private $uploadPath ;

		private $filename;

		private $directoryObject;

		private $date;

	 

		/**
		*
		*	construct
		*
		**/

		public function __construct(){

			$this->directoryObject = new Directory();
		}



	public function checkValidateImageType($files = array())
	{

		

		 $isImage  =  -1;

		 $typeAccepted = array("image/jpeg","image/jpg", "image/gif", "image/png","image/bmp","video/mp4","video/mov");
	    
	     if(in_array($files['file']['type'],$typeAccepted)) {  

	     	$isImage = 0;

	     }else{


	     	$isImage = -1;

	     }


	     return $isImage;
	}



	public function checkValidateFileType($files = array()){
    	


		$isExcelFile  =  -1;

		$typeAccepted = array("xls","xlsx");

		$ext = pathinfo($files['file']['name'], PATHINFO_EXTENSION);
	   
		if(in_array($ext,$typeAccepted)) {  

			$isExcelFile = 0;

		}else{


			$isExcelFile = -1;

		}


		return $isExcelFile;
	}



	/**
	* move uploaded file in the director server 
	* @param $array fails errors 
	* @return true or false
	*
	**/
	public function getNewFileName($oldFileName = '' , $tempPath = '' , $title = '' , $type = ''){

        //GET EXTENSION FILE
	    $extension = strtolower(pathinfo($oldFileName , PATHINFO_EXTENSION));
	    
	    $table = explode(".", $oldFileName);
	 
	    
	    $leftPartFilename =  $table[0];
 
	    //RENAME FILE
	    $newfilename=Slug::create_slug($leftPartFilename)."-".Slug::create_slug($title)."-".date('dmY')."-".$type.".".$extension;
 
	
	    return  $newfilename;

	}


	public function moveUploadFile($filename = '' , $tempPath = '' , $username = '' , $type =''){

       $drap  = false;

	    //MOVE UPLOAD FILE
	   if(move_uploaded_file($tempPath, $this->directoryObject->getDirectory($username , $type) . 
	        DIRECTORY_SEPARATOR . $filename)){

	   	$drap  = true;

	   }else{

	   	$drap  = false;

	   }
	
	    return $drap;

	}
 

		/**
		*
		*	getters and setters
		*
		*
		**/

		public function getTempPath()
		{
			return $this->tempPath;
		}

		public function getDate()
		{
			return $this->date;
		}
		public function getUploadPath()
		{
			return $this->uploadPath;
		}

		public function getFileName()
		{
			return $this->filename;
		}

	 
		public function setTempPath($value)
		{
			 $this->tempPath= $value;
		}

		public function setUploadPath($value)
		{
			 $this->uploadPath = $value;
		}
		public function setDate($value)
		{
			 $this->date = $value;
		}


		public function setFileName($value)
		{
			 $this->filename = $value;
		}
		 

	}


 ?>