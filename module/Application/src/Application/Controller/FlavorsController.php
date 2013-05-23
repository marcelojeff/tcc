<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Flavors;

/**
 * FlavorsController
 *
 * @author
 *
 *
 * @version
 *
 *
 */
class FlavorsController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction ()
    {
        // TODO Auto-generated FlavorsController::indexAction() default action
        return new ViewModel();
    }

    public function listAction ()
    {
        $pizzeria = $this->params('pizzeria');
        $product = $this->params('product');
        $flavors = new Flavors();
        $results = $flavors->getList($pizzeria, $product);
        return array(
            'flavors' => $results['flavors'],
            'ingredients' => $results['ingredients']
        );
    }
}