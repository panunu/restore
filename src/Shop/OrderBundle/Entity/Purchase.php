<?php

namespace Shop\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Shop\FrameworkBundle\Entity\AbstractEntity as Entity;

/**
 * @ORM\Table(name="Purchase")
 * @ORM\Entity
 */
class Purchase extends Entity
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
     * @ORM\Column(name="totalTax", type="decimal", length="8", scale="2", nullable=false)
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
     * @var DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    protected $date;
    
    /**
     * @var array
     * 
     * @ORM\ManyToMany(targetEntity="Shop\ProductBundle\Entity\Product")
     * @ORM\JoinTable(name="ProductPurchase",
     *  joinColumns={@ORM\JoinColumn(name="Purchase", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="Product", referencedColumnName="id")}
     * )
     */
    protected $products;
    
    /**
     * @param  array    $products
     * @return Purchase 
     */
    public function setProducts(array $products)
    {
        $this->products = $products;
        
        return $this;
    }
}