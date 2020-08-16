<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $participation;


    /**
     * @ORM\Column(type="integer")
     */
    private $contributors;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $participations_contributors;

    /**
     * @ORM\Column(type="integer")
     */
    private $ministerial_points;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $journal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $conference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $doi;

    /**
     * @ORM\Column(type="date")
     */
    private $date_of_publication;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getParticipation(): ?string
    {
        return $this->participation;
    }

    public function setParticipation(string $participation): self
    {
        $this->participation = $participation;

        return $this;
    }

    public function getContributors(): ?int
    {
        return $this->contributors;
    }

    public function setContributors(?int $contributors): self
    {
        $this->contributors = $contributors;

        return $this;
    }

    public function getParticipationsContributors(): ?string
    {
        return $this->participations_contributors;
    }

    public function setParticipationsContributors(?string $participations_contributors): self
    {
        $this->participations_contributors = $participations_contributors;

        return $this;
    }

    public function getMinisterialPoints(): ?int
    {
        return $this->ministerial_points;
    }

    public function setMinisterialPoints(int $ministerial_points): self
    {
        $this->ministerial_points = $ministerial_points;

        return $this;
    }

    public function getJournal(): ?string
    {
        return $this->journal;
    }

    public function setJournal(string $journal): self
    {
        $this->journal = $journal;

        return $this;
    }

    public function getConference(): ?string
    {
        return $this->conference;
    }

    public function setConference(string $conference): self
    {
        $this->conference = $conference;

        return $this;
    }

    public function getDoi(): ?string
    {
        return $this->doi;
    }

    public function setDoi(string $doi): self
    {
        $this->doi = $doi;

        return $this;
    }

    public function getDateOfPublication(): ?\DateTimeInterface
    {
        return $this->date_of_publication;
    }

    public function setDateOfPublication(\DateTimeInterface $date_of_publication): self
    {
        $this->date_of_publication = $date_of_publication;

        return $this;
    }
}
