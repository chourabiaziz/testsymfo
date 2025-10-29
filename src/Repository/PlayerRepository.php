<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Player>
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }


    public function findbyshirtnumber(): array
    {
        return $this->createQueryBuilder('p')   // toutes les player
          
        
        
        
            ->where('p.shirt_number > :valeur')
            ->setParameter('valeur', 500)



            ->orderBy('p.created_at', 'ASC') // trier par date de création croissante
          //  ->orderBy('p.createdAt', 'DESC') // trier par date de création decroissante


          
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }







//    public function findOneBySomeField($value): ?Player
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
