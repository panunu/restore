<?php

namespace Shop\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Shop\FrameworkBundle\Entity\AbstractEntity as Entity;

/**
 * @ORM\Table(name="Tax")
 * @ORM\Entity
 */
class Tax extends Entity
{
    const TYPE_GENERAL = 1, TYPE_FOOD = 2, TYPE_CULTURE = 3, TYPE_REPAIR = 4;
    
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
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Product", mappedBy="Tax")
     */
    protected $products;
    
    /**
     * @return array
     */
    public static function getTaxTypes()
    {
        return array(
            self::TYPE_GENERAL, self::TYPE_FOOD, self::TYPE_CULTURE, self::TYPE_REPAIR
        );
    }
    
    /**
     * @return array
     */
    public static function getTaxTypeValues()
    {
        return array_values(self::getTaxTypes());
    }
}