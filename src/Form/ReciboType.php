<?php

namespace App\Form;

use App\Entity\Cliente;
use App\Entity\Recibo;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReciboType extends AbstractType
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
            ])
            ->add('descricao', TextareaType::class, [
                'label' => 'Descrição da Cobrança',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('parcela', IntegerType::class, [
                'label' => 'Quantidade de Parcelas',
                'attr' => [
                    'minlength' => 1,
                    'maxlength' => 2,
                    'class' => 'form-control',
                ],
            ])
            ->add('dataVencimento', DateType::class, [
                'label' => 'Data de Vencimento',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'input' => 'datetime',
                ],
            ])
            ->add('valor', NumberType::class, [
                'label' => 'Valor Total (Soma de todas parcelas)',
                'attr' => [
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
            'data_class' => Recibo::class,
        ]);
    }
}
