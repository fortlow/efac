<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\RefService;
use App\Form\DataTransformer\FileToStringPhotoTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefServiceType extends AbstractType
{
    private FileToStringPhotoTransformer $transformer;

    public function __construct(FileToStringPhotoTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, [
                'label' => 'Référence',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Référence...',
                    'title' => 'Référence du service',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom du service...',
                    'title' => 'Nom du service',
                ],
            ])
            ->add('price_per_day', NumberType::class, [
                'label' => 'Prix en hj (XAF)',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Prix en homme jour...',
                    'title' => 'Prix du service',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description du service...',
                    'title' => 'Description du service',
                ],
                'required' => false,
            ])
            ->add('picture', FileType::class, [
                'label' => 'Image illustrative',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Image illustrative...',
                    'title' => 'Image illustrative du service',
                ],
                'required' => false,
            ])
        ;

        $builder->get('picture')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RefService::class,
        ]);
    }
}
