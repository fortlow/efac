<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $sreason;

    #[ORM\Column(type: 'string', length: 255)]
    private string $address;

    #[ORM\Column(type: 'string', length: 255)]
    private string $city;

    #[ORM\Column(type: 'string', length: 255)]
    private string $country;

    #[ORM\Column(type: 'string', length: 255)]
    private string $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $email;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $created_at;

    #[ORM\OneToMany(targetEntity: ContactClient::class, mappedBy: 'client')]
    private Collection $contactClients;

    #[ORM\OneToMany(targetEntity: Proforma::class, mappedBy: 'client')]
    private Collection $proformas;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $num_account;

    #[ORM\OneToMany(targetEntity: Bill::class, mappedBy: 'client')]
    private Collection $bills;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $address_cpt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $nif;

    #[ORM\ManyToOne]
    private ?RefTypeClient $type_client = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    private ?StatusClient $status_client = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $num_command = null;

    public function __construct()
    {
        $this->contactClients = new ArrayCollection();
        $this->proformas = new ArrayCollection();
        $this->bills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getSreason(): ?string
    {
        return $this->sreason;
    }
    public function setSreason(string $sreason): static
    {
        $this->sreason = $sreason;

        return $this;
    }
    public function getAddress(): ?string
    {
        return $this->address;
    }
    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }
    public function getCountry(): ?string
    {
        return $this->country;
    }
    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
    public function getNumAccount(): ?string
    {
        return $this->num_account;
    }
    public function setNumAccount(?string $num_account): static
    {
        $this->num_account = $num_account;

        return $this;
    }
    public function getAddressCpt(): ?string
    {
        return $this->address_cpt;
    }
    public function setAddressCpt(?string $address_cpt): static
    {
        $this->address_cpt = $address_cpt;

        return $this;
    }
    public function getNif(): ?string
    {
        return $this->nif;
    }
    public function setNif(?string $nif): static
    {
        $this->nif = $nif;

        return $this;
    }
    public function getContactClients(): Collection
    {
        return $this->contactClients;
    }
    public function addContactClient(ContactClient $contactClient): static
    {
        if (!$this->contactClients->contains($contactClient)) {
            $this->contactClients->add($contactClient);
            $contactClient->setClient($this);
        }

        return $this;
    }
    public function removeContactClient(ContactClient $contactClient): static
    {
        if ($this->contactClients->removeElement($contactClient)) {
            // set the owning side to null (unless already changed)
            if ($contactClient->getClient() === $this) {
                $contactClient->setClient(null);
            }
        }

        return $this;
    }
    public function getProformas(): Collection
    {
        return $this->proformas;
    }
    public function addProforma(Proforma $proforma): static
    {
        if (!$this->proformas->contains($proforma)) {
            $this->proformas->add($proforma);
            $proforma->setClient($this);
        }

        return $this;
    }
    public function removeProforma(Proforma $proforma): static
    {
        if ($this->proformas->removeElement($proforma)) {
            // set the owning side to null (unless already changed)
            if ($proforma->getClient() === $this) {
                $proforma->setClient(null);
            }
        }

        return $this;
    }
    public function getBills(): Collection
    {
        return $this->bills;
    }
    public function addBill(Bill $bill): static
    {
        if (!$this->bills->contains($bill)) {
            $this->bills->add($bill);
            $bill->setClient($this);
        }

        return $this;
    }
    public function removeBill(Bill $bill): static
    {
        if ($this->bills->removeElement($bill)) {
            // set the owning side to null (unless already changed)
            if ($bill->getClient() === $this) {
                $bill->setClient(null);
            }
        }

        return $this;
    }
    public function getTypeClient(): ?RefTypeClient
    {
        return $this->type_client;
    }
    public function setTypeClient(?RefTypeClient $type_client): static
    {
        $this->type_client = $type_client;

        return $this;
    }
    public function getStatusClient(): ?StatusClient
    {
        return $this->status_client;
    }
    public function setStatusClient(?StatusClient $status_client): static
    {
        $this->status_client = $status_client;

        return $this;
    }
    public function getNumCommand(): ?string
    {
        return $this->num_command;
    }
    public function setNumCommand(?string $num_command): static
    {
        $this->num_command = $num_command;

        return $this;
    }
}