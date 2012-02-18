<?php

namespace Shop\ProductBundle\Form\Type;

use Symfony\Component\Form\FormBuilder,
    Symfony\Component\Form\AbstractType;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
            ->add('description', 'textarea')
            ->add('priceWithTax', 'money')
            ->add('brand', 'entity', array(
                'class'   => 'Shop\BrandBundle\Entity\Brand',
                'property'=> 'name'))
            ->add('category', 'entity', array(
                'class'   => 'Shop\ProductBundle\Entity\Category',
                'property'=> 'name'))
            ;
    }

    public function getName()
    {
        return 'shop_product_form';
    }
}
