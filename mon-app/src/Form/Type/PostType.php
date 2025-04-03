<?php

namespace App\Form\Type;

use App\Entity\Post;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', type: TextType::class,
                options:  [
                    'label' => 'Titre',
                    'required' => false,
                ])
            ->add('content', type: TextType::class,
                options:  [
                    'label' => 'Contenu',
                    'required' => false,
                    'constraints' => [
                        new NotBlank(),
                        new Length(max: 10),
                    ]
                ])
            ->add(
                'published',
                type: DateTimeType::class,
                options:  [
                'widget' => 'single_text',
                    'required' => false,
                    'constraints' => [
                        new NotNull(),
                        new GreaterThanOrEqual(value: new \DateTime('1 month ago')),
                    ]
                ]
            )
            ->add('author', type: TextType::class,
                options:  [
                    'label' => 'Auteur',
                    'required' => false,
                ],
            );

            if($builder->getDisabled() === false) {
                $builder->add('submit',
                    submitType::class,
                    options: [
                        'attr' => [
                            'class' => 'btn btn-primary',
                        ],
                        'label' => 'Enregistrer',
                    ],
                );
            }

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'translation_domain' => false,
        ]);
    }
}
