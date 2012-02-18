<?php

namespace Shop\ProductBundle\Form\Type;

use Symfony\Component\Form\FormBuilder,
    Symfony\Component\Form\AbstractType;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
            ->add('description')
            ->add('priceWithTax')
            ->add('brand')
            ->add('category');
    }

    public function getName()
    {
        return 'shop_product';
    }
}
