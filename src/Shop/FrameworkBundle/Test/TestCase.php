<?php

namespace Shop\FrameworkBundle\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase,
    Symfony\Component\DependencyInjection\ContainerInterface,
    \Doctrine\ORM\EntityManager,
    \Doctrine\ORM\Tools\SchemaTool,
    Shop\FrameworkBundle\Test\Fixtures\FixtureFactory;

abstract class TestCase extends WebTestCase
{
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * @var Client
     */
    protected $client;
    
    /**
     * @var FixtureFactory
     */
    protected $factory;

    public function setUp()
    {
        parent::setUp();

        $this->client  = static::createClient();
        $this->em      = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $this->setupSchema($this->em);
        
        $this->factory = new FixtureFactory($this->em);
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->em;
    }
    
    /**
     * @return FixtureFactory
     */
    public function getFixtureFactory()
    {
        return $this->factory;
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
    protected function setupSchema(EntityManager $em)
    {
        $tool = new SchemaTool($em);
        $tool->dropDatabase();
        $tool->createSchema($em->getMetadataFactory()->getAllMetadata());
        
        return $this;
    }
}