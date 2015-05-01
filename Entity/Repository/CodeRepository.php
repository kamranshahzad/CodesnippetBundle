<?php

namespace Kamran\CodesnippetBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CodeRepository extends EntityRepository
{


	public function findCodeByTags($tagid){
		//$qb = $this->createQueryBuilder('c','t');
		//$qb->from('KamranCodesnippetBundle:code', 'c');
		//$qb->leftJoin('c.tags','t');
		
		//return $qb->getQuery()->getResult();
		//$qb->join('p.user', 'u')->join('p.address', 'a')
	
		/*$this->createQueryBuilder()
        ->select('c')
        ->from('technology_tags', 's')
        ->innerJoin('s.Category c ON c.category_id = s.superCategory_id')
        ->where('s.name = :superCategoryName')
        ->setParameter('superCategoryName', $superCategoryName)
        ->getQuery()
        ->getResult();*/

        //$qb = $this->createQueryBuilder('c');
        //$qb->from('Kamran\TagsBundle\Entity\TechnologyTags','t');
        //return $qb->leftJoin('c.tags', 't')->getQuery()->getResult();
        //$dql = 'SELECT * FROM Kamran\CodesnippetBundle\Entity\Code c LEFT JOIN Kamran\TagsBundle\Entity\TechnologyTags t WHERE t.id = 1 ';
        //$query = $this->_em->createQuery($dql);
        //$query->setParameter('tagid', 1 );

        /*
         $q = $this
            ->createQueryBuilder('c')
            ->select('c , tt')
            ->leftJoin('c.tags', 'tt')
            ->where('tt.id = :id')
            ->setParameter('id', 1);
        */

        /*    
        $qb = $this->createQueryBuilder('c');    
        $q =   $qb->select( 'tt')->from('KamranTagsBundle:TechnologyTags', 'tt')->leftJoin('c.tags', 'tt');
        */

        /*
        $result = $this->createQueryBuilder('c')
        ->select('tt')
        ->from('KamranTagsBundle:TechnologyTags', 'tt')
        ->innerJoin('tt.Code c ON c.code_id = tt.tag_id' , 'tag_id')
        ->where('tt.id = :tagId')
        ->setParameter('tagId', 3)
        ->getQuery()
        ->getResult();
        */

        return $this->createQueryBuilder('p')
            ->select('p , tt ')
            ->leftJoin('p.tags', 'tt')
            ->where('tt.id = :id')->setParameter('id', $tagid)
            ->getQuery()->getResult();

	}


}