<?php

namespace App\Form;

use App\Entity\Assertion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
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
                'required' => false,
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
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'required' => true,
            ])
            ->add('confirm_email', EmailType::class, [
                'mapped' => false,
                'label' => 'Confirmez votre adresse e-mail',
            ])
            ->add('nationality', null, [
                'label' => 'Nationalité',
                'required' => true,
            ])
            ->add('city', null, [
                'label' => 'Ville',
                'required' => true,
            ])
            ->add('countryPhoneCode', ChoiceType::class, [
                'choices' => $this->getCountryCodes(),
                'mapped' => false,
                'required' => true,
                'label' => false,
                'data' => '+213',
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => false,
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

    private function getCountryCodes()
    {
        // Comprehensive list of country codes with French names
        return [
            '+1 (États-Unis)' => '+1',
            '+44 (Royaume-Uni)' => '+44',
            '+213 (Algérie)' => '+213',
            '+93 (Afghanistan)' => '+93',
            '+355 (Albanie)' => '+355',
            '+376 (Andorre)' => '+376',
            '+244 (Angola)' => '+244',
            '+54 (Argentine)' => '+54',
            '+374 (Arménie)' => '+374',
            '+61 (Australie)' => '+61',
            '+43 (Autriche)' => '+43',
            '+994 (Azerbaïdjan)' => '+994',
            '+973 (Bahreïn)' => '+973',
            '+880 (Bangladesh)' => '+880',
            '+375 (Biélorussie)' => '+375',
            '+32 (Belgique)' => '+32',
            '+501 (Belize)' => '+501',
            '+229 (Bénin)' => '+229',
            '+975 (Bhoutan)' => '+975',
            '+591 (Bolivie)' => '+591',
            '+387 (Bosnie-Herzégovine)' => '+387',
            '+267 (Botswana)' => '+267',
            '+55 (Brésil)' => '+55',
            '+673 (Brunei)' => '+673',
            '+359 (Bulgarie)' => '+359',
            '+226 (Burkina Faso)' => '+226',
            '+257 (Burundi)' => '+257',
            '+855 (Cambodge)' => '+855',
            '+237 (Cameroun)' => '+237',
            '+238 (Cap-Vert)' => '+238',
            '+236 (République centrafricaine)' => '+236',
            '+235 (Tchad)' => '+235',
            '+56 (Chili)' => '+56',
            '+86 (Chine)' => '+86',
            '+57 (Colombie)' => '+57',
            '+269 (Comores)' => '+269',
            '+242 (Congo-Brazzaville)' => '+242',
            '+243 (Congo-Kinshasa)' => '+243',
            '+506 (Costa Rica)' => '+506',
            '+225 (Côte d\'Ivoire)' => '+225',
            '+385 (Croatie)' => '+385',
            '+53 (Cuba)' => '+53',
            '+357 (Chypre)' => '+357',
            '+420 (République tchèque)' => '+420',
            '+45 (Danemark)' => '+45',
            '+253 (Djibouti)' => '+253',
            '+593 (Équateur)' => '+593',
            '+20 (Égypte)' => '+20',
            '+503 (El Salvador)' => '+503',
            '+240 (Guinée équatoriale)' => '+240',
            '+291 (Érythrée)' => '+291',
            '+372 (Estonie)' => '+372',
            '+268 (Eswatini)' => '+268',
            '+251 (Éthiopie)' => '+251',
            '+679 (Fidji)' => '+679',
            '+358 (Finlande)' => '+358',
            '+33 (France)' => '+33',
            '+241 (Gabon)' => '+241',
            '+220 (Gambie)' => '+220',
            '+995 (Géorgie)' => '+995',
            '+49 (Allemagne)' => '+49',
            '+233 (Ghana)' => '+233',
            '+30 (Grèce)' => '+30',
            '+299 (Groenland)' => '+299',
            '+502 (Guatemala)' => '+502',
            '+224 (Guinée)' => '+224',
            '+245 (Guinée-Bissau)' => '+245',
            '+592 (Guyana)' => '+592',
            '+509 (Haïti)' => '+509',
            '+504 (Honduras)' => '+504',
            '+36 (Hongrie)' => '+36',
            '+354 (Islande)' => '+354',
            '+91 (Inde)' => '+91',
            '+62 (Indonésie)' => '+62',
            '+98 (Iran)' => '+98',
            '+964 (Irak)' => '+964',
            '+353 (Irlande)' => '+353',
            '+972 (Israël)' => '+972',
            '+39 (Italie)' => '+39',
            '+81 (Japon)' => '+81',
            '+962 (Jordanie)' => '+962',
            '+7 (Kazakhstan)' => '+7',
            '+254 (Kenya)' => '+254',
            '+686 (Kiribati)' => '+686',
            '+965 (Koweït)' => '+965',
            '+996 (Kirghizistan)' => '+996',
            '+856 (Laos)' => '+856',
            '+371 (Lettonie)' => '+371',
            '+961 (Liban)' => '+961',
            '+266 (Lesotho)' => '+266',
            '+231 (Liberia)' => '+231',
            '+218 (Libye)' => '+218',
            '+423 (Liechtenstein)' => '+423',
            '+370 (Lituanie)' => '+370',
            '+352 (Luxembourg)' => '+352',
            '+261 (Madagascar)' => '+261',
            '+265 (Malawi)' => '+265',
            '+60 (Malaisie)' => '+60',
            '+960 (Maldives)' => '+960',
            '+223 (Mali)' => '+223',
            '+356 (Malte)' => '+356',
            '+692 (Îles Marshall)' => '+692',
            '+222 (Mauritanie)' => '+222',
            '+230 (Maurice)' => '+230',
            '+52 (Mexique)' => '+52',
            '+691 (Micronésie)' => '+691',
            '+373 (Moldavie)' => '+373',
            '+377 (Monaco)' => '+377',
            '+976 (Mongolie)' => '+976',
            '+382 (Monténégro)' => '+382',
            '+212 (Maroc)' => '+212',
            '+258 (Mozambique)' => '+258',
            '+95 (Myanmar)' => '+95',
            '+264 (Namibie)' => '+264',
            '+674 (Nauru)' => '+674',
            '+977 (Népal)' => '+977',
            '+31 (Pays-Bas)' => '+31',
            '+64 (Nouvelle-Zélande)' => '+64',
            '+505 (Nicaragua)' => '+505',
            '+227 (Niger)' => '+227',
            '+234 (Nigeria)' => '+234',
            '+47 (Norvège)' => '+47',
            '+968 (Oman)' => '+968',
            '+92 (Pakistan)' => '+92',
            '+680 (Palaos)' => '+680',
            '+970 (Palestine)' => '+970',
            '+507 (Panama)' => '+507',
            '+675 (Papouasie-Nouvelle-Guinée)' => '+675',
            '+595 (Paraguay)' => '+595',
            '+51 (Pérou)' => '+51',
            '+63 (Philippines)' => '+63',
            '+48 (Pologne)' => '+48',
            '+351 (Portugal)' => '+351',
            '+974 (Qatar)' => '+974',
            '+40 (Roumanie)' => '+40',
            '+7 (Russie)' => '+7',
            '+250 (Rwanda)' => '+250',
            '+685 (Samoa)' => '+685',
            '+378 (Saint-Marin)' => '+378',
            '+239 (Sao Tomé-et-Principe)' => '+239',
            '+966 (Arabie saoudite)' => '+966',
            '+221 (Sénégal)' => '+221',
            '+381 (Serbie)' => '+381',
            '+248 (Seychelles)' => '+248',
            '+232 (Sierra Leone)' => '+232',
            '+65 (Singapour)' => '+65',
            '+421 (Slovaquie)' => '+421',
            '+386 (Slovénie)' => '+386',
            '+677 (Îles Salomon)' => '+677',
            '+252 (Somalie)' => '+252',
            '+27 (Afrique du Sud)' => '+27',
            '+82 (Corée du Sud)' => '+82',
            '+211 (Soudan du Sud)' => '+211',
            '+34 (Espagne)' => '+34',
            '+94 (Sri Lanka)' => '+94',
            '+249 (Soudan)' => '+249',
            '+597 (Suriname)' => '+597',
            '+46 (Suède)' => '+46',
            '+41 (Suisse)' => '+41',
            '+963 (Syrie)' => '+963',
            '+886 (Taïwan)' => '+886',
            '+992 (Tadjikistan)' => '+992',
            '+255 (Tanzanie)' => '+255',
            '+66 (Thaïlande)' => '+66',
            '+228 (Togo)' => '+228',
            '+676 (Tonga)' => '+676',
            '+216 (Tunisie)' => '+216',
            '+90 (Turquie)' => '+90',
            '+993 (Turkménistan)' => '+993',
            '+688 (Tuvalu)' => '+688',
            '+256 (Ouganda)' => '+256',
            '+380 (Ukraine)' => '+380',
            '+971 (Émirats arabes unis)' => '+971',
            '+598 (Uruguay)' => '+598',
            '+998 (Ouzbékistan)' => '+998',
            '+678 (Vanuatu)' => '+678',
            '+58 (Venezuela)' => '+58',
            '+84 (Viêt Nam)' => '+84',
            '+967 (Yémen)' => '+967',
            '+260 (Zambie)' => '+260',
            '+263 (Zimbabwe)' => '+263',
        ];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Assertion::class,
        ]);
    }
}
