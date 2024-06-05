<?php

namespace App\Form;

use App\Entity\Assertion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssertionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isTcf', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'label' => 'Avez-vous le TCF (test de connaissance du Français) ?',
                'data' => null
            ])
            ->add('tcfScore', null, [
                'label' => 'Quel est votre score ? ',
                'required' => false,
            ])
            ->add('studyField', null, [
                'label' => 'Quel est votre domaine d’étude ?',
                'required' => true,
            ])
            ->add('studyLevel', ChoiceType::class, [
                'choices' => [
                    'Bac-1' => Assertion::STUDY_LEVEL_BAC_MINUS_1,
                    'Bac+0' => Assertion::STUDY_LEVEL_BAC_PLUS_0,
                    'Bac+1' => Assertion::STUDY_LEVEL_BAC_PLUS_1,
                    'Bac+2' => Assertion::STUDY_LEVEL_BAC_PLUS_2,
                    'Bac+3' => Assertion::STUDY_LEVEL_BAC_PLUS_3,
                    'Bac+4' => Assertion::STUDY_LEVEL_BAC_PLUS_4,
                    'Bac+5' => Assertion::STUDY_LEVEL_BAC_PLUS_5,
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'Quel est votre niveau d’étude ?',
                'placeholder' => 'Sélectionnez une réponse'
            ])
            ->add('whereToStudy', ChoiceType::class, [
                'choices' => [
                    'Paris' => Assertion::STUDY_IN_PARIS,
                    'Hors Paris' => Assertion::STUDY_OUT_PARIS,
                ],
                'expanded' => true,
                'label' => 'Où préférez-vous étudier ?',
            ])
            ->add('otherWhereToStudy', null, [
                'label' => 'Dites-nous dans quelle ville voulez-vous continuer vos études ?',
                'required' => false,
            ])
            ->add('isReorientation', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'label' => 'Acceptez-vous une réorientation dans un domaine proche du votre s’il n’y a pas d’écoles qui proposent votre formation ?',
            ])
            ->add('reorientationDetail', ChoiceType::class, [
                'choices' => [
                    'Informatique' => 'Informatique',
                    'Marketing' => 'Marketing',
                    'Commerce' => 'Commerce',
                    'Gestion management' => 'Gestion management',
                    'Design' => 'Design',
                    'Autre' => 'Autre',
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'Lequel ?',
                'placeholder' => 'Sélectionnez une réponse'

            ])
            ->add('reorientationDetailExtended', null, [
                'label' => 'Précisez lequel ?',
                'required' => false,
            ])
            ->add('isPaidInAdvance', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'label' => 'Pourriez-vous vous inscrire dans une école qui demande le règlement d’une partie des frais de scolarité en avance ?',
            ])
            ->add('isAssertToOtherSchool', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'data' => null,
                'label' => 'Avez-vous postulé pour d’autres écoles ?',
            ])
            ->add('assertToOtherSchoolName', TextareaType::class, [
                'label' => 'Précisez laquelle ou lesquelles ?',
                'required' => false,
                'attr' => [
                    'placeholder' => '',
                ],
            ])
            ->add('assertToOtherSchoolNoWhy', ChoiceType::class, [
                'choices' => [
                    'Je n’ai pas le temps' => 'Je n’ai pas le temps',
                    'Je n’ai pas trouvé d’école qui convient à mon budget' => 'Je n’ai pas trouvé d’école qui convient à mon budget',
                    'Commerce' => 'Commerce',
                    'Je n’ai pas trouvé de formation qui convient à mon projet' => 'Je n’ai pas trouvé de formation qui convient à mon projet',
                    'Autre' => 'Autre',
                ],
                'expanded' => false,
                'multiple' => false,
                'required' => false,
                'label' => 'Pourquoi',
                'placeholder' => 'Sélectionnez une réponse'
            ])
            ->add('assertToOtherSchoolNoWhyOther', TextareaType::class, [
                'label' => 'Précisez pourquoi ?',
                'required' => false,
            ])
            ->add('firstName', null, [
                'label' => 'Prénom',
                'required' => true,
            ])
            ->add('familyName', null, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('email', null, [
                'label' => 'Adresse e-mail',
                'required' => true,
            ])
            ->add('nationality', null, [
                'label' => 'Nationalité',
                'required' => true,
            ])
            ->add('city', null, [
                'label' => 'Ville',
                'required' => true,
            ])
            ->add('phoneNumber', null, [
                'label' => 'Numéro de téléphone',
                'required' => true,
            ])
            ->add('position', ChoiceType::class, [
                'choices' => [
                    'Etudiant' => 'Etudiant',
                    'Salarié' => 'Salarié',
                    'Entrepreneur' => 'Entrepreneur',
                    'Fonctionnaire' => 'Fonctionnaire',
                    'En recherche d’emploi' => 'En recherche d’emploi',
                    'Autre' => 'Autre',
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'Statut',
                'placeholder' => 'Sélectionnez une réponse'
            ])
            ->add('positionOther', null, [
                'label' => 'Précisez lequel',
                'required' => false,
            ])
            ->add('howDidYouKnowOurAgency', ChoiceType::class, [
                'choices' => [
                    'Internet' => Assertion::KNOW_AGENCY_INTERNET,
                    'Foire' => Assertion::KNOW_AGENCY_FOIRE,
                    'Bouche à oreil' => Assertion::KNOW_AGENCY_MOUTH,
                    'Autre' => Assertion::KNOW_AGENCY_OTHER,
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'Comment avez-vous connu notre agence ?',
                'placeholder' => 'Sélectionnez une réponse'

            ])
            ->add('howDidYouKnowOurAgencyOther', null, [
                'label' => 'Précisez comment?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Assertion::class,
        ]);
    }
}
