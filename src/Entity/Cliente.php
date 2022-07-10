<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nome;

    #[ORM\Column(type: 'string', length: 255)]
    private $documento;

    #[ORM\OneToMany(mappedBy: 'clienteId', targetEntity: Recibo::class)]
    private $recibos;

    public function __construct()
    {
        $this->recibos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDocumento(): ?string
    {
        return $this->documento;
    }

    public function setDocumento(string $documento): self
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * @return Collection<int, Recibo>
     */
    public function getRecibos(): Collection
    {
        return $this->recibos;
    }

    public function addRecibo(Recibo $recibo): self
    {
        if (!$this->recibos->contains($recibo)) {
            $this->recibos[] = $recibo;
            $recibo->setCliente($this);
        }

        return $this;
    }

    public function removeRecibo(Recibo $recibo): self
    {
        if ($this->recibos->removeElement($recibo)) {
            // set the owning side to null (unless already changed)
            if ($recibo->getCliente() === $this) {
                $recibo->setCliente(null);
            }
        }

        return $this;
    }
}
