<?php

namespace Shop\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Shop\ProductBundle\Entity\Product;

/**
 * @ORM\Table(name="PurchaseItem")
 * @ORM\Entity
 */
class PurchaseItem
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
     * @var float
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    protected $quantity;
    
    /**
     * @var Product
     * 
     * @ORM\ManyToOne(targetEntity="Shop\ProductBundle\Entity\Product")
     */
    protected $product;
    
    /**
     * @var Purchase
     * 
     * @ORM\ManyToOne(targetEntity="Purchase", inversedBy="items")
     */
    protected $purchase;
    
    /**
     * @param Product $product 
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
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
     * Set taxPercent
     *
     * @param decimal $taxPercent
     */
    public function setTaxPercent($taxPercent)
    {
        $this->taxPercent = $taxPercent;
    }

    /**
     * Get taxPercent
     *
     * @return decimal 
     */
    public function getTaxPercent()
    {
        return $this->taxPercent;
    }

    /**
     * Set tax
     *
     * @param decimal $tax
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    /**
     * Get tax
     *
     * @return decimal 
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set priceWithoutTax
     *
     * @param decimal $priceWithoutTax
     */
    public function setPriceWithoutTax($priceWithoutTax)
    {
        $this->priceWithoutTax = $priceWithoutTax;
    }

    /**
     * Get priceWithoutTax
     *
     * @return decimal 
     */
    public function getPriceWithoutTax()
    {
        return $this->priceWithoutTax;
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
     * Set quantity
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set product
     *
     * @param Shop\ProductBundle\Entity\Product $product
     */
    public function setProduct(\Shop\ProductBundle\Entity\Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get product
     *
     * @return Shop\ProductBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set purchase
     *
     * @param Shop\OrderBundle\Entity\Purchase $purchase
     */
    public function setPurchase(\Shop\OrderBundle\Entity\Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Get purchase
     *
     * @return Shop\OrderBundle\Entity\Purchase 
     */
    public function getPurchase()
    {
        return $this->purchase;
    }
}