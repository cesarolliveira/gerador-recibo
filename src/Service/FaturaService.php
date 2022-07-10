<?php

namespace App\Service;

use App\Entity\Fatura;
use App\Entity\Recibo;
use Doctrine\ORM\EntityManagerInterface;

class FaturaService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function criarFaturas(Recibo $recibo): void
    {
        $valorParcela = $recibo->getValor() / $recibo->getParcela();

        for ($i = 1; $i <= $recibo->getParcela(); ++$i) {
            $fatura = new Fatura();
            $fatura->setRecibo($recibo);
            $fatura->setParcela($i.'/'.$recibo->getParcela());
            $fatura->setValor($valorParcela);
            $fatura->setVencimento(date_modify($recibo->getDataVencimento(), '+1 month'));

            $this->em->persist($fatura);
            $this->em->flush();
        }
    }
}
