<?php

namespace App\Entity;

use App\Repository\AssertionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssertionRepository::class)]
class Assertion
{
    public const STUDY_LEVEL_BAC_MINUS_1 = 1;
    public const STUDY_LEVEL_BAC_PLUS_0 = 2;
    public const STUDY_LEVEL_BAC_PLUS_1 = 3;
    public const STUDY_LEVEL_BAC_PLUS_2 = 4;
    public const STUDY_LEVEL_BAC_PLUS_3 = 5;
    public const STUDY_LEVEL_BAC_PLUS_4 = 6;
    public const STUDY_LEVEL_BAC_PLUS_5 = 7;

    public const STUDY_LEVEL = [
        self::STUDY_LEVEL_BAC_MINUS_1 => 'Bac -1',
        self::STUDY_LEVEL_BAC_PLUS_0 => 'Bac',
        self::STUDY_LEVEL_BAC_PLUS_1 => 'Bac +1',
        self::STUDY_LEVEL_BAC_PLUS_2 => 'Bac +2',
        self::STUDY_LEVEL_BAC_PLUS_3 => 'Bac +3',
        self::STUDY_LEVEL_BAC_PLUS_4 => 'Bac +4',
        self::STUDY_LEVEL_BAC_PLUS_5 => 'Bac +5'
    ];

    public const STUDY_IN_PARIS = 1;
    public const STUDY_OUT_PARIS = 2;

    public const KNOW_AGENCY_INTERNET = 1;
    public const KNOW_AGENCY_FOIRE = 2;
    public const KNOW_AGENCY_MOUTH = 3;
    public const KNOW_AGENCY_OTHER = 4;

