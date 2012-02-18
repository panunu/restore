<?php

namespace Shop\BrandBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    \Gedmo\Mapping\Annotation as Gedmo,
    Shop\FrameworkBundle\Entity\AbstractEntity as Entity;

/**
 * @ORM\Table(name="Brand")
 * @ORM\Entity
 */
class Brand extends Entity
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
     * @var string
     * 
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     */
    protected $slug;
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}