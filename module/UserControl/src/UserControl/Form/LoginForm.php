<?php
namespace UserControl\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    //TODO form validations
    //TODO use zend translate
    public function __construct($name = null){
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'Email',
            ),
            'options' => array(
                'label' => 'Email',
                'label_attributes' => array(
                		'class'  => 'control-label'
                ),
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'placeholder' => 'Password',
            ),
            'options' => array(
                'label' => 'Password',
                'label_attributes' => array(
                		'class'  => 'control-label'
                ),
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'class' => 'btn',
                'type'  => 'submit',
                'value' => 'Login',
            ),
        ));
    }
}