    public const KNOW_AGENCY = [
        self::KNOW_AGENCY_INTERNET => 'Internet',
        self::KNOW_AGENCY_FOIRE => 'Foire',
        self::KNOW_AGENCY_MOUTH => 'Bouche à oreille',
        self::KNOW_AGENCY_OTHER => 'Autre'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private bool $isTcf = true;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tcfScore = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $studyField = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $studyLevel;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $whereToStudy;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $otherWhereToStudy = null;

    #[ORM\Column]
    private bool $isReorientation;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reorientationDetail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reorientationDetailExtended = null;

    #[ORM\Column]
    private bool $isPaidInAdvance;

    #[ORM\Column]
    private bool $isAssertToOtherSchool;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $assertToOtherSchoolName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $assertToOtherSchoolNoWhy = null;

    #[ORM\Column(length: 255)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    private string $familyName;

    #[ORM\Column(length: 255, nullable: true)]
    private string $email;

    #[ORM\Column(length: 255)]
    private string $nationality;

    #[ORM\Column(length: 255)]
    private string $city;

    #[ORM\Column(length: 255)]
    private string $phoneNumber;

    #[ORM\Column(length: 255)]
    private string $position;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $positionOther = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $howDidYouKnowOurAgency;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $howDidYouKnowOurAgencyOther = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $assertToOtherSchoolNoWhyOther = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getIsTcf(): ?bool
    {
        return $this->isTcf;
    }

    public function isTcf(bool $isTcf): static
    {
        $this->isTcf = $isTcf;

        return $this;
    }

    public function getTcfScore(): ?string
    {
        return $this->tcfScore;
    }

    public function setTcfScore(?string $tcfScore): static
    {
        $this->tcfScore = $tcfScore;

        return $this;
    }

    public function getStudyField(): ?string
    {
        return $this->studyField;
    }

    public function setStudyField(?string $studyField): static
    {
        $this->studyField = $studyField;

        return $this;
    }

    public function getStudyLevelString(): ?string
    {
        return self::STUDY_LEVEL[$this->studyLevel] ?? null;
    }

    public function getStudyLevel(): int
    {
        return $this->studyLevel;
    }

    public function setStudyLevel(int $studyLevel): static
    {
        $this->studyLevel = $studyLevel;

        return $this;
    }

    public function getWhereToStudy(): ?int
    {
        return $this->whereToStudy;
    }

    public function getWhereToStudyString(): ?string
    {
        return $this->whereToStudy == self::STUDY_IN_PARIS ? 'Paris' : 'Hors Paris';
    }

    public function setWhereToStudy(int $whereToStudy): static
    {
        $this->whereToStudy = $whereToStudy;

        return $this;
    }

    public function getOtherWhereToStudy(): ?string
    {
        return $this->otherWhereToStudy;
    }

    public function setOtherWhereToStudy(?string $otherWhereToStudy): static
    {
        $this->otherWhereToStudy = $otherWhereToStudy;

        return $this;
    }

    public function getIsReorientation(): bool
    {
        return $this->isReorientation;
    }

    public function isReorientation(bool $isReorientation): static
    {
        $this->isReorientation = $isReorientation;

        return $this;
    }

    public function getReorientationDetail(): ?string
    {
        return $this->reorientationDetail;
    }

    public function setReorientationDetail(?string $reorientationDetail): static
    {
        $this->reorientationDetail = $reorientationDetail;

        return $this;
    }

    public function getReorientationDetailExtended(): ?string
    {
        return $this->reorientationDetailExtended;
    }

    public function setReorientationDetailExtended(?string $reorientationDetailExtended): static
    {
        $this->reorientationDetailExtended = $reorientationDetailExtended;

        return $this;
    }

    public function getIsPaidInAdvance(): ?bool
    {
        return $this->isPaidInAdvance;
    }

    public function isPaidInAdvance(bool $isPaidInAdvance): static
    {
        $this->isPaidInAdvance = $isPaidInAdvance;

        return $this;
    }

    public function getIsAssertToOtherSchool(): ?bool
    {
        return $this->isAssertToOtherSchool;
    }

    public function isAssertToOtherSchool(bool $isAssertToOtherSchool): static
    {
        $this->isAssertToOtherSchool = $isAssertToOtherSchool;

        return $this;
    }

    public function getAssertToOtherSchoolName(): ?string
    {
        return $this->assertToOtherSchoolName;
    }

    public function setAssertToOtherSchoolName(?string $assertToOtherSchoolName): static
    {
        $this->assertToOtherSchoolName = $assertToOtherSchoolName;

        return $this;
    }

    public function getAssertToOtherSchoolNoWhy(): ?string
    {
        return $this->assertToOtherSchoolNoWhy;
    }

    public function setAssertToOtherSchoolNoWhy(?string $assertToOtherSchoolNoWhy): static
    {
        $this->assertToOtherSchoolNoWhy = $assertToOtherSchoolNoWhy;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): static
    {
        $this->familyName = $familyName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): static
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getPositionOther(): ?string
    {
        return $this->positionOther;
    }

    public function setPositionOther(?string $positionOther): static
    {
        $this->positionOther = $positionOther;

        return $this;
    }

    public function getHowDidYouKnowOurAgency(): ?int
    {
        return $this->howDidYouKnowOurAgency;
    }

    public function getHowDidYouKnowOurAgencyString(): ?string
    {
        return self::KNOW_AGENCY[$this->howDidYouKnowOurAgency] ?? null;

    }

    public function setHowDidYouKnowOurAgency(int $howDidYouKnowOurAgency): static
    {
        $this->howDidYouKnowOurAgency = $howDidYouKnowOurAgency;

        return $this;
    }

    public function getHowDidYouKnowOurAgencyOther(): ?string
    {
        return $this->howDidYouKnowOurAgencyOther;
    }

    public function setHowDidYouKnowOurAgencyOther(?string $howDidYouKnowOurAgencyOther): static
    {
        $this->howDidYouKnowOurAgencyOther = $howDidYouKnowOurAgencyOther;

        return $this;
    }

    public function getAssertToOtherSchoolNoWhyOther(): ?string
    {
        return $this->assertToOtherSchoolNoWhyOther;
    }

    public function setAssertToOtherSchoolNoWhyOther(?string $assertToOtherSchoolNoWhyOther): static
    {
        $this->assertToOtherSchoolNoWhyOther = $assertToOtherSchoolNoWhyOther;

        return $this;
    }
}
