<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Client;
use App\Entity\RefTypeClient;
use App\Entity\StatusClient;
use App\Entity\User;
use App\Repository\RefTypeClientRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    private EntityManagerInterface $_em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $idClient = $options['label'];
        $mode = $options['translator'];

        if(!is_null($idClient)) {
            $client = $this->_em->getRepository(Client::class)->find($idClient);
        }

        $builder
            ->add('sreason', TextType::class, [
                'label' => 'Raison sociale / nom du client',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Raison sociale ou Nom du client...',
                    'title' => 'Raison sociale ou Nom du client',
                ],
            ])
            ->add('type_client',  EntityType::class, [
                'class' => RefTypeClient::class,
                'label' => 'Type client',
                'placeholder' => 'Sélectionnez',
                'choice_value' => 'id',
                'choice_label'  => 'label',
                'attr' => ['class' => 'form-control',],
                'query_builder' => function (RefTypeClientRepository $er) {
                    return $er->createQueryBuilder('r')
                        ->orderBy('r.label', 'ASC');
                },
            ])
            ->add('num_account', TextType::class, [
                'label' => 'Numéro de compte',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Numéro de compte...',
                    'title' => 'Numéro de compte',
                ],
            ])
            ->add('num_command', TextType::class, [
                'label' => 'N° bon de commande',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Numéro du bon de commande...',
                    'title' => 'Numéro de bon de commande',
                ],
                'required' => false,
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse du client...',
                    'title' => 'Client du client',
                ],
            ])
            ->add('address_cpt', TextType::class, [
                'label' => 'Adresse complémentaire',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse complémentaire du client...',
                    'title' => 'Adresse complémentaire du client',
                ],
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ville du client...',
                    'title' => 'Ville du client',
                ],
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pays du client...',
                    'title' => 'Pays du client',
                ],
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Téléphone (fixe) du client...',
                    'title' => 'Téléphone (fixe) du client',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email du client...',
                    'title' => 'Email du client',
                ],
                'required' => false,
            ])
            ->add('nif', TextType::class, [
                'label' => 'NIF',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Numéro NIF du client...',
                    'title' => 'NIF',
                ],
                'required' => false,
            ])
        ;

        if('edit' === $mode) {
            $builder
                ->add('status_client',  EntityType::class, [
                    'class' => StatusClient::class,
                    'label' => 'Statut client',
                    'placeholder' => 'Sélectionnez',
                    'choice_value' => 'id',
                    'choice_label'  => 'label',
                    'attr' => ['class' => 'form-control',],
                ])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Client::class,]);
        $resolver->setRequired('label');
        $resolver->setRequired('translator');
    }
}