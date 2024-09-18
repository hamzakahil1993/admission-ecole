<?php

namespace App\Entity;

use App\Repository\AssertionDocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssertionDocumentRepository::class)]
class AssertionDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'assertionDocuments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Assertion $assertion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAssertion(): ?Assertion
    {
        return $this->assertion;
    }

    public function setAssertion(?Assertion $assertion): static
    {
        $this->assertion = $assertion;

        return $this;
    }
}
