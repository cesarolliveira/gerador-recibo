<?php

namespace App\Repository;

use App\Entity\Cliente;
use App\Entity\Fatura;
use App\Entity\Recibo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fatura>
 *
 * @method null|Fatura find($id, $lockMode = null, $lockVersion = null)
 * @method null|Fatura findOneBy(array $criteria, array $orderBy = null)
 * @method Fatura[]    findAll()
 * @method Fatura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FaturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fatura::class);
    }

    public function add(Fatura $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Fatura $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findFaturasByCliente(Cliente $cliente): array
    {
        $qb = $this->createQueryBuilder('fatura');

        $qb
            ->innerJoin(Recibo::class, 'recibo', 'WITH', 'fatura.recibo = recibo.id')
            ->innerJoin(Cliente::class, 'cliente', 'WITH', 'recibo.cliente = cliente.id')
            ->where($qb->expr()->eq('cliente.id', ':clienteId'))
            ->setParameter('clienteId', $cliente->getId())
        ;

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Fatura[] Returns an array of Fatura objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Fatura
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
