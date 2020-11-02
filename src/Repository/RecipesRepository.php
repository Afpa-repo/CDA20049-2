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
        // Find elements from all categories with limit and offset
        $qb = $this->createQueryBuilder('r')
            ->setFirstResult( $offset )
            ->setMaxResults( $numberElements );

        // Add a category criteria if needed
        if($category){
            $qb = $qb->where('r.category = :category')
                ->setParameter('category', $category);
        }

        $query = $qb->getQuery();

        return $query->execute();
    }

    /**
     * @param integer category - (OPTIONAL) ID of the category
     * @return the number of elements in Recipes
    */
    public function countElement($category = false)
    {
        if(!$category || $category === 0){
            $qb = $this->createQueryBuilder('r')
                ->select('count(r.id)');
        }else{
            $qb = $this->createQueryBuilder('r')
                ->select('count(r.id)')
                ->where('r.category = :category')
                ->setParameter('category',$category);
        }

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
