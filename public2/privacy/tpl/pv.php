 
<?php 
 
set_time_limit(0);
 
if(!isset($_POST['submit'])) exit;

$role = (bool) $_POST['hiddenUserRole'];
$roleSuper =  $_POST['hiddenUserSuper'];

$nbre_posts =   json_decode($_POST['hiddenNbreP']);
if(is_array($nbre_posts)) $nbre_posts = current($nbre_posts);

if(!is_null($nbre_posts)){
  if(  $nbre_posts->nbre_postuled == 0){
     echo "<center style='margin:0 auto;'><h2>Information</h2> <h3>Candidats postulés est : 0<br />Merci de votre compréhension </h3></center>";
     echo "<center style='margin:0 auto;'><h2></h2> <h3>لا يوجد أي مترشح لهدا المنصب <br />شكرا لتفهمكم</h3></center>";
      exit();
  }
}else{
   echo "<center style='margin:0 auto;'><h2>Information</h2> <h3>Candidats postulés est : 0<br />Merci de votre compréhension </h3></center>";
     echo "<center style='margin:0 auto;'><h2></h2> <h3>لا يوجد أي مترشح لهدا المنصب <br />شكرا لتفهمكم</h3></center>";
      exit();
}

 
if(!$role && $roleSuper == 'Admin'){
  echo "<center style='margin:0 auto;'><h2>Ooops!</h2> <h3>Vous n'avez pas le droit d'impression, Contactez votre administrateur supérieur! <br />Merci de votre compréhension </h3></center>";

  echo "<center style='margin:0 auto;'><h2></h2> <h3>ليس لديكم الحق في هده العملية <br />شكرا لتفهمكم</h3></center>";
    exit();
} 
$objects = json_decode($_POST['hiddenHire']);
$objectsCommission = json_decode($_POST['hiddenCommission']);
$publication = json_decode(($_POST['hiddenMar']));
$objectsPvFirstExam = json_decode($_POST['hiddenpvFirstExam']);
$objectFormule = json_decode($_POST['hiddenFormule']);
$objectsExamTwo = json_decode($_POST['hiddenExamTwo']);
$objectNbrePost = json_decode($_POST['hiddenNbreP']);

if(is_array($objectNbrePost)) $objectNbrePost = current($objectNbrePost);
$nbrePostuled = (isset($objectNbrePost->nbre_postuled)) ? $objectNbrePost->nbre_postuled : null;
//var_dump($objectNbrePost);
//die();
$user = $_POST['hiddenUser'];
$logoFilename = $_POST['hiddenLogo'];
$university_name = $_POST['hiddenUniversity'];


/*var_dump($objects);
var_dump($objectsCommission);
die();
*/

$type = $_POST['typeHidden'];
$titleType = (isset($type) && $type == 'pv') ? 'PV' : null;

$titleType_ar = (isset($type) && $type == 'pv') ? 'محضر ' : null;
 
 

require_once('tcpdf/tcpdf_include.php');
require_once('tcpdf/tcpdf.php');
require_once('tcpdf/tcpdf_barcodes_2d.php');
require_once('tcpdf/examples/barcodes/tcpdf_barcodes_2d_include.php');
  


class MYPDF extends TCPDF {
 

     // Load table data from file
    public function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(250, 240, 230);
        $this->SetTextColor(0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.1);
        $this->SetFont('', 'B');
        // Header
        $w = array(20, 40, 70, 70, 20 ,20 , 18);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(250, 240, 230);
        $this->SetTextColor(0);
        $this->SetFont('aealarabiya','',14);
        // Data
        $fill = 0;
        foreach($data as $row) {
            $this->Cell($w[0], 6, date('d-m-Y',strtotime($row->hire_date)), 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row->etablissement_name, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row->type_name, 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row->specialty_fr, 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, date('d-m-Y h:i:s',strtotime($row->postuled_at)), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill=!$fill;
        }
     }
     


}
 
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ZAHR-EDDINE ELBOUZIDI');
$pdf->SetTitle('E-Concours | '.$titleType);
$pdf->SetSubject('Reçu');
$pdf->SetKeywords('');
$pdf->SetFont('helvetica', 'I', 12);
$pdf->setPrintHeader(false);
// set default header data
 $image_file = K_PATH_IMAGES.'enssup.jpg';
//$pdf->SetHeaderData($image_file, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(true , 10);

$pdf->AddPage();
$pdf->SetFont('aealarabiya', 'I', 8);

