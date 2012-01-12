<?php

namespace Shop\FrameworkBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase,
    Symfony\Component\DependencyInjection\ContainerInterface,
    \Doctrine\ORM\EntityManager,
    \Doctrine\ORM\Tools\SchemaTool;

abstract class TestCase extends WebTestCase
{
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->em     = $this->getContainer()->get('doctrine.orm.entity_manager');

        $this->setupSchema();
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }
    
    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->getClient()->getContainer();
    }
        
    /**
     * @return EntityTestCase
     */
    protected function setupSchema()
    {
        $tool = new SchemaTool($this->em);
        $tool->dropDatabase();
        $tool->createSchema($this->em->getMetadataFactory()->getAllMetadata());
        
        return $this;
    }
}