<?php

namespace Shop\ProductBundle\Service;

use \Symfony\Component\HttpFoundation\Session;

class HistoryService
{
    /**
     * @var Session
     */
    protected $session;
        
    /**
     * @param Session $session 
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    /**
     *
     * @param  string $url
     * @return HistoryService
     */
    public function saveUrl($url)
    {
        $this->session->set('history', $url);
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->session->get('history');
    }
}
