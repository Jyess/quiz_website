<?php

namespace App\Entity;

use App\Repository\QuizRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass=QuizRepository::class)
 */
class Quiz
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $plageHoraireDebut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $plageHoraireFin;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $cleAcces;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateurCreateur;

    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="Quiz")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(?string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getPlageHoraireDebut(): ?\DateTimeInterface
    {
        return $this->plageHoraireDebut;
    }

    public function setPlageHoraireDebut(?\DateTimeInterface $plageHoraireDebut): self
    {
        $this->plageHoraireDebut = $plageHoraireDebut;

        return $this;
    }

    public function getPlageHoraireFin(): ?\DateTimeInterface
    {
        return $this->plageHoraireFin;
    }

    public function setPlageHoraireFin(?\DateTimeInterface $plageHoraireFin): self
    {
        $this->plageHoraireFin = $plageHoraireFin;

        return $this;
    }

    public function getCleAcces(): ?string
    {
        return $this->cleAcces;
    }

    public function setCleAcces(?string $cleAcces): self
    {
        $this->cleAcces = $cleAcces;

        return $this;
    }

    public function getUtilisateurCreateur(): ?Utilisateur
    {
        return $this->utilisateurCreateur;
    }

    public function setUtilisateurCreateur(?Utilisateur $utilisateurCreateur): self
    {
        $this->utilisateurCreateur = $utilisateurCreateur;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function invalidTimeRange(ExecutionContextInterface $context, $payload) {
        if ($this->plageHoraireDebut < $this->plageHoraireFin) {
            $context->buildViolation('La plage horaire de début doit être strictement inférieure à celle de fin.')
                ->atPath('plageHoraireDebut')
                ->atPath('plageHoraireFin')
                ->addViolation();
        }
    }
}
