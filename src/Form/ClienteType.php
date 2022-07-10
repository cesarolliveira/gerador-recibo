<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome', TextType::class, [
                'label' => 'Nome',
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 255,
                    'class' => 'form-control',
                ],
            ])
            ->add('documento', TextType::class, [
                'label' => 'Documento',
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 255,
                    'class' => 'form-control',
                ],
            ])
            ->add('reset', ResetType::class, [
                'label' => 'Limpar',
                'attr' => [
                    'class' => 'btn btn-danger form-control mt-3',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Salvar',
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
