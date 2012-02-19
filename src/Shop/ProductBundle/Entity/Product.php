<?php

namespace Shop\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Gedmo\Mapping\Annotation as Gedmo,
    Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="Product")
 * @ORM\Entity(repositoryClass="Shop\ProductBundle\Repository\ProductRepository")
 */
class Product
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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length="100", nullable=false)
     * @Assert\NotBlank()
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
     * @Assert\NotBlank()
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
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set priceWithTax
     *
     * @param decimal $priceWithTax
     */
    public function setPriceWithTax($priceWithTax)
    {
        $this->priceWithTax = $priceWithTax;
    }

    /**
     * Get priceWithTax
     *
     * @return decimal 
     */
    public function getPriceWithTax()
    {
        return $this->priceWithTax;
    }

    /**
     * Set tax
     *
     * @param integer $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * Get tax
     *
     * @return integer 
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set brand
     *
     * @param Shop\BrandBundle\Entity\Brand $brand
     */
    public function setBrand(\Shop\BrandBundle\Entity\Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Get brand
     *
     * @return Shop\BrandBundle\Entity\Brand 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set category
     *
     * @param Shop\ProductBundle\Entity\Category $category
     */
    public function setCategory(\Shop\ProductBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Shop\ProductBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}