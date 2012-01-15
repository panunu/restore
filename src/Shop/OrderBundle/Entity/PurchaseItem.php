<?php

namespace Shop\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Shop\FrameworkBundle\Entity\AbstractEntity as Entity,
    Shop\ProductBundle\Entity\Product;

/**
 * @ORM\Table(name="PurchaseItem")
 * @ORM\Entity
 */
class PurchaseItem extends Entity
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
     * @var float
     *
     * @ORM\Column(name="taxPercent", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $taxPercent;
    
    /**
     * @var float
     *
     * @ORM\Column(name="tax", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $tax;
    
    /**
     * @var float
     *
     * @ORM\Column(name="priceWithoutTax", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $priceWithoutTax;
    
    /**
     * @var float
     *
     * @ORM\Column(name="priceWithTax", type="decimal", length="8", scale="2", nullable=false)
     */
    protected $priceWithTax;
    
    /**
     * @var Purchase
     * 
     * @ORM\ManyToOne(targetEntity="Purchase", inversedBy="items")
     */
    protected $purchase;
    
    /**
     * @var Product
     * 
     * @ORM\ManyToOne(targetEntity="Shop\ProductBundle\Entity\Product")
     */
    protected $product;
    
    /**
     * @param Product $product 
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}