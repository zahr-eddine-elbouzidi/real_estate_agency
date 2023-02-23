 
<?php 
 

 
if(!isset($_POST['submit'])) exit;

$objects = json_decode($_POST['hidden']);
$candidat = json_decode($_POST['candidat']);
$files = json_decode($_POST['files']);

if($objects->prepared == 0 || $objects->prepared == NULL){
  echo "<center><h1>Veuillez préparer votre reçu.</h1></center>";
  die();
}
//var_dump($files);
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
 
$pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
 
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ZAHR-EDDINE ELBOUZIDI');
$pdf->SetTitle('E-Concours | Reçu de dépôt');
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

$image_file1 = K_PATH_IMAGES.'enssupp.jpg';
//$pdf->Image($image_file1, 15, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

/*$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:normal;line-height:5px;padding-left:150px;">
 <h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la </h5>
<h5>Recherche Scientifique </h5>
<h5>Université Cadi Ayyad</h5>
</div><br /><br />
  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);*/



$pdf->Image($image_file, 15, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', '


<div style="font-weight:bold;line-height:6px;padding-left:150px;">
<h5>Royaume du Maroc</p>
<h5>Ministère de l\'Education Nationale, de la Formation</h5>
<h5>Professionnelle, de l\'Enseignement Supérieur et de la Recherche Scientifique</h5>
<h5>Département de l\'Enseignement Supérieur et de la Recherche Scientifique</h5>
<h5>'.$objects->university_name.' </h5>
</div><br /><br />

  ', $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'top', $autopadding = true);

 

//$pdf->SetPrintHeader(false);

 
// column titles
$header = array('Session', 'Etablissement', 'Grade', 'Spécialité' , 'Date de postulation');
 
 
$contents = '';
$contents .= '<hr color="gray" /><h1 align="center"> Reçu de dépôt</h1> <br /><br />';
$pdf->writeHTML($contents);

$pdf->writeHTML('

    <br /><h3 align="right" style="padding-top:10px;"> Candidature N° '.$objects->postule_id.' </h3>  

  ', true, false, true, false, '');

$style = array(
    'border' => false,
    'padding' => 0,
    'fgcolor' => array(14,91,147),
    'bgcolor' => false
);

 

$pdf->write2DBarcode($objects->qr, 'QRCODE,H', 180, 35, 25, 25, $style, 'N');
 
 

$pdf->writeHTML('

    <h3 align="left"><u>Informations Personnelles</u></h3>  
    <h4 align="left"> Nom complet :<b>'.strtoupper($candidat->nom).' '.strtoupper($candidat->prenom).'</b> - <b>'.strtoupper($candidat->prenom_ar).' '.strtoupper($candidat->nom_ar).'</b></h4>
    <h4 align="left"> Carte d\'Identité Nationale : '.$candidat->cin.'</h4> 
    <h4 align="left"> Ville : '.strtoupper($candidat->lieu_naiss).'</h4> 
    <h4 align="left"> Adresse : '.strtoupper($candidat->adresse_fr).'</h4> 
    <h4 align="left"> Diplôme : '.$candidat->diplome.'</h4> 
    <h4 align="left"> Spécialité du diplôme : '.strtoupper($candidat->specialite).'</h4> <br /><br /><hr />
     



  ', true, false, true, false, '',$style);

 $pdf->Ln();
 $pdf->Ln();
 $text = '<h3>Le Poste</h3><table width="100%" border="0" cellpadding="2" cellspacing="0">
    
      <tr>
      <td width="20%" align="center"  bgcolor="#0099ff" >Session</td>
      <td width="20%" align="center" bgcolor="#0099ff" >Etablissement</td>
      <td width="20%" align="center" bgcolor="#0099ff" >Grade</td>
      <td width="20%" align="center" bgcolor="#0099ff" >Spécialité</td>
      <td width="20%" align="center" bgcolor="#0099ff" >Date de postulation</td>
 
      </tr>';
  $contentTable = null;$i = 0;$ngColor = "#ffffff";

 // var_dump($objects);
 // die();
//foreach($objects as $row) {
          //$i++;

          if($i%2 != 0){
            $ngColor = "#f2f2f2";
          }else{
             $ngColor = "#ffffff";
          }
         $contentTable .= '<tr bgcolor="'.$ngColor.'">
          <td align="center">'.date('d-m-Y',strtotime($objects->hire_date)).'</td>
          <td align="center">'.$objects->etablissement_name.'</td>
          <td align="center">'.$objects->type_name.'</td>
          <td align="center">'.$objects->specialty_fr.'</td>
          <td align="center">'.date('d-m-Y h:i:s',strtotime($objects->postuled_at)).'</td>
           </tr>
          ';


  //}

 $table=  $text.$contentTable.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($table, true, false, true, false, '');
 
$pdf->Ln();
 $textFiles = '<hr /><h3>Fichiers déposés</h3><table width="100%" border="0" cellpadding="2" cellspacing="0">
    
      <tr>
      <td width="15%" align="center"  bgcolor="#0099ff" >N°</td>
      <td width="70%" align="center"  bgcolor="#0099ff" >Type du fichier</td>
      <td width="15%" align="center" bgcolor="#0099ff" >Nombre de document attachés</td>
 
      </tr>';
  $contentTableCount = null;$index = 0;$ngColor = "#ffffff";

 // var_dump($objects);
 // die();
foreach($files as $row) {
          $index++;

          if($index%2 != 0){
            $ngColor = "#f2f2f2";
          }else{
             $ngColor = "#ffffff";
          }
         $contentTableCount .= '<tr bgcolor="'.$ngColor.'">
          <td align="center">'.$index.'</td>
          <td align="left">'.$row->type.'</td>
          <td align="center">'.$row->nbre_files.'</td>
           </tr>
          ';


}

 $tableCountsFiles=  $textFiles.$contentTableCount.'</table>';
//  var_dump($table);
//  die();

$pdf->writeHTML($tableCountsFiles, true, false, true, false, '');


  

$pdf->Ln();



$contentsFooter = '';
$contentsFooter .= '<hr color="gray" />
              <div style="font-weight:normal;text-align:center;padding-top:800px;vertical-align:bottom;">
              <p>Tout fausse information entraînera l\'annulation  de votre candidature.<br />N.B: Ce reçu ne vous qualifie pas pour participer au concours définitivement, C\'est juste une justification de postulation si vous ne supprimez pas votre candidature ou un fichier attaché pour ce poste.<br /><small>Ref:'.$objects->pk.'</small><p></div>';
$pdf->writeHTML($contentsFooter);
//$pdf->writeHTMLCell(80, 0, $contents, 1, $ln=0, 'C', 0, '', 0, false, 'B', 'C');

 //$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $contents, $border = 0, $ln = 1, $fill = 0, $reseth = false, $align = 'bottom', $autopadding = true);

  
 ob_end_clean();
// ---------------------------------------------------------
 

//============================================================+
// END OF FILE
//============================================================+


  $pdf->Output('example_001.pdf', 'I');
 

 

 ?>
 

 










