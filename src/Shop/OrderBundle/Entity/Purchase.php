<?php

namespace Shop\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Shop\FrameworkBundle\Entity\AbstractEntity as Entity,
    Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\OneToMany(targetEntity="PurchaseItem", mappedBy="purchase")
     */
    protected $items;
    
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
    
    public function getProducts()
    {
        if(!$this->getItems()) {
            return null;
        }
        
        return array_map(
            function($item) { return $item->getProduct(); },
            $this->items->toArray()
        );
    }    
    
    /**
     * @param  PurchaseItem $item
     * @return Purchase
     */
    public function addItem(PurchaseItem $item)
    {
        if(!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setPurchase($this);
        }
        
        return $this;
    }
}