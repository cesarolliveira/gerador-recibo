<?php

namespace App\Form;

use App\Entity\Cliente;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cliente', EntityType::class, [
                'label' => 'Cliente',
                'class' => Cliente::class,
                'attr' => [
                    'class' => 'form-control',
                ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('cliente')
                        ->orderBy('cliente.id', 'DESC')
                    ;
                },
                'choice_label' => 'nome',
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Gerar Carne',
                'attr' => [
                    'class' => 'btn btn-info form-control mt-3',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}
