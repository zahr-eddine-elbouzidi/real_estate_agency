 
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
$objects = json_decode($_POST['hidden']);

$user = $_POST['hiddenUser'];
$logoFilename = $_POST['hiddenLogo'];
$university_name = $_POST['hiddenUniversity'];


$type = $_POST['typeHidden'];
$titleType = (isset($type) && $type == 'ecritOrdre') ? 'Liste des candidats par ordre de mérite' : 'Liste des candidats convoqués à l\'oral par ordre de mérite';

$titleType_ar = (isset($type) && $type == 'ecritOrdre') ? 'لائحة المترشحين حسب الاستحقاق' : 'لائحة المترشحين لاجتياز الاختبار الشفوي حسب الاستحقاق';
//var_dump($objects);
//die(); 
 

require_once('tcpdf/tcpdf_include.php');
require_once('tcpdf/tcpdf.php');
require_once('tcpdf/tcpdf_barcodes_2d.php');
require_once('tcpdf/examples/barcodes/tcpdf_barcodes_2d_include.php');
  


class MYPDF extends TCPDF {

    //Page header
   //  public function Header() {
     //    //var_dump(K_PATH_IMAGES);
     //    //die();
     //    //$image_file = K_PATH_IMAGES.'enssup.jpg';
     //    //$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

     //   // $this->Image($image_file,140, 10, 15, '', 'JPG', '', 'T', false, 400, '', false, false, 0, false, false, false);
     //    // Set font
     //    $this->SetFont('helvetica', 'B', 20);
     //   //  $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
     //    // Title
       
     // } 

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
$contents .= '<hr color="gray" /><h1 align="center">'.$titleType.'</h1><h1 dir="rtl" align="center">'.$titleType_ar.'</h1> <br />
<h2 align="center">Concours de recrutement  <br /> '.$objects[0]->type_name.' ('.$objects[0]->post_number.' post(s)) - <span dir="rtl">'.$objects[0]->type_name_ar.'</span> <br />'.$objects[0]->specialty_fr.' <br /> Session '.date('d-m-Y',strtotime($objects[0]->hire_date)).'</h2><br />';
$pdf->writeHTML($contents);
 

$style = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(14,91,147),
    'bgcolor' => false
);

 

 $pdf->Ln();
 $pdf->Ln();
 $text = '<table width="100%" border="0" cellpadding="2" cellspacing="0">
    
      <tr>
      <td width="5%" align="center"  bgcolor="#0099ff" > N° Ordre</td>
      <td width="25%" align="center" bgcolor="#0099ff" >N° CIN</td>
      <td width="40%" align="center" bgcolor="#0099ff" >Nom et Prénom</td>
      <td width="30%" align="center" bgcolor="#0099ff" >الإسم والنسب</td>
 
      </tr>';
  $contentTable = null;$i = 0;$ngColor = "#ffffff";
foreach($objects as $row) {
          $i++;

          if($i%2 != 0){
            $ngColor = "#f2f2f2";
          }else{
             $ngColor = "#ffffff";
          }
         $contentTable .= '<tr bgcolor="'.$ngColor.'">
          <td align="center" >'.$i.'</td>
          <td align="center" >'.$row->cin.'</td>
          <td align="center">'.strtoupper($row->nom).' '.strtoupper($row->prenom).'</td>
          <td align="center">'.$row->prenom_ar.' '.$row->nom_ar.'</td>
          </tr>
          ';


  }

 $table=  $text.$contentTable.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($table, true, false, true, false, '');
 
// print colored table
//$pdf->ColoredTable($header,$objects);


  

$pdf->Ln();
 

  
 ob_end_clean();
// ---------------------------------------------------------
 

//============================================================+
// END OF FILE
//============================================================+


  $pdf->Output('example_001.pdf', 'I');
 

 

 ?>
 

 











