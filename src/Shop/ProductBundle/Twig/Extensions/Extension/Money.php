<?php

namespace Shop\ProductBundle\Twig\Extensions\Extension;

use \Twig_Extension,
    \Twig_Filter_Method;

class Money extends Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array('money' => 
            new Twig_Filter_Method($this, 'money', array('is_safe' => array('html')))
        );
    }
    
    /**
     * @param type $money
     * @return type 
     */
    public function money($money)
    {
        return number_format($money, 2, ',', '') . '&nbsp;&euro;';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'money_extension';
    }
}