<?php
declare(strict_types=1);

namespace App\Form;

use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormSendMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $toEmail = $options['label'];
        $fromEmail = $options['translator'];

        if(strlen($fromEmail) > 2) {
            $builder
                ->add('from', EmailType::class, [
                    'label' => 'De (expéditeur)',
                    'data' => $fromEmail,
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'Email expéditeur...',
                        'title' => 'Email expéditeur',
                        'readonly' => true,
                    ],
                ])
            ;
        }

        $builder
            ->add('to', EmailType::class, [
                'label' => 'A (destinataire)',
                'data' => $toEmail,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Email destinataire...',
                    'title' => 'Email destinataire',
                    'readonly' => true,
                ],
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Sujet du mail...',
                    'title' => 'Sujet du mail',
                ],
            ])
            //->add('message', TinymceType::class, [
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                /*'attr' => [
                    'plugins' => 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
                    'toolbar' => 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                ],*/
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
        $resolver->setRequired('label');
        $resolver->setRequired('translator');
    }
}
