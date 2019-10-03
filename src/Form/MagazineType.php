<?php

namespace App\Form;

use App\Entity\Magazines;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MagazineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label'=>'Titre'])
            ->add('description', null, ['label'=>'Description'])
            ->add('price', null, ['label'=>'Prix'])
            ->add('seller', null, ['label'=>'Vendeur'])
            ->add('category', null, ['label'=>'Catégorie'])
            ->add('imageFile', FileType::class, [
                'required'=> false,
                'label'=>'Ajouter une image'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Magazines::class,
        ]);
    }
}
