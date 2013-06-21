<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/UserControl for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace UserControl\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use UserControl\Form\LoginForm;

//TODO Logout Action
//TODO Acl
//TODO forms validation
//TODO rename controller to User
//TODO crud for users (for users and admin with user types)
class IndexController extends AbstractActionController
{
    public function indexAction(){
        return array();
    }
    public function loginAction(){
        $form = new LoginForm();
        //TODO get data and create session
        return array('form' => $form);
    }
}
