<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

//declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Model\Categorie;
use Application\Model\CategorieTable;
use Application\Model\Candidat;
use Application\Model\CandidatTable;
use Application\Form\PostForm;
use Application\Form\CandidatForm;

class CandidatController extends AbstractActionController
{

    protected $categoryTable;

    protected $candidatTable;

    private $form;

    private $candidatForm;

 

      // Add this constructor:
      public function __construct(CategorieTable $categorieTable, PostForm $form,CandidatTable $candidatTable, CandidatForm $candidatForm)
      {
          $this->categoryTable = $categorieTable;
          $this->form = $form;
          $this->candidatTable = $candidatTable;
          $this->candidatForm = $candidatForm;
      }
  
    public function get_ip_detailAction($ip){

        $ip_response = file_get_contents('http://ip-api.com/json/'.$ip);
        $ip_array=json_decode($ip_response);
        return  $ip_array;
    }


    public function isMobileDevAction(){ //detect mobile connected or no 
        if(isset($_SERVER['HTTP_USER_AGENT']) and !empty($_SERVER['HTTP_USER_AGENT'])){
           $user_ag = $_SERVER['HTTP_USER_AGENT'];
           if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){
              return true;
           };
        };
        return false;
    }


    public function inscriptionAction()
    {
        $form = new CandidatForm();
        $form->get('validate')->setValue("S'inscrire");
        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }
        $tok = $request->getPost()['token'];
     
        $url_verify_token = "https://www.google.com/recaptcha/api/siteverify?secret=6LfJsqQeAAAAALTh9eqpB_hK3ucPobdnP7wQYEaH&response={$tok}"; //google recaptcha validation url
        $response = file_get_contents($url_verify_token);
        $result_of_validation_recaptcha = json_decode($response);

        if($result_of_validation_recaptcha->success == true && $result_of_validation_recaptcha->score > 0.5){


            $candidat = new Candidat();
            $form->setInputFilter($candidat->getInputFilter());
            $form->setData($request->getPost());
      

            if (! $form->isValid()) {
                return ['form' => $form];
            }

            $candidat->exchangeArray($form->getData());
            /**
             * get user ip and add user geolocalisation options
             */
            $user_ip=$_SERVER['REMOTE_ADDR'];
            $geo_localisation_array = $this->get_ip_detailAction("41.143.48.122");
            $mobile_connected_device = ($this->isMobileDevAction() === true ) ? "Mobile Device" : "Web Site" ;
            $referer_url = $_SERVER['HTTP_REFERER'];
            $search_organic = (str_contains($referer_url, 'google.com') === true) ? 'Google search' : 'Other search';
            $this->candidatTable->saveCandidat($candidat , $geo_localisation_array , $search_organic ,$mobile_connected_device,$referer_url);
            //$this->flashMessenger()->addMessage('<div class="alert alert-success" role="alert"><b>Added Successfully...</b></div>');
             return $this->redirect()->toRoute('register',['action' => 'index','message' => 'success']);
        }else{
            return $this->redirect()->toRoute('register',['action' => 'index','message' => 'faild']);
        }
        
                      
    }

    
}
