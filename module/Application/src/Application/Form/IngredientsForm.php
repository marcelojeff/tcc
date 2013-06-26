<?php
namespace Application\Form;

use Zend\Form\Form;

class IngredientsForm extends Form
{
    //TODO form validations
    //TODO use zend translate
    public function __construct($name = null){
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'Nome',
            ),
            'options' => array(
                'label' => 'Nome',
                'label_attributes' => array(
                		'class'  => 'control-label'
                ),
            ),
        ));
        $this->add(array(
            'name' => 'link',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'Link',
            ),
            'options' => array(
                'label' => 'Link',
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
                'value' => 'Salvar',
            ),
        ));
    }
}