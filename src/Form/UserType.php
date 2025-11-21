<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use App\Entity\Role;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

class UserType extends AbstractType
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
        $mode = $options['label'];

        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email...',
                    'title' => 'Email',
                ],
            ]);

        if($mode === 'edit') {
            $codeRole = $options['translator'];
            $oRole = $this->_em->getRepository(Role::class)->findBy(['code' => $codeRole]);

            $builder->add('role',  EntityType::class, [
                'autocomplete' => true,
                'class' => Role::class,
                'label' => 'Rôle',
                'choice_value' => 'code',
                'choice_label' => 'label',
                'query_builder' => function (RoleRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->orderBy('r.label', 'ASC');
                },
                'data' => $oRole[0],
                'attr' => [
                    'class' => 'form-control',
                ],
                'mapped' => false,
            ])
            ;
        } else {
            $builder->add('role', EntityType::class, [
                'autocomplete' => true,
                'class' => Role::class,
                'label' => 'Rôle',
                'choice_value' => 'code',
                'choice_label' => 'label',
                'query_builder' => function (RoleRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->orderBy('r.label', 'ASC');
                },
                'attr' => [
                    'class' => 'form-control',
                ],
                'mapped' => false,
            ])
            ;
        }

        if($mode === 'create') {
            $builder->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs du mot de passe doivent correspondre.',
                'options' => ['attr' => ['class' => 'form-control']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
            ])
            ;
        }

        $builder->add('lastname', TextType::class, [
            'label' => 'Nom',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Nom...',
                'title' => 'Nom',
            ],
        ])
        ->add('firstname', TextType::class, [
            'label' => 'Prénom',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Prénom...',
                'title' => 'Prénom',
            ],
        ])
        ->add('position', TextType::class, [
            'label' => 'Fonction / Poste',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Fonction / Poste...',
                'title' => 'Fonction / Poste',
            ],
            'required' => false,
        ])
        ->add('photo', FileType::class, [
            'label' => 'Photo',
            'attr' => [
                'class' => 'form-control',
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
        ])
        ;

        $builder->get('photo')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
        $resolver->setRequired('label');
        $resolver->setRequired('translator');
    }
}