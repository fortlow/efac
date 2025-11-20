<?php

namespace App\Form;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;

#[AsEntityAutocompleteField]
class ClientAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Client::class,
            'placeholder' => 'Veuillez choisir un client',
            'label' => 'Client',
            'choice_value' => 'id',
            'choice_label' => 'sreason',
            'query_builder' => function (ClientRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.sreason', 'ASC');
            },
            'attr' => ['class' => 'form-control',],
            // 'choice_label' => 'name',

            // choose which fields to use in the search
            // if not passed, *all* fields are used
            'searchable_fields' => ['sreason'],

            'security' => 'ROLE_USER',
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
