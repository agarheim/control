<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageBlogRepository")
 */
class PageBlog
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
    private $titlePage;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentPage;

    /**
     * @ORM\Column(type="date")
     */
    private $datePub;
    /**
     * @var Date $updated
     *
     *
     *
     */
    private $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitlePage(): ?string
    {
        return $this->titlePage;
    }

    public function setTitlePage(string $titlePage): self
    {
        $this->titlePage = $titlePage;

        return $this;
    }

    public function getContentPage(): ?string
    {
        return $this->contentPage;
    }

    public function setContentPage(?string $contentPage): self
    {
        $this->contentPage = $contentPage;

        return $this;
    }

    public function getDatePub(): ?\DateTimeInterface
    {
        return $this->datePub;
    }

    public function setDatePub(\DateTimeInterface $datePub): self
    {
        $this->datePub = $datePub;

        return $this;
    }
    public function getUpdated($d)
    {
        return $this->updated=$d;
    }

}
