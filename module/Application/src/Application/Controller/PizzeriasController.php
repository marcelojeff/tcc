<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\Pizzerias;

/**
 * PizzeriasController
 *
 * @author
 *
 *
 * @version
 *
 *
 */
class PizzeriasController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function indexAction ()
    {
        $pizzerias = new Pizzerias();
        return array(
            'pizzerias' => $pizzerias->getList()
        );
    }
}