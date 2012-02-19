<?php

namespace Shop\ProductBundle\Form\Type;

use Symfony\Component\Form\FormBuilder,
    Symfony\Component\Form\AbstractType,
    Shop\ProductBundle\Entity\Tax;

class ProductFormType extends AbstractType
{
    /**
     * @param FormBuilder $builder
     * @param array       $options 
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
            ->add('description', 'textarea')
            ->add('priceWithTax', 'money')
            ->add('tax', 'choice', array('choices' => 
                Tax::getTaxTypes()))
            ->add('brand', 'entity', array(
                'class'   => 'Shop\BrandBundle\Entity\Brand',
                'property'=> 'name'))
            ->add('category', 'entity', array(
                'class'   => 'Shop\ProductBundle\Entity\Category',
                'property'=> 'name'))
            ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shop_product_form';
    }
}
