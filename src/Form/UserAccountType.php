<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\FileToStringPhotoTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserAccountType extends AbstractType
{
    private EntityManagerInterface $_em;
    private FileToStringPhotoTransformer $transformer;

    /**
     * @param EntityManagerInterface $em
     * @param FileToStringPhotoTransformer $tfr
     */
    public function __construct(EntityManagerInterface $em, FileToStringPhotoTransformer $tfr)
    {
        $this->_em = $em;
        $this->transformer = $tfr;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Email...',
                    'title' => 'Email',
                ],
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs du mot de passe doivent correspondre.',
                'options' => ['attr' => ['class' => 'form-control mb-3']],
                'first_options' => ['label' => 'Modifier le mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe modifié'],
                'required' => false,
                'mapped' => false,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Nom...',
                    'title' => 'Nom',
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Prénom...',
                    'title' => 'Prénom',
                ],
            ])
            ->add('position', TextType::class, [
                'label' => 'Fonction',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Votre fonction ou poste actuel...',
                    'title' => 'Fonction',
                ],
                'required' => false,
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Photo...',
                    'title' => 'Photo',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
                        'maxSizeMessage' => 'Votre photo est trop volumineuse, sa taille ne doit pas dépasser 10Mb',
                        'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],
                        'mimeTypesMessage' => 'Votre photo doit être au format jpeg, jpg ou png',
                    ])
                ],
                'required' => false,
                'mapped' => false,
            ]);

        $builder->get('photo')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => User::class,]);
    }
}
