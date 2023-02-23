<?php 

namespace Admin\Model;


	class Directory{
		

		/**
		*
		*	attributs
		*
		*
		**/
 

		private $directory = '';

		/**
		*
		*	construct
		*
		**/

		public function __construct(){


		}




		/**
		*
		* create Directory function
		* @param username => created_by
		*
		**/
		public function createDirectory($username,$type)
		{

			$directoryCreatedAndExists = false;

			$directoryParent = dirname(dirname(dirname(dirname(dirname(__FILE__) )))).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploadsFiles';

		//	$subDirectory = $directoryParent.DIRECTORY_SEPARATOR.$username;

			$directory= $directoryParent.DIRECTORY_SEPARATOR.$type; 


			$this->setDirectory($directory);


			 if(!file_exists($directoryParent))    if(mkdir($directoryParent,0777));
			// if(!file_exists($subDirectory))    if(mkdir($subDirectory,0777));
			 if(!file_exists($directory))  {
			 	if(mkdir($directory,0777)){
			 		$directoryCreatedAndExists = true;
			 	}else{
			 		$directoryCreatedAndExists = false;
			 	}
			 }  

			 return $directoryCreatedAndExists;
			 
		}


		 

		/**
		*
		*	getters and setters
		*
		*
		**/

		 

		public function getDirectory($username = '',$type = '')
		{


		    $directory = dirname(dirname(dirname(dirname(dirname(__FILE__) )))).DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'uploadsFiles'.DIRECTORY_SEPARATOR.$type;
		    
		   
		    
		    return $directory;
		}

	 

		public function setDirectory($value = '')
		{
			 $this->directory = $value;
		}

	}


 ?>