<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\ContactClient;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactClientType extends AbstractType
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
        $_client = $this->_em->getRepository(Client::class)->find($idClient);

        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Nom du contact...',
                    'title' => 'Nom du contact',
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom(s)',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Prénom(s) du contact...',
                    'title' => 'Prénom(s) du contact',
                ],
            ])
            ->add('position', TextType::class, [
                'label' => 'Fonction',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Fonction du contact...',
                    'title' => 'Fonction du contact',
                ],
                'required' => false,
            ])
            ->add('phone_one', TextType::class, [
                'label' => 'Téléphone 1',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Téléphone 1 du contact...',
                    'title' => 'Téléphone 1 du contact',
                ],
            ])
            ->add('phone_two', TextType::class, [
                'label' => 'Téléphone 2',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Téléphone 2 du contact...',
                    'title' => 'Téléphone 2 du contact',
                ],
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control mb-3',
                    'placeholder' => 'Email du contact...',
                    'title' => 'Email du contact',
                ],
            ])
            ->add('client_id', HiddenType::class, [
                'data' => $_client->getId(),
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => ContactClient::class,]);
        $resolver->setRequired('label');
    }
}