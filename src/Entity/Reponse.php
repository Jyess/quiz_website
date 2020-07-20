<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max = 255, maxMessage = "La question doit faire moins de 255 caractères.")
     */
    private $intitule;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vraiFaux;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="reponses")
     * @ORM\JoinColumn(name="questionId", referencedColumnName="id")
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

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getVraiFaux(): ?bool
    {
        return $this->vraiFaux;
    }

    public function setVraiFaux(bool $vraiFaux): self
    {
        $this->vraiFaux = $vraiFaux;

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
}
