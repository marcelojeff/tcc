<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\Products;

/**
 * ProductsController
 *
 * @author
 *
 *
 * @version
 *
 *
 */
class ProductsController extends AbstractActionController
{

    public function indexAction ()
    {
        // TODO Auto-generated ProductsController::indexAction() default action
        return array();
    }

    public function listAction ()
    {
        $pizzeria = $this->params('pizzeria');
        $products = new Products();
        return array(
            'products' => $products->getProductsByPizzeria($pizzeria),
            'pizzeria' => $pizzeria
        );
    }
}