<?php

namespace Shop\FrameworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController,
    Symfony\Component\Form\Form;

class Controller extends BaseController
{
    protected function handleForm(Form $form, $callback)
    {
        if ($this->isRequestPost() && $this->isFormValid($form)) {
            $callback($form);
        }
    }

    /**
     * @return boolean
     */
    protected function isRequestPost()
    {
        return $this->getRequest()->getMethod() == 'POST';
    }
    
    /**
     * @param  Form $form
     * @return Form|boolean
     */
    protected function isFormValid(Form $form)
    {
        return $form->bindRequest($this->getRequest())->isValid();
    }
}