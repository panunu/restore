<?php

namespace Shop\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Tax")
 * @ORM\Entity(repositoryClass="Shop\ProductBundle\Repository\TaxRepository")
 */
class Tax
{
    const TYPE_GENERAL = 1, TYPE_FOOD = 2, TYPE_CULTURE = 3;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="integer", length="1", nullable=false)
     */
    protected $type;
    
    /**
     * @var float
     *
     * @ORM\Column(name="percent", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $percent;
    
    /**
     * @var float
     *
     * @ORM\Column(name="validity", type="datetime", nullable=false)
     */
    protected $validity;
    
    /**
     * @return array
     */
    public static function getTaxTypes()
    {
        return array(
            self::TYPE_GENERAL => 'Products and services (23% 1.1.2012)',
            self::TYPE_FOOD    => 'Food and groceries (13% 1.1.2012)',
            self::TYPE_CULTURE => 'Culture, literature, medicine (9% 1.1.2012)'
        );
    }
    
    /**
     * @return array
     */
    public static function getTaxTypeValues()
    {
        return array_keys(self::getTaxTypes());
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param integer $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set percent
     *
     * @param decimal $percent
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
    }

    /**
     * Get percent
     *
     * @return decimal 
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set validity
     *
     * @param datetime $validity
     */
    public function setValidity($validity)
    {
        $this->validity = $validity;
    }

    /**
     * Get validity
     *
     * @return datetime 
     */
    public function getValidity()
    {
        return $this->validity;
    }
}