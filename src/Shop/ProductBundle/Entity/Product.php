<?php

namespace Shop\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Shop\FrameworkBundle\Entity\AbstractEntity as Entity;

/**
 * @ORM\Table(name="Product")
 * @ORM\Entity
 */
class Product extends Entity
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    protected $name;
    
    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $price;
    
    /**
     * @var Tax
     *
     * @ORM\ManyToOne(targetEntity="Tax", inversedBy="products")
     * @ORM\JoinColumn(name="Tax", referencedColumnName="id")
     */
    protected $tax;
}