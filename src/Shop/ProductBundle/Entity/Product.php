<?php

namespace Shop\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    \Gedmo\Mapping\Annotation as Gedmo,
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
     * @Gedmo\Slug(fields={"brand", "name"})
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length="100", nullable=false)
     */
    protected $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length="1000", nullable=true)
     */
    protected $description;    
    
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