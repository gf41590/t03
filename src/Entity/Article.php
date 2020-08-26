<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\Table(name="article")
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
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $contributors;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $participationsContributors;

    /**
     * @ORM\Column(type="integer")
     */
    private $ministerialPoints;

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
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;
    

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

    public function getContributors(): ?string
    {
        return $this->contributors;
    }

    public function setContributors(?string $contributors): self
    {
        $this->contributors = $contributors;

        return $this;
    }

    public function getParticipationsContributors(): ?string
    {
        return $this->participationsContributors;
    }

    public function setParticipationsContributors(?string $participationsContributors): self
    {
        $this->participationsContributors = $participationsContributors;

        return $this;
    }

    public function getMinisterialPoints(): ?int
    {
        return $this->ministerialPoints;
    }

    public function setMinisterialPoints(int $ministerialPoints): self
    {
        $this->ministerialPoints = $ministerialPoints;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }



    public function setUserid( $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
