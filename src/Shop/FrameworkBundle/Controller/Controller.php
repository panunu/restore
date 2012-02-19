<?php

namespace Shop\FrameworkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController,
    Symfony\Component\Form\Form;

class Controller extends BaseController
{
    /**
     * @param  string $message
     * @return Controller
     */
    public function notify($message)
    {
        $this->getRequest()->getSession()->setFlash('notice', $message);
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getNotification()
    {
        return $this->getRequest()->getSession()->getFlash('notice');
    }
    
    /** 
     * @param Form     $form
     * @param function $callback 
     * @param 
     */
    protected function handleForm(Form $form, $callback)
    {
        if ($this->isRequestPost() && $this->isFormValid($form)) {
            $callback($form);
        }
        
        return $this;
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