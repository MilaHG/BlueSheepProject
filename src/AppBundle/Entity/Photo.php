<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Activity;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 */
class Photo {

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	
	/**
	 *
	 * @var string 
	 * @ORM\Column(name="name", type="string")
	 * @Assert\NotBlank()
	 */
	private $name;
	
	/**
	 *
	 * @var Activity
	 * @ORM\ManyToOne(targetEntity="Activity", inversedBy="photos")
	 * @ORM\JoinColumn (name="activity_id", referencedColumnName="id", nullable=false)
	 */
	private $activity;

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * 
	 * @return Activity
	 */
	public function getActivity() {
		return $this->activity;
	}

	/**
	 * 
	 * @param string $name
	 * @return $this
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * 
	 * @param Activity $activity
	 * @return $this
	 */
	public function setActivity(Activity $activity) {
		$this->activity = $activity;
		return $this;
	}
}
