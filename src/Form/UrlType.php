<?php

namespace App\Form;

use App\Entity\Url;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UrlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextareaType::class, [
                'label' => 'Enter your URL and submit the form for a shortened version:',
                'attr' => [
                    'col' => 10,
                    'rows' => 5,
                    'class' => "shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full border-gray-300 rounded-md text-black sm:text-3",
                    'placeholder' => 'Start typing...'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Url::class,
        ]);
    }
}
