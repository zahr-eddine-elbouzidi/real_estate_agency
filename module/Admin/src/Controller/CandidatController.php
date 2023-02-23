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
 * CandidatController
 *
 * @author
 *
 * @version
 *
 */
class CandidatController extends AbstractRestfulController 
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
        $candidats = $this->candidatTable->fetchAll();
        return new JsonModel([
                "data" => $candidats , 
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
            $sheet->setCellValue('C'.$row, $candidat['email']);
            $sheet->setCellValue('D'.$row, $candidat['tel']);
            $sheet->setCellValue('E'.$row, $candidat['subject']);
            $sheet->setCellValue('F'.$row, $candidat['message']);
            $row++;
        }
        
        
        
        $writer = new Xlsx($spreadsheet);
        if($writer->save('public/data_iew.xlsx')){
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


    /**
     * get category by id param
     * @param category_id
     */
    public function getCategoryAction(){

        $category_id = $this->params()->fromRoute('id', 0);  

        $category = $this->categoryTable->getCategory($category_id);
  
        return new JsonModel(
            ['data' => $this->hydrator->extract($category)]
        );
    }

    public function getCandidatAction(){

        $candidat_id = $this->params()->fromRoute('id', 0);  

        $candidat = $this->candidatTable->getCandidat($candidat_id);
  
        return new JsonModel(
            ['data' => $this->hydrator->extract($candidat)]
        );
    }

    
     /**
      * delete action
      * @param id from url params
      */
     public function deleteAction()
     {
  
            $id = (int) $this->params()->fromRoute('id', 0);
            $created_by = $this->params()->fromRoute('name');
            $staticSalt = $this->getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->userTable->getUserByToken($created_by);
            $category = $this->categoryTable->getCategory($id);
            $this->categoryTable->deleteCategorie($category->getId());
            return true;
      }
    
    
}