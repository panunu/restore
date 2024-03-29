<?php

namespace Shop\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Shop\FrameworkBundle\Entity\AbstractEntity as Entity;

/**
 * @ORM\Table(name="Product")
 * @ORM\Entity(repositoryClass="Shop\ProductBundle\Repository\ProductRepository")
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
     * @ORM\Column(name="priceWithTax", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $priceWithTax;
    
    /**
     * @var int
     *
     * @ORM\Column(name="tax", type="integer", length="2", nullable=false)
     */
    protected $tax;
    
    /**
     * @var Brand
     * 
     * @ORM\ManyToOne(targetEntity="Shop\BrandBundle\Entity\Brand")
     */
    protected $brand;
    
    /**
     * @var Category
     * 
     * @ORM\ManyToOne(targetEntity="Shop\ProductBundle\Entity\Category")
     */
    protected $category;
}