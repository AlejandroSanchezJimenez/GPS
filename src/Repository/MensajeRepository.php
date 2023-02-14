<?php

namespace App\Repository;

use App\Entity\Mensaje;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mensaje>
 *
 * @method Mensaje|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mensaje|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mensaje[]    findAll()
 * @method Mensaje[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MensajeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mensaje::class);
    }

    public function save(Mensaje $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mensaje $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Mensaje[] Returns an array of Mensaje objects
//     */
   public function findByExampleField($value): array
   {
       return $this->createQueryBuilder('m')
           ->andWhere('m.Usuario = :val')
           ->setParameter('val', $value)
           ->orderBy('m.id', 'ASC')
        //    ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findforJuez($value): array
   {
       return $this->createQueryBuilder('m')
           ->andWhere('m.Juez = :val')
           ->setParameter('val', $value)
        //    ->orderBy('m.id', 'ASC')
        //    ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

//    public function validador($value)
//    {
//        return $this->createQueryBuilder('m')
//            -->update()
//            ->set('m.Validado', true)
//            ->andWhere('r.id = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getSingleScalarResult()
//        ;
//    }

        public function Valida($value)
            {
                return $this->createQueryBuilder('m')
                    ->update()
                    ->set('m.Validado', 1)
                    ->andWhere('m.id = :val')
                    ->setParameter('val', $value)
                    ->getQuery()
                    ->getSingleScalarResult()
                ;
            }

            public function desValida($value)
            {
                return $this->createQueryBuilder('m')
                    ->update()
                    ->set('m.Validado', 0)
                    ->andWhere('m.id = :val')
                    ->setParameter('val', $value)
                    ->getQuery()
                    ->getSingleScalarResult()
                ;
            }

   public function toArray(Mensaje $mensaje) :array
    {
        return [
            $id=$mensaje->getId(),
            $fecha=$mensaje->getFechaHoraMensaje(),
            $banda=$mensaje->getBanda(),
            $modo=$mensaje->getModo(),
            $usuario=$mensaje->getUsuario(),
            $validado=$mensaje->isValidado()
        ];
    }
}
