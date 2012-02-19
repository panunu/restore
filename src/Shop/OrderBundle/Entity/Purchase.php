<?php

namespace Shop\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection,
    \DateTime;

/**
 * @ORM\Table(name="Purchase")
 * @ORM\Entity
 */
class Purchase
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
    
    /**
     * @param DateTime $datetime 
     */
    public function __construct(DateTime $datetime)
    {
        $this->date  = $datetime;
        $this->items = new ArrayCollection();
    }
    
    /**
     * @return array 
     */
    public function getProducts()
    {
        if(!$this->getItems()) {
            return null;
        }
        
        return array_values(array_map(
            function($item) { return $item->getProduct(); },
            $this->items->toArray()
        ));
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
     * Set totalTax
     *
     * @param decimal $totalTax
     */
    public function setTotalTax($totalTax)
    {
        $this->totalTax = $totalTax;
    }

    /**
     * Get totalTax
     *
     * @return decimal 
     */
    public function getTotalTax()
    {
        return $this->totalTax;
    }

    /**
     * Set totalWithoutTax
     *
     * @param decimal $totalWithoutTax
     */
    public function setTotalWithoutTax($totalWithoutTax)
    {
        $this->totalWithoutTax = $totalWithoutTax;
    }

    /**
     * Get totalWithoutTax
     *
     * @return decimal 
     */
    public function getTotalWithoutTax()
    {
        return $this->totalWithoutTax;
    }

    /**
     * Set totalWithTax
     *
     * @param decimal $totalWithTax
     */
    public function setTotalWithTax($totalWithTax)
    {
        $this->totalWithTax = $totalWithTax;
    }

    /**
     * Get totalWithTax
     *
     * @return decimal 
     */
    public function getTotalWithTax()
    {
        return $this->totalWithTax;
    }

    /**
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add items
     *
     * @param Shop\OrderBundle\Entity\PurchaseItem $items
     */
    public function addPurchaseItem(\Shop\OrderBundle\Entity\PurchaseItem $items)
    {
        $this->items[] = $items;
    }

    /**
     * Get items
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}