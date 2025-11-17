<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\RefProduct;
use App\Form\DataTransformer\FileToStringPhotoTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefProductType extends AbstractType
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
                    'placeholder' => 'Référence du produit...',
                    'title' => 'Référence du produit',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom du produit...',
                    'title' => 'Nom du produit',
                ],
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Prix du produit en F. CFA...',
                    'title' => 'Prix du produit',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description du produit...',
                    'title' => 'Description du produit',
                ],
                'required' => false,
            ])
            ->add('picture', FileType::class, [
                'label' => 'Image illustrative',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Image illustrative du produit...',
                    'title' => 'Image illustrative du produit',
                ],
                'required' => false,
            ])
        ;

        $builder->get('picture')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RefProduct::class,
        ]);
    }
}
