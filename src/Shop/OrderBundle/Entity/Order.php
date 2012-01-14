<?php

namespace Shop\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Shop\FrameworkBundle\Entity\AbstractEntity as Entity;

/**
 * @ORM\Table(name="Order")
 * @ORM\Entity
 */
class Order extends Entity
{
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
     * @ORM\Column(name="number", type="string", columnDefinition="UNSIGED INTEGER(8) ZEROFILL", nullable=false)
     */
    protected $number;
    
    /**
     * @var float
     *
     * @ORM\Column(name="tax", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $totalTax;
    
    /**
     * @var float
     *
     * @ORM\Column(name="totalWithoutTax", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $totalWithoutTax;
    
    /**
     * @var float
     *
     * @ORM\Column(name="totalWithTax", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $totalWithTax;
    
    /**
     * @var array
     * 
     * @ORM\ManyToMany(targetEntity="Product")
     * @ORM\JoinTable(name="OrderProduct",
     *  joinColumns={@ORM\JoinColumn(name="Order", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="Product", referencedColumnName="id")}
     * )
     */    
    protected $products;
}