$image_file1 = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR.'uploadsFiles'.DIRECTORY_SEPARATOR.$user.DIRECTORY_SEPARATOR.'university'.DIRECTORY_SEPARATOR.$logoFilename;

$pdf->Image($image_file, 15, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>'.$university_name.'</h5>
</div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);


/*
$pdf->Image($image_file, 120, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>Département de l\'Enseignement Supérieur </h5>
<h5>et de la Recherche Scientifique </h5></div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);*/

 

//$pdf->SetPrintHeader(false);


// ---------------------------------------------------------

 
  
 
$contents = '';
$contents .= '

<hr color="gray" /><h1 align="center">  <span dir="rtl">'.$titleType_ar.'</span> </h1>
  
<h2 align="center"><span dir="rtl">محضر مباراة توظيف '.$objects->type_name_ar.'</span> </h2>

<h2 align="center">  <span dir="rtl">لفائدة '.$objects->university_name_ar.'</span> </h2>


<h2 align="center">'.$objects->specialty_fr.' <span dir="rtl">تخصص</span> </h2>

<h2 align="center">'.date('Y-m-d',strtotime($objects->hire_date)).' <span dir="rtl">دورة</span> </h2><br />';


$pdf->writeHTML($contents);
 

$style = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(14,91,147),
    'bgcolor' => false
);

 

 $pdf->Ln();
 $pdf->Ln();
 $text = '<table width="100%" border="0.2" cellpadding="2" cellspacing="0">
    
      <tr >
      
     
      <td width="30%" align="center" bgcolor="#dddddd" >عدد المترشحين</td> 
      <td width="50%" align="center" bgcolor="#dddddd" >التخصص</td>
      <td width="10%" align="center" bgcolor="#dddddd" >الدورة</td>
      <td width="10%" align="center"  bgcolor="#dddddd" > عدد المناصب المفتوحة</td>
 
 
      </tr>';
  $contentTable = null;$i = 0;$ngColor = "#ffffff";
   $contentTable .= '<tr bgcolor="'.$ngColor.'" >
            
            
            
            <td align="center"> '.$nbrePostuled.' </td>
            <td align="center">'.$objects->specialty_fr.'</td>
            <td align="center" >'.date('Y-m-d',strtotime($objects->session_date)).'</td>
            <td align="center" >'.$objects->post_number.'</td>
            </tr>
            ';


   

 $table=  $text.$contentTable.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($table, true, false, true, false, '');
 
$contentsT = '';
$contentsT .= '<h2 align="center">أعضاء لجنة المباراة</h2><br />';
$pdf->writeHTML($contentsT);

 $pdf->Ln();

 $text2 = '<table width="100%" border="0.2" cellpadding="2" cellspacing="0">
    
      <tr>

      <td width="10%" align="center" bgcolor="#dddddd" >الصفة</td>
      <td width="20%" align="center" bgcolor="#dddddd" >مقر العمل</td>
      <td width="20%" align="center" bgcolor="#dddddd" >التخصص</td>
      <td width="20%" align="center" bgcolor="#dddddd" >الاطار</td>
      <td width="15%" align="center" bgcolor="#dddddd" >الاسم و النسب</td>
      <td width="15%" align="center"  bgcolor="#dddddd" > رقم التأجير</td>
   
      
      
      
 
      </tr>';
  $contentTable2 = null;$i = 0;$ngColor = "#ffffff";
  foreach($objectsCommission as $rowM) {
            $i++;

           /* if($i%2 != 0){
              $ngColor = "#ffffff";
            }else{
               $ngColor = "#ffffff";
            }*/
           $contentTable2 .= '<tr bgcolor="#ffffff">
            <td align="center" >'.(($rowM->type == 'Président') ? 'رئيس' : 'عضو').'</td>
            <td align="center" >'.$rowM->etablissement_ar.'</td> 
            <td align="center" >'.$rowM->specialite_ar.'</td>
            <td align="center" >'.$rowM->grade_ar.'</td>
            <td align="center" >'.$rowM->nom_complet_ar.'</td>
            <td align="center" >'.$rowM->doti.'</td>
            
            
           
            
            
      
            </tr>
            ';


    }

 $table=  $text2.$contentTable2.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($table, true, false, true, false, '');


  

$pdf->Ln();


  
 
$contentsPublication = '';

$contentsPublication .= $publication->content_pub;


$pdf->writeHTML($contentsPublication);
 

$pdf->AddPage();


$pdf->Image($image_file1, 15, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>'.$university_name.'</h5>
</div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);



