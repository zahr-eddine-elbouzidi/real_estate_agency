 	tinymce.init({
    selector: "textarea",theme: "modern",height: 200,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor  code"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   relative_urls:false,
	remove_script_host:false,
 	images_upload_base_path: '<?php echo $this->basePath(); ?>',
    
 
 });