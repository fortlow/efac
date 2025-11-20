<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\Proforma;
use App\Entity\Client;
use App\Entity\RefStatusProforma;
use App\Repository\ClientRepository;
use App\Form\DataTransformer\StringToDateTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProformaType extends AbstractType
{
    private StringToDateTransformer $transformer;

    public function __construct(StringToDateTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $numeroProforma = $options['label'];
        $mode = $options['translator'];
        $targetPro = $options['translation_domain'];

        $builder
            /*->add('client', ClientAutocompleteField::class)*/
            ->add('client', EntityType::class, [
                'autocomplete' => true,
                'class' => Client::class,
                'label' => 'Client',
                'placeholder' => 'Sélectionnez',
                'choice_value' => 'id',
                'choice_label' => 'sreason',
                'query_builder' => function (ClientRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.sreason', 'ASC');
                },
                'attr' => ['class' => 'form-control',],
            ])
            ->add('is_with_tps', ChoiceType::class, [
                'label' => 'Proforma avec la TPS ?',
                'choices' => [
                    'Non' => false,
                    'Oui' => true,
                ],
                'attr' => [ 'class' => 'form-control',],
            ])
            ->add('is_without_tva', ChoiceType::class, [
                'label' => 'Proforma sans TVA ?',
                'choices' => [
                    'Non' => false,
                    'Oui' => true,
                ],
                'attr' => [ 'class' => 'form-control',],
            ])
            ->add('banque', ChoiceType::class, [
                'label' => 'Banque de paiement',
                'placeholder' => 'Sélectionnez...',
                'choices' => [
                    'Orabank' => 1,
                    'UBA' => 2,
                ],
                'attr' => [ 'class' => 'form-control', ],
            ])
        ;
        if ('create' === $mode) {
            $builder
                ->add('numero', TextType::class, [
                    'label' => 'Numéro de la proforma',
                    'data' => $numeroProforma,
                    'attr' => [
                        'class' => 'form-control',
                        'readonly' => 'readonly',
                        'placeholder' => 'Numéro de la proforma...',
                        'title' => 'Numéro de la proforma',
                    ],
                ])
                ->add('targetpro', ChoiceType::class, [
                    'label' => 'Proforma basée sur ',
                    'choices' => [
                        'Les produits & services' => 3,
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'multiple' => false,
                    'mapped' => false,
                ])
            ;
        } else {
            $builder
                ->add('numero', TextType::class, [
                    'label' => 'Numéro de la proforma',
                    'attr' => [
                        'class' => 'form-control',
                        'readonly' => 'readonly',
                        'placeholder' => 'Numéro de la proforma...',
                        'title' => 'Numéro de la proforma',
                    ],
                ])
                ->add('targetpro', ChoiceType::class, [
                    'label' => 'Proforma basée sur ',
                    'choices' => [
                        'Les produits' => 1,
                        'Les services' => 2,
                        'Les produits & services' => 3,
                    ],
                    'data' => $targetPro,
                    'attr' => [
                        'class' => 'form-control',
                        'readonly' => 'readonly',
                    ],
                    'multiple' => false,
                    'mapped' => false,
                ])
                ->add('status', EntityType::class, [
                    'autocomplete' => true,
                    'class' => RefStatusProforma::class,
                    'label' => 'Statut',
                    'placeholder' => 'Sélectionnez',
                    'choice_value' => 'id',
                    'choice_label' => 'label',
                    'attr' => ['class' => 'form-control',],
                    'required' => false,
                ])
            ;
        }
        $builder
            ->add('subject', TextType::class, [
                'label' => 'Objet de la proforma',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Objet de la proforma...',
                    'title' => 'Numéro du devis',
                    'maxlength' => 255,
                ],
            ])
            ->add('wf_amount', NumberType::class, [
                'label' => "Montant de la main d'oeuvre",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Montant de la main d'oeuvre...",
                    'title' => "Montant de la main d'oeuvre",
                ],
                'required' => false,
            ])
            ->add('due_date', DateType::class, [
                'label' => "Date d'échéance en cas de facture",
                'attr'  => [
                    'placeholder' => 'Date échéance de la facture...',
                ],
                'widget'    => 'single_text',
                'required' => false,
            ])
            ->add('prct_discount', NumberType::class, [
                'label' => 'Réduction en pourcentage',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Réduction en pourcentage...',
                    'title' => 'Réduction en pourcentage',
                ],
                'required' => false,
            ])
            ->add('detailMainOeuvre', TextareaType::class, [
                'label' => "Détail Main d'Oeuvre",
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Détail Main d'Oeuvre...",
                    'title' => "Détail Main d'Oeuvre",
                ],
                'required' => false,
            ])
            ->add('cond_reglt', TextareaType::class, [
                'label' => 'Conditions de règlement',
                'attr' => [
                    'rows' => 4,
                    'plugins' => 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
                    'toolbar' => 'undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl',
                    'images_upload_url' => '/back/blog/post/upload/image',
                ],
                'required' => false,
            ])
        ;

        $builder->get('due_date')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Proforma::class,]);
        $resolver->setRequired('label');
        $resolver->setRequired('translator');
        $resolver->setRequired('translation_domain');
    }
}
