<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\RefStatusProformaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RefStatusProformaRepository::class)]
class RefStatusProforma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(targetEntity: Proforma::class, mappedBy: 'status')]
    private Collection $proformas;

    public function __construct()
    {
        $this->proformas = new ArrayCollection();
    }
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }
    /**
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }
    /**
     * @return Collection<int, Proforma>
     */
    public function getProformas(): Collection
    {
        return $this->proformas;
    }
    /**
     * @param Proforma $proforma
     * @return $this
     */
    public function addProforma(Proforma $proforma): static
    {
        if (!$this->proformas->contains($proforma)) {
            $this->proformas->add($proforma);
            $proforma->setStatus($this);
        }

        return $this;
    }
    /**
     * @param Proforma $proforma
     * @return $this
     */
    public function removeProforma(Proforma $proforma): static
    {
        if ($this->proformas->removeElement($proforma)) {
            // set the owning side to null (unless already changed)
            if ($proforma->getStatus() === $this) {
                $proforma->setStatus(null);
            }
        }

        return $this;
    }
}