$pdf->Image($image_file, 120, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>Département de l\'Enseignement Supérieur </h5>
<h5>et de la Recherche Scientifique </h5></div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);



if($objects->type_profile == 'BAC+8'){
  $title = 'نتائج دراسة ملفات المعنيين بالأمر من طرف المقررين';
}else{
  $title = 'نتائج الاختبار الكتابي';
}

$titlePageTwo = '';

$titlePageTwo .= '<hr color="gray" /><h1 align="center">  <span dir="rtl">الاختبار الأول</span> </h1>
  
<h2 align="center"><span dir="rtl">'.$title.'</span> </h2>

<h2 align="center"><span dir="rtl">'.$objects->type_name_ar.'</span> </h2>

<h2 align="center">'.$objects->specialty_fr.' <span dir="rtl">تخصص</span> </h2>


<h2 align="center">'.date('Y-m-d',strtotime($objects->hire_date)).' <span dir="rtl">دورة</span> </h2>;

<h2 align="center"> <span dir="rtl">(ملحق رقم 1)</span> </h2><br />';


$pdf->writeHTML($titlePageTwo);


 $pdf->Ln();

 $textExamOne = '<table width="100%" border="0.2" cellpadding="2" cellspacing="0">
    
      <tr>

      <td width="20%" align="center" bgcolor="#dddddd" >ملاحظات</td>
      <td width="20%" align="center" bgcolor="#dddddd" >النقطة /20</td>
      <td width="20%" align="center" bgcolor="#dddddd" >رقم البطاقة الوطنية</td>
      <td width="25%" align="center" bgcolor="#dddddd" >الاسم و النسب</td>
      <td width="15%" align="center"  bgcolor="#dddddd" > رقم الترتيبي</td>
   
      
      
      
 
      </tr>';
  $contentTableExamOne = null;$i = 0;$ngColor = "#ffffff";
  foreach($objectsPvFirstExam as $rowM) {
            $i++;

           /* if($i%2 != 0){
              $ngColor = "#ffffff";
            }else{
               $ngColor = "#ffffff";
            }*/

           $typeMessage = 'لا يستدعى';
           if($rowM->note_ex1 >= $objectFormule->pass_note) {
            $typeMessage = 'يستدعى';
           }

 
           $contentTableExamOne .= '<tr bgcolor="#ffffff">
            <td align="center" >'.$typeMessage.'</td>
            <td align="center" >'.(($rowM->accepted ==0 || $rowM->accepted =='0') ? $rowM->motif : $rowM->note_ex1).'</td>
            <td align="center" >'.$rowM->cin.'</td>
            <td align="center" >'.$rowM->nom_complet_ar.'</td>
            <td align="center" >'.$i.'</td>
            
            
           
            
            
      
            </tr>
            ';


    }

 $tableExamOne=  $textExamOne.$contentTableExamOne.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($tableExamOne, true, false, true, false, '');

$pdf->AddPage();

$contentsSignature1 = '';
$contentsSignature1 .= '<h2 align="center">توقيعات أعضاء اللجنة</h2><br />';
$pdf->writeHTML($contentsSignature1);

 $pdf->Ln();

 $textSign1 = '<table width="100%" border="0.2" cellpadding="2" cellspacing="0">
    
      <tr>


      <td width="50%" align="center" bgcolor="#dddddd" >التوقيع</td>
      <td width="50%" align="center" bgcolor="#dddddd" >الاسم و النسب</td>
   
      
      
      
 
      </tr>';
  $contentTableSign1 = null;$i = 0;$ngColor = "#ffffff";
  foreach($objectsCommission as $rowM) {
            $i++;

           /* if($i%2 != 0){
              $ngColor = "#ffffff";
            }else{
               $ngColor = "#ffffff";
            }*/
           $contentTableSign1 .= '<tr bgcolor="#ffffff">
            <td align="center" >....</td> 

            <td align="center" >'.$rowM->nom_complet_ar.'</td>
            

            </tr>
            ';


    }

 $tableSign1=  $textSign1.$contentTableSign1.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($tableSign1, true, false, true, false, '');





$pdf->AddPage();


$pdf->Image($image_file1, 15, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>'.$university_name.'</h5>
</div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);



$pdf->Image($image_file, 120, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>Département de l\'Enseignement Supérieur </h5>
<h5>et de la Recherche Scientifique </h5></div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);


 

$titlePageExam2 = '';

$titlePageExam2 .= '<hr color="gray" /><h1 align="center">  <span dir="rtl">الاختبار الثاني</span> </h1>
  
<h2 align="center"><span dir="rtl">النتائج النهائية لمباراة توظيف '.$objects->type_name_ar.'</span> </h2>

<h2 align="center">'.$objects->specialty_fr.' <span dir="rtl">تخصص</span> </h2>


<h2 align="center"> '.date('Y-m-d',strtotime($objects->hire_date)).' <span dir="rtl">دورة</span> </h2>;

<h2 align="center"> <span dir="rtl">(ملحق رقم 2)</span> </h2><br />';


$pdf->writeHTML($titlePageExam2);
 
$pdf->Ln();

$textExamTwo = '<table width="100%" border="0.2" cellpadding="2" cellspacing="0">
    
      <tr>


      <td width="20%" align="center" bgcolor="#dddddd" >النتيجة</td>
      <td width="15%" align="center" bgcolor="#dddddd" >المعدل العام /20</td>
      <td width="15%" align="center" bgcolor="#dddddd" >نقطة الاختبار الثاني /20</td>
      <td width="15%" align="center" bgcolor="#dddddd" >نقطة الاختبار الأول /20</td>
      <td width="25%" align="center" bgcolor="#dddddd" >الاسم و النسب</td>
      <td width="10%" align="center" bgcolor="#dddddd" >الرقم الترتيبي </td>
   
      
      
      
 
      </tr>';
  $contentTableExamTwo = null;$i = 0;$ngColor = "#ffffff";$nbre_iter = 1;
  foreach($objectsExamTwo as $rowMExTwo) {
            $i++;

           $resultat = null;
           if($rowMExTwo->note_finale >= $objectFormule->pass_note_finale  && $nbre_iter <= $objects->post_number){
            
            $nbre_iter++;
            $resultat = 'ناجح';

           }elseif($rowMExTwo->note_finale < $objectFormule->pass_note_finale){
            $resultat = 'راسب';
           }elseif($rowMExTwo->note_finale >= $objectFormule->pass_note_finale && $nbre_iter >$objects->post_number){
            $resultat = 'لائحة الانتظار';
           }
 



           $contentTableExamTwo .= '<tr bgcolor="#ffffff">
            <td align="center" >'.$resultat.'</td> 
            <td align="center" >'.$rowMExTwo->note_finale.'</td>
            <td align="center" >'.$rowMExTwo->note_ex2.'</td>
            <td align="center" >'.$rowMExTwo->note_ex1.'</td>
            <td align="center" >'.($rowMExTwo->nom_ar.' '.$rowMExTwo->prenom_ar).'</td>
            <td align="center" >'.$i.'</td>
            

            </tr>
            ';


    }

 $tableExamTwo=  $textExamTwo.$contentTableExamTwo.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($tableExamTwo, true, false, true, false, '');


$contentsSignature2 = '';
$contentsSignature2 .= '<h2 align="center">توقيعات أعضاء اللجنة</h2><br />';
$pdf->writeHTML($contentsSignature2);

 $pdf->Ln();

 $textSign2 = '<table width="100%" border="0.2" cellpadding="2" cellspacing="0">
    
      <tr>


      <td width="50%" align="center" bgcolor="#dddddd" >التوقيع</td>
      <td width="50%" align="center" bgcolor="#dddddd" >الاسم و النسب</td>
   
      
      
      
 
      </tr>';
  $contentTableSign2 = null;$i = 0;$ngColor = "#ffffff";
  foreach($objectsCommission as $rowM) {
            $i++;

           /* if($i%2 != 0){
              $ngColor = "#ffffff";
            }else{
               $ngColor = "#ffffff";
            }*/
           $contentTableSign2 .= '<tr bgcolor="#ffffff">
            <td align="center" >....</td> 

            <td align="center" >'.$rowM->nom_complet_ar.'</td>
            

            </tr>
            ';


    }

 $tableSign2=  $textSign2.$contentTableSign2.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($tableSign2, true, false, true, false, '');






$pdf->AddPage();


$pdf->Image($image_file1, 15, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>'.$university_name.'</h5>
</div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);



$pdf->Image($image_file, 120, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>Département de l\'Enseignement Supérieur </h5>
<h5>et de la Recherche Scientifique </h5></div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);


 

$titlePageFinale = '';

$titlePageFinale .= '<hr color="gray" /><h1 align="center">  <span dir="rtl"></span> </h1>
  
<h2 align="center"><span dir="rtl">نتائج مباراة توظيف '.$objects->type_name_ar.'</span> </h2>

<h2 align="center">'.$objects->specialty_fr.' <span dir="rtl">تخصص</span> </h2>


