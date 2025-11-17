<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\LineProformaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineProformaRepository::class)]
class LineProforma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Proforma::class, inversedBy: 'lineProformas')]
    private ?Proforma $proforma;

    #[ORM\ManyToOne(targetEntity: RefService::class)]
    private ?RefService $ref_service;

    #[ORM\ManyToOne(targetEntity: RefProduct::class)]
    private ?RefProduct $ref_product;

    #[ORM\Column(type: 'string', length: 255)]
    private string $designation;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $designation_cpt = null;

    #[ORM\Column(type: 'integer')]
    private int $qte;

    #[ORM\Column(type: 'bigint')]
    private string $unit_price;

    #[ORM\Column(type: 'bigint')]
    private string $amount_ht;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProforma(): ?Proforma
    {
        return $this->proforma;
    }

    public function setProforma(?Proforma $proforma): self
    {
        $this->proforma = $proforma;

        return $this;
    }

    public function getRefService(): ?RefService
    {
        return $this->ref_service;
    }

    public function setRefService(?RefService $ref_service): self
    {
        $this->ref_service = $ref_service;

        return $this;
    }

    public function getRefProduct(): ?RefProduct
    {
        return $this->ref_product;
    }

    public function setRefProduct(?RefProduct $ref_product): self
    {
        $this->ref_product = $ref_product;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->unit_price;
    }

    public function setUnitPrice(string $unit_price): self
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    public function getAmountHt(): ?string
    {
        return $this->amount_ht;
    }

    public function setAmountHt(string $amount_ht): self
    {
        $this->amount_ht = $amount_ht;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDesignationCpt(): ?string
    {
        return $this->designation_cpt;
    }

    public function setDesignationCpt(?string $designation_cpt): static
    {
        $this->designation_cpt = $designation_cpt;

        return $this;
    }
}