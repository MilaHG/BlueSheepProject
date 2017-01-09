<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ActivityRepository extends EntityRepository{
	
	//return a list of objects with the category information related 
	public function findAllByPartner($id){
		
		$qb = $this->createQueryBuilder('a');
		$qb
			->where('IDENTITY(a.partner) = ' . $id)
	//		->leftJoin('a.category', 'cat')
	//		->addSelect('cat')
			->orderBy('a.recordingDate', 'DESC')
		;
		return $qb->getQuery()->getResult();
	}
}
