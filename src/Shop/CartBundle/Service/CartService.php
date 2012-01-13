<?php

namespace Shop\CartBundle\Service;

use \Symfony\Component\HttpFoundation\Session;

class CartService
{
    /**
     * @var Session
     */
    protected $session;
    
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
}