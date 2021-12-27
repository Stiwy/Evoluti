<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $details;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    private $price_recurrency;

    #[ORM\Column(type: 'string', length: 255)]
    private $invoice_recurrency;

    #[ORM\Column(type: 'date')]
    private $start_mission_date;

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

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceRecurrency(): ?string
    {
        return $this->price_recurrency;
    }

    public function setPriceRecurrency(string $price_recurrency): self
    {
        $this->price_recurrency = $price_recurrency;

        return $this;
    }

    public function getInvoiceRecurrency(): ?string
    {
        return $this->invoice_recurrency;
    }

    public function setInvoiceRecurrency(string $invoice_recurrency): self
    {
        $this->invoice_recurrency = $invoice_recurrency;

        return $this;
    }

    public function getStartMissionDate(): ?\DateTimeInterface
    {
        return $this->start_mission_date;
    }

    public function setStartMissionDate(\DateTimeInterface $start_mission_date): self
    {
        $this->start_mission_date = $start_mission_date;

        return $this;
    }
}
