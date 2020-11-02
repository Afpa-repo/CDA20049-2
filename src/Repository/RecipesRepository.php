<?php

namespace App\Repository;

use App\Entity\Recipes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipes[]    findAll()
 * @method Recipes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipes::class);
    }

    /**
     * @label ('Return $limit element from recipes, starting at $offset index')
     * @param integer limit - number of returned recipes
     * @param integer offset - starting index for returned element
     * @param integer category - (OPTIONAL) ID of the category
     * @return Returns An array of {$limit} Recipes objects starting at {$offset} index
    */
    public function findLimit($numberElements,$offset,$category = false)
    {
        // automatically knows to select Recipes
        // the "r" is an alias you'll use in the rest of the query

        if(!$category){
            $qb = $this->createQueryBuilder('r')
                ->setFirstResult( $offset )
                ->setMaxResults( $numberElements );
        }
        $qb = $this->createQueryBuilder('r')
            ->where('r.category = :category')
            ->setFirstResult( $offset )
            ->setMaxResults( $numberElements )
            ->setParameter('category',$category);

        $query = $qb->getQuery();

        return $query->execute();
    }

    /*
      * @return the number of elements in Recipes
    */
    public function countElement()
    {
        $qb = $this->createQueryBuilder('r')
            ->select('count(r.id)');

        $query = $qb->getQuery();

        return $query->execute();
    }

    /*
    public function findOneBySomeField($value): ?Recipes
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
