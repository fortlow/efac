<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProformaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProformaRepository::class)]
class Proforma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'proformas')]
    private ?Client $client;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $numero;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $tc1_base;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?string $css_base;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private ?string $tc1_taux;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private ?string $css_taux;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private ?string $tc1_amount;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?string $css_amount;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?string $tot_ht;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?string $tva_css_amount;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?string $tot_ttc;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?string $deposit;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 0, nullable: true)]
    private ?string $net_payable;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $created_at;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $subject;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $wf_amount;

    #[ORM\OneToMany(targetEntity: LineProforma::class, mappedBy: 'proforma')]
    private Collection $lineProformas;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private ?string $prct_discount;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $due_date;

    #[ORM\OneToMany(targetEntity: IntercalProforma::class, mappedBy: 'proforma')]
    private Collection $intercalProformas;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $detailMainOeuvre = null;

    #[ORM\Column(nullable: true)]
    private ?bool $flag_trans = null;

    #[ORM\ManyToOne(inversedBy: 'proformas')]
    private ?RefStatusProforma $status = null;

    #[ORM\Column(length: 255)]
    private ?string $qr_code = null;

    #[ORM\Column(length: 42)]
    private ?string $secret_code = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_with_tps = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_without_tva = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $cond_reglt = null;

    #[ORM\Column(nullable: true)]
    private ?int $banque = null;

    public function __construct()
    {
        $this->lineProformas = new ArrayCollection();
        $this->intercalProformas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getTc1Base(): ?string
    {
        return $this->tc1_base;
    }

    public function setTc1Base(?string $tc1_base): self
    {
        $this->tc1_base = $tc1_base;

        return $this;
    }

    public function getCssBase(): ?string
    {
        return $this->css_base;
    }

    public function setCssBase(?string $css_base): self
    {
        $this->css_base = $css_base;

        return $this;
    }

    public function getTc1Taux(): ?string
    {
        return $this->tc1_taux;
    }

    public function setTc1Taux(?string $tc1_taux): self
    {
        $this->tc1_taux = $tc1_taux;

        return $this;
    }

    public function getCssTaux(): ?string
    {
        return $this->css_taux;
    }

    public function setCssTaux(?string $css_taux): self
    {
        $this->css_taux = $css_taux;

        return $this;
    }

    public function getTc1Amount(): ?string
    {
        return $this->tc1_amount;
    }

    public function setTc1Amount(?string $tc1_amount): self
    {
        $this->tc1_amount = $tc1_amount;

        return $this;
    }

    public function getCssAmount(): ?string
    {
        return $this->css_amount;
    }

    public function setCssAmount(?string $css_amount): self
    {
        $this->css_amount = $css_amount;

        return $this;
    }

    public function getTotHt(): ?string
    {
        return $this->tot_ht;
    }

    public function setTotHt(?string $tot_ht): self
    {
        $this->tot_ht = $tot_ht;

        return $this;
    }

    public function getTvaCssAmount(): ?string
    {
        return $this->tva_css_amount;
    }

    public function setTvaCssAmount(?string $tva_css_amount): self
    {
        $this->tva_css_amount = $tva_css_amount;

        return $this;
    }

    public function getTotTtc(): ?string
    {
        return $this->tot_ttc;
    }

    public function setTotTtc(?string $tot_ttc): self
    {
        $this->tot_ttc = $tot_ttc;

        return $this;
    }

    public function getDeposit(): ?string
    {
        return $this->deposit;
    }

    public function setDeposit(?string $deposit): self
    {
        $this->deposit = $deposit;

        return $this;
    }

    public function getNetPayable(): ?string
    {
        return $this->net_payable;
    }

    public function setNetPayable(?string $net_payable): self
    {
        $this->net_payable = $net_payable;

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

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getWfAmount(): ?string
    {
        return $this->wf_amount;
    }

    public function setWfAmount(?string $wf_amount): self
    {
        $this->wf_amount = $wf_amount;

        return $this;
    }

    /**
     * @return Collection<int, LineProforma>
     */
    public function getLineProformas(): Collection
    {
        return $this->lineProformas;
    }

    public function addLineProforma(LineProforma $lineProforma): self
    {
        if (!$this->lineProformas->contains($lineProforma)) {
            $this->lineProformas[] = $lineProforma;
            $lineProforma->setProforma($this);
        }

        return $this;
    }

    public function removeLineProforma(LineProforma $lineProforma): self
    {
        if ($this->lineProformas->removeElement($lineProforma)) {
            // set the owning side to null (unless already changed)
            if ($lineProforma->getProforma() === $this) {
                $lineProforma->setProforma(null);
            }
        }

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

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->due_date;
    }

    public function setDueDate(?\DateTimeInterface $due_date): self
    {
        $this->due_date = $due_date;

        return $this;
    }

    /**
     * @return Collection<int, IntercalProforma>
     */
    public function getIntercalProformas(): Collection
    {
        return $this->intercalProformas;
    }

    public function addIntercalProforma(IntercalProforma $intercalProforma): static
    {
        if (!$this->intercalProformas->contains($intercalProforma)) {
            $this->intercalProformas->add($intercalProforma);
            $intercalProforma->setProforma($this);
        }

        return $this;
    }

    public function removeIntercalProforma(IntercalProforma $intercalProforma): static
    {
        if ($this->intercalProformas->removeElement($intercalProforma)) {
            // set the owning side to null (unless already changed)
            if ($intercalProforma->getProforma() === $this) {
                $intercalProforma->setProforma(null);
            }
        }

        return $this;
    }

    public function getDetailMainOeuvre(): ?string
    {
        return $this->detailMainOeuvre;
    }

    public function setDetailMainOeuvre(?string $detailMainOeuvre): static
    {
        $this->detailMainOeuvre = $detailMainOeuvre;

        return $this;
    }

    public function isFlagTrans(): ?bool
    {
        return $this->flag_trans;
    }

    public function setFlagTrans(?bool $flag_trans): static
    {
        $this->flag_trans = $flag_trans;

        return $this;
    }

    public function getStatus(): ?RefStatusProforma
    {
        return $this->status;
    }

    public function setStatus(?RefStatusProforma $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getQrCode(): ?string
    {
        return $this->qr_code;
    }

    public function setQrCode(string $qr_code): static
    {
        $this->qr_code = $qr_code;

        return $this;
    }

    public function getSecretCode(): ?string
    {
        return $this->secret_code;
    }

    public function setSecretCode(string $secret_code): static
    {
        $this->secret_code = $secret_code;

        return $this;
    }

    public function isIsWithTps(): ?bool
    {
        return $this->is_with_tps;
    }

    public function setIsWithTps(?bool $is_with_tps): static
    {
        $this->is_with_tps = $is_with_tps;

        return $this;
    }

    public function isIsWithoutTva(): ?bool
    {
        return $this->is_without_tva;
    }

    public function setIsWithoutTva(?bool $is_without_tva): static
    {
        $this->is_without_tva = $is_without_tva;

        return $this;
    }

    public function getCondReglt(): ?string
    {
        return $this->cond_reglt;
    }

    public function setCondReglt(?string $cond_reglt): static
    {
        $this->cond_reglt = $cond_reglt;

        return $this;
    }

    public function getBanque(): ?int
    {
        return $this->banque;
    }

    public function setBanque(?int $banque): static
    {
        $this->banque = $banque;

        return $this;
    }
}