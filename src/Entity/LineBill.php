<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\LineBillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineBillRepository::class)]
class LineBill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Bill::class, inversedBy: 'lineBills')]
    private ?Bill $bill;

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

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private ?string $prct_discount;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $amount_discount;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBill(): ?Bill
    {
        return $this->bill;
    }

    public function setBill(?Bill $bill): self
    {
        $this->bill = $bill;

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

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPrctDiscount(): ?string
    {
        return $this->prct_discount;
    }

    public function setPrctDiscount(?string $prct_discount): self
    {
        $this->prct_discount = $prct_discount;

        return $this;
    }

    public function getAmountDiscount(): ?string
    {
        return $this->amount_discount;
    }

    public function setAmountDiscount(?string $amount_discount): self
    {
        $this->amount_discount = $amount_discount;

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