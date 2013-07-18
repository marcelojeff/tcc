<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\IngredientsForm;
use Application\Model\Ingredients;

class IngredientsController extends AbstractActionController
{
    //TODO desfazer o eXtreme GoHorse
    public function newAction() {
        if(!empty($_POST)){
            $model = new Ingredients();
            unset($_POST['submit']);
            $model->create($_POST);
            $this->redirect()->toUrl('/application/ingredients/list');
        }
    	$form = new IngredientsForm();
        return array('form'=>$form);
    }
    public function listAction(){
        $model = new Ingredients();
        return array('ingredients' => $model->getList());
    }
}

?>