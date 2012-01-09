<?php

namespace Shop\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{    
    public function testAction()
    {
        return $this->render('ShopMainBundle:Test:test.html.twig');
    }
}