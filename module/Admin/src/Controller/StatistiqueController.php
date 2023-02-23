<?php
namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Admin\Form\CategorieForm;
use Admin\Model\Candidat;
use Admin\Model\CandidatTable;
use Admin\Model\UsersTable;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Hydrator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * StatistiqueController
 *
 * @author
 *
 * @version
 *
 */
class StatistiqueController extends AbstractRestfulController 
{
   // Add this property:
   /**
    * inject candidat table 
    */
    private $candidatTable; 

    /**
     * inject user table
     */
    private $userTable;


    private $hydrator;

    // Add this constructor:
    public function __construct(CandidatTable $candidatTable , UsersTable $userTable)
    {
        $this->candidatTable = $candidatTable;
        $this->userTable = $userTable;
        $this->hydrator  = new Hydrator\ArraySerializableHydrator();
    }
    /**
     * Action get List of categories
     */
    public function getListAction()
    {
        $created_by = $this->params()->fromRoute('id', 0);
        $candidatsByMonth = $this->candidatTable->candidatsBymonth(date('Y'));
        $candidatsTotal = $this->candidatTable->candidatsInscrits(date('Y'));
        $candidatsInscritsBySearch = $this->candidatTable->candidatsInscritsBySearchOrg(date('Y'));
        $candidatsInscritsByDevice = $this->candidatTable->candidatsInscritsByDevice(date('Y'));
        $candidatsInscritsByCountry= $this->candidatTable->candidatsInscritsByCountry(date('Y'));
        $candidatsInscritsGlobal= $this->candidatTable->candidatsInscritsGlobal(date('Y'));
        return new JsonModel([
                "post_by_month" => $candidatsByMonth , 
                "nbre_total_candidat" => $candidatsTotal ,
                "nbre_inscrits_by_search" => $candidatsInscritsBySearch, 
                "nbre_inscrits_by_device" => $candidatsInscritsByDevice,
                "datacountry" => $candidatsInscritsByCountry,
                "data_glob" => $candidatsInscritsGlobal,
                "status" => $this->response->getStatusCode()
                ]);
        
    }

    public function exportDataAction(){

        $reader = IOFactory::createReader('Xlsx');

        //$spreadsheet = new Spreadsheet();
        $spreadsheet =$reader->load("template.xlsx");

        $sheet = $spreadsheet->getActiveSheet();
        //get data from database 
        $candidats = $this->candidatTable->fetchAll();

        $styleArrayFirstRow = [
            'font' => [
                'bold' => true,
            ]
        ];

        //Retrieve Highest Column (e.g AE)
        $highestColumn = $sheet->getHighestColumn();
        
   
        //loading data
        $row = 5;
        $i = 0;
        foreach($candidats as $candidat){
            $i++;
            //push data into file 
            $sheet->setCellValue('A'.$row, $i);
            $sheet->setCellValue('B'.$row, $candidat['fullname']);
            $sheet->setCellValue('C'.$row, $candidat['tel']);
            $sheet->setCellValue('D'.$row, $candidat['email']);
            $sheet->setCellValue('E'.$row, $candidat['subject']);
            $sheet->setCellValue('F'.$row, $candidat['message']);
            $row++;
        }
        
        
        
        $writer = new Xlsx($spreadsheet);
        if($writer->save('data_iew.xlsx')){
            return true;
        }

        return false;
    }

    /**
     * get config salt 
     */
    public function getConfigSalt(){
        return ['static_salt' => 'aFGQ475SDsdfsaf2342'];
    }

 
    
 
    
    
}