<h2 align="center"> '.date('Y-m-d',strtotime($objects->hire_date)).' <span dir="rtl">دورة</span> </h2>';


$pdf->writeHTML($titlePageFinale);
 
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();


$contentsSuccess = '';
$contentsSuccess .= '<br /><h2 align="right">قائمة بأسماء المترشحين الناجحين حسب الاستحقاق</h2><br />';
$pdf->writeHTML($contentsSuccess);



$textSuccessFinale = '';

  $contentTableExamSuccessFinale = null;$i = 0;$ngColor = "#ffffff";$nbre_iterFinaleSuccess = 1;
  foreach($objectsExamTwo as $rowMExTwo) {
            $i++;

 

           if($rowMExTwo->note_finale >= $objectFormule->pass_note_finale  && $nbre_iterFinaleSuccess <= $objects->post_number){
            
            $nbre_iterFinaleSuccess++;
 
           $contentTableExamSuccessFinale .= '

            <p style="font-size: 10px;" align="right">'.($rowMExTwo->nom_ar.' '.$rowMExTwo->prenom_ar).'</p>
 
            
           ';

           }elseif($rowMExTwo->note_finale < $objectFormule->pass_note_finale){
            
           }elseif($rowMExTwo->note_finale >= $objectFormule->pass_note_finale && $nbre_iterFinaleSuccess >$objects->post_number){
       


           }


    }

 $tableSuccessFinale=  $textSuccessFinale.$contentTableExamSuccessFinale.'';
//  var_dump($table);
//  die();

$pdf->writeHTML($tableSuccessFinale, true, false, true, false, '');



$pdf->Ln();


$contentsSuccess = '';
$contentsSuccess .= '<br /><h2 align="right">قائمة الانتظار</h2><br />';
$pdf->writeHTML($contentsSuccess);



$textSuccessFinaleAtt = '';

  $contentTableExamSuccessFinaleAtt = null;$i = 0;$ngColor = "#ffffff";$nbre_iterFinaleSuccessAtt = 1;
  foreach($objectsExamTwo as $rowMExTwo) {
            $i++;

 

           if($rowMExTwo->note_finale >= $objectFormule->pass_note_finale  && $nbre_iterFinaleSuccessAtt <= $objects->post_number){
            
            $nbre_iterFinaleSuccessAtt++;
 
          

           }elseif($rowMExTwo->note_finale < $objectFormule->pass_note_finale){
            
           }elseif($rowMExTwo->note_finale >= $objectFormule->pass_note_finale && $nbre_iterFinaleSuccessAtt >$objects->post_number){
       
             $contentTableExamSuccessFinaleAtt .= '

            <p style="font-size: 10px;" align="right">'.($rowMExTwo->nom_ar.' '.$rowMExTwo->prenom_ar).'</p>
 
            
           ';

           }


    }

 $tableSuccessFinaleAtt=  $textSuccessFinaleAtt.$contentTableExamSuccessFinaleAtt.'';
//  var_dump($table);
//  die();

$pdf->writeHTML($tableSuccessFinaleAtt, true, false, true, false, '');


$contentsSignature3 = '';
$contentsSignature3 .= '<h2 align="center">توقيعات أعضاء اللجنة</h2><br />';
$pdf->writeHTML($contentsSignature3);

 $pdf->Ln();

 $textSign3 = '<table width="100%" border="0.2" cellpadding="2" cellspacing="0">
    
      <tr>


      <td width="50%" align="center" bgcolor="#dddddd" >التوقيع</td>
      <td width="50%" align="center" bgcolor="#dddddd" >الاسم و النسب</td>
   
      
      
      
 
      </tr>';
  $contentTableSign3 = null;$i = 0;$ngColor = "#ffffff";
  foreach($objectsCommission as $rowM) {
            $i++;

           /* if($i%2 != 0){
              $ngColor = "#ffffff";
            }else{
               $ngColor = "#ffffff";
            }*/
           $contentTableSign3 .= '<tr bgcolor="#ffffff">
            <td align="center" >....</td> 

            <td align="center" >'.$rowM->nom_complet_ar.'</td>
            

            </tr>
            ';


    }

 $tableSign3=  $textSign3.$contentTableSign3.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($tableSign3, true, false, true, false, '');





  
 ob_end_clean();
// ---------------------------------------------------------
 

//============================================================+
// END OF FILE
//============================================================+


  $pdf->Output('example_001.pdf', 'I');
 

 

 ?>
 

 











