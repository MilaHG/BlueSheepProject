<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ActivityRepository extends EntityRepository{
	
	//return a list of objects with the category information related 
	public function findAllByPartner(User $user){
		
		$qb = $this->createQueryBuilder('a');
		$qb
			->where('IDENTITY(a.partner) = ' . $user->getId())
			->leftJoin('a.category', 'cat')
			->addSelect('cat')
			->orderBy('a.recording_date', 'DESC')
		;
		return $qb->getQuery()->getResult();
	}
}
