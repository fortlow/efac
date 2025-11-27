<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillRepository::class)]
class Bill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'bills')]
    private ?Client $client;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $numero;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $tc1_base;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $css_base;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private ?string $tc1_taux;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private ?string $css_taux;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $tc1_amount;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $css_amount;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $tot_ht;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $tva_css_amount;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $tot_ttc;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $deposit;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $net_payable;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $due_date;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $created_at;

    #[ORM\OneToMany(targetEntity: LineBill::class, mappedBy: 'bill')]
    private Collection $lineBills;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $subject;

    #[ORM\Column(type: 'bigint', nullable: true)]
    private ?string $wf_amount;

    #[ORM\Column(type: 'decimal', precision: 5, scale: 2, nullable: true)]
    private ?string $prct_discount;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private ?string $period;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $period_pay;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $txt_number;

    #[ORM\OneToMany(targetEntity: IntercalBill::class, mappedBy: 'bill')]
    private Collection $intercalBills;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $detailMainOeuvre = null;

    #[ORM\ManyToOne(inversedBy: 'bills')]
    private ?RefPaymentMethod $payment_method = null;

    #[ORM\ManyToOne(inversedBy: 'bills')]
    private ?RefStatusBill $status_bill = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $qr_code = null;

    #[ORM\Column(length: 42, nullable: true)]
    private ?string $secret_code = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_with_tps = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_without_tva = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $cond_reglt = null;

    #[ORM\Column(nullable: true)]
    private ?int $banque = null;

    #[ORM\OneToOne(cascade: ['persist'])]
    private ?Proforma $proforma = null;

    public function __construct()
    {
        $this->lineBills = new ArrayCollection();
        $this->intercalBills = new ArrayCollection();
    }
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return Client|null
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }
    /**
     * @param Client|null $client
     * @return $this
     */
    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getNumero(): ?string
    {
        return $this->numero;
    }
    /**
     * @param string $numero
     * @return $this
     */
    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getTc1Base(): ?string
    {
        return $this->tc1_base;
    }
    /**
     * @param string|null $tc1_base
     * @return $this
     */
    public function setTc1Base(?string $tc1_base): self
    {
        $this->tc1_base = $tc1_base;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getCssBase(): ?string
    {
        return $this->css_base;
    }
    /**
     * @param string|null $css_base
     * @return $this
     */
    public function setCssBase(?string $css_base): self
    {
        $this->css_base = $css_base;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getTc1Taux(): ?string
    {
        return $this->tc1_taux;
    }
    /**
     * @param string|null $tc1_taux
     * @return $this
     */
    public function setTc1Taux(?string $tc1_taux): self
    {
        $this->tc1_taux = $tc1_taux;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getCssTaux(): ?string
    {
        return $this->css_taux;
    }
    /**
     * @param string|null $css_taux
     * @return $this
     */
    public function setCssTaux(?string $css_taux): self
    {
        $this->css_taux = $css_taux;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getTc1Amount(): ?string
    {
        return $this->tc1_amount;
    }
    /**
     * @param string|null $tc1_amount
     * @return $this
     */
    public function setTc1Amount(?string $tc1_amount): self
    {
        $this->tc1_amount = $tc1_amount;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getCssAmount(): ?string
    {
        return $this->css_amount;
    }
    /**
     * @param string|null $css_amount
     * @return $this
     */
    public function setCssAmount(?string $css_amount): self
    {
        $this->css_amount = $css_amount;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getTotHt(): ?string
    {
        return $this->tot_ht;
    }
    /**
     * @param string|null $tot_ht
     * @return $this
     */
    public function setTotHt(?string $tot_ht): self
    {
        $this->tot_ht = $tot_ht;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getTvaCssAmount(): ?string
    {
        return $this->tva_css_amount;
    }
    /**
     * @param string|null $tva_css_amount
     * @return $this
     */
    public function setTvaCssAmount(?string $tva_css_amount): self
    {
        $this->tva_css_amount = $tva_css_amount;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getTotTtc(): ?string
    {
        return $this->tot_ttc;
    }
    /**
     * @param string|null $tot_ttc
     * @return $this
     */
    public function setTotTtc(?string $tot_ttc): self
    {
        $this->tot_ttc = $tot_ttc;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getDeposit(): ?string
    {
        return $this->deposit;
    }
    /**
     * @param string|null $deposit
     * @return $this
     */
    public function setDeposit(?string $deposit): self
    {
        $this->deposit = $deposit;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getNetPayable(): ?string
    {
        return $this->net_payable;
    }
    /**
     * @param string|null $net_payable
     * @return $this
     */
    public function setNetPayable(?string $net_payable): self
    {
        $this->net_payable = $net_payable;

        return $this;
    }
    /**
     * @return \DateTimeInterface|null
     */
    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->due_date;
    }
    /**
     * @param \DateTimeInterface|null $due_date
     * @return $this
     */
    public function setDueDate(?\DateTimeInterface $due_date): self
    {
        $this->due_date = $due_date;

        return $this;
    }
    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }
    /**
     * @param \DateTimeInterface $created_at
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
    /**
     * @return Collection
     */
    public function getLineBills(): Collection
    {
        return $this->lineBills;
    }
    /**
     * @param LineBill $lineBill
     * @return $this
     */
    public function addLineBill(LineBill $lineBill): self
    {
        if (!$this->lineBills->contains($lineBill)) {
            $this->lineBills[] = $lineBill;
            $lineBill->setBill($this);
        }

        return $this;
    }
    /**
     * @param LineBill $lineBill
     * @return $this
     */
    public function removeLineBill(LineBill $lineBill): self
    {
        if ($this->lineBills->removeElement($lineBill)) {
            // set the owning side to null (unless already changed)
            if ($lineBill->getBill() === $this) {
                $lineBill->setBill(null);
            }
        }

        return $this;
    }
    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }
    /**
     * @param string|null $subject
     * @return $this
     */
    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getWfAmount(): ?string
    {
        return $this->wf_amount;
    }
    /**
     * @param string|null $wf_amount
     * @return $this
     */
    public function setWfAmount(?string $wf_amount): self
    {
        $this->wf_amount = $wf_amount;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getPrctDiscount(): ?string
    {
        return $this->prct_discount;
    }
    /**
     * @param string|null $prct_discount
     * @return $this
     */
    public function setPrctDiscount(?string $prct_discount): self
    {
        $this->prct_discount = $prct_discount;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getPeriod(): ?string
    {
        return $this->period;
    }
    /**
     * @param string|null $period
     * @return $this
     */
    public function setPeriod(?string $period): self
    {
        $this->period = $period;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getPeriodPay(): ?string
    {
        return $this->period_pay;
    }
    /**
     * @param string|null $period_pay
     * @return $this
     */
    public function setPeriodPay(?string $period_pay): self
    {
        $this->period_pay = $period_pay;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getTxtNumber(): ?string
    {
        return $this->txt_number;
    }
    /**
     * @param string|null $txt_number
     * @return $this
     */
    public function setTxtNumber(?string $txt_number): self
    {
        $this->txt_number = $txt_number;

        return $this;
    }
    /**
     * @return Collection<int, IntercalBill>
     */
    public function getIntercalBills(): Collection
    {
        return $this->intercalBills;
    }
    /**
     * @param IntercalBill $intercalBill
     * @return $this
     */
    public function addIntercalBill(IntercalBill $intercalBill): static
    {
        if (!$this->intercalBills->contains($intercalBill)) {
            $this->intercalBills->add($intercalBill);
            $intercalBill->setBill($this);
        }

        return $this;
    }
    /**
     * @param IntercalBill $intercalBill
     * @return $this
     */
    public function removeIntercalBill(IntercalBill $intercalBill): static
    {
        if ($this->intercalBills->removeElement($intercalBill)) {
            // set the owning side to null (unless already changed)
            if ($intercalBill->getBill() === $this) {
                $intercalBill->setBill(null);
            }
        }

        return $this;
    }
    /**
     * @return string|null
     */
    public function getDetailMainOeuvre(): ?string
    {
        return $this->detailMainOeuvre;
    }
    /**
     * @param string|null $detailMainOeuvre
     * @return $this
     */
    public function setDetailMainOeuvre(?string $detailMainOeuvre): static
    {
        $this->detailMainOeuvre = $detailMainOeuvre;

        return $this;
    }
    /**
     * @return RefPaymentMethod|null
     */
    public function getPaymentMethod(): ?RefPaymentMethod
    {
        return $this->payment_method;
    }
    /**
     * @param RefPaymentMethod|null $payment_method
     * @return $this
     */
    public function setPaymentMethod(?RefPaymentMethod $payment_method): static
    {
        $this->payment_method = $payment_method;

        return $this;
    }
    /**
     * @return RefStatusBill|null
     */
    public function getStatusBill(): ?RefStatusBill
    {
        return $this->status_bill;
    }
    /**
     * @param RefStatusBill|null $status_bill
     * @return $this
     */
    public function setStatusBill(?RefStatusBill $status_bill): static
    {
        $this->status_bill = $status_bill;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getQrCode(): ?string
    {
        return $this->qr_code;
    }
    /**
     * @param string $qr_code
     * @return $this
     */
    public function setQrCode(string $qr_code): static
    {
        $this->qr_code = $qr_code;

        return $this;
    }
    /**
     * @return string|null
     */
    public function getSecretCode(): ?string
    {
        return $this->secret_code;
    }
    /**
     * @param string $secret_code
     * @return $this
     */
    public function setSecretCode(string $secret_code): static
    {
        $this->secret_code = $secret_code;

        return $this;
    }
    /**
     * @return bool|null
     */
    public function isIsWithTps(): ?bool
    {
        return $this->is_with_tps;
    }
    /**
     * @param bool|null $is_with_tps
     * @return $this
     */
    public function setIsWithTps(?bool $is_with_tps): static
    {
        $this->is_with_tps = $is_with_tps;

        return $this;
    }
    /**
     * @return bool|null
     */
    public function isIsWithoutTva(): ?bool
    {
        return $this->is_without_tva;
    }
    /**
     * @param bool|null $is_without_tva
     * @return $this
     */
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

    public function getProforma(): ?Proforma
    {
        return $this->proforma;
    }

    public function setProforma(?Proforma $proforma): static
    {
        $this->proforma = $proforma;

        return $this;
    }
}