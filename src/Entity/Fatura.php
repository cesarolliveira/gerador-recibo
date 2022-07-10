<?php

namespace App\Entity;

use App\Repository\FaturaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FaturaRepository::class)]
class Fatura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Recibo::class, inversedBy: 'faturas')]
    private $recibo;

    #[ORM\Column(type: 'string', length: 255)]
    private $parcela;

    #[ORM\Column(type: 'date')]
    private $vencimento;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $valor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecibo(): ?Recibo
    {
        return $this->recibo;
    }

    public function setRecibo(?Recibo $recibo): self
    {
        $this->recibo = $recibo;

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

    public function getVencimento(): ?\DateTimeInterface
    {
        return $this->vencimento;
    }

    public function setVencimento(\DateTimeInterface $vencimento): self
    {
        $this->vencimento = $vencimento;

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
}
