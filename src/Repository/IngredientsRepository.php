<?php

namespace App\Repository;

use App\Entity\Ingredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ingredients|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingredients|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingredients[]    findAll()
 * @method Ingredients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredients::class);
    }

    /**
     * @label ('Return $limit element from ingredients, starting at $offset index')
     * @param integer limit - number of returned recipes
     * @param integer offset - starting index for returned element
     * @param integer category - (OPTIONAL) ID of the category
     * @return Returns An array of {$limit} Ingredients objects starting at {$offset} index
     */
    public function findIngredientsCustom($numberElements,$offset,$category = false)
    {
        // Find elements from all categories with limit and offset
        $qb = $this->createQueryBuilder('i')
            ->setFirstResult( $offset )
            ->setMaxResults( $numberElements );

        // Add a category criteria if needed
        if($category){
            $qb = $qb->where('i.Category = :category')
                ->setParameter('category', $category);
        }

        $query = $qb->getQuery();

        return $query->execute();
    }

    /**
     * @param integer category - (OPTIONAL) ID of the category
     * @return the number of elements in Ingredients
     */
    public function countElement($category = false)
    {
        if(!$category || $category === 0){
            $qb = $this->createQueryBuilder('i')
                ->select('count(i.id)');
        }else{
            $qb = $this->createQueryBuilder('i')
                ->select('count(i.id)')
                ->where('i.Category = :category')
                ->setParameter('category',$category);
        }

        $query = $qb->getQuery();

        return $query->execute();
    }
}
