<?php

namespace App\Entity;

use App\Repository\ReciboRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReciboRepository::class)]
class Recibo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: 'recibos')]
    private $cliente;

    #[ORM\Column(type: 'string', length: 255)]
    private $parcela;

    #[ORM\Column(type: 'date')]
    private $dataVencimento;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $valor;

    #[ORM\OneToMany(mappedBy: 'recibo', targetEntity: Fatura::class)]
    private $faturas;

    #[ORM\Column(type: 'string', length: 255)]
    private $descricao;

    public function __construct()
    {
        $this->faturas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getParcela(): ?string
    {
        return $this->parcela;
    }

    public function setParcela(string $parcela): self
    {
        $this->parcela = $parcela;

        return $this;
    }

    public function getDataVencimento(): ?\DateTimeInterface
    {
        return $this->dataVencimento;
    }

    public function setDataVencimento(\DateTimeInterface $dataVencimento): self
    {
        $this->dataVencimento = $dataVencimento;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * @return Collection<int, Fatura>
     */
    public function getFaturas(): Collection
    {
        return $this->faturas;
    }

    public function addFatura(Fatura $fatura): self
    {
        if (!$this->faturas->contains($fatura)) {
            $this->faturas[] = $fatura;
            $fatura->setRecibo($this);
        }

        return $this;
    }

    public function removeFatura(Fatura $fatura): self
    {
        if ($this->faturas->removeElement($fatura)) {
            // set the owning side to null (unless already changed)
            if ($fatura->getRecibo() === $this) {
                $fatura->setRecibo(null);
            }
        }

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }
}
