<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="CategoryRepository")
 * @Vich\Uploadable
 */
class Category {

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string", length=100)
	 * @Assert\NotBlank()
	 * @Assert\Length(min = 5, max = 100)
	 * 
	 */
	private $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="text")
	 * @Assert\NotBlank()
	 * @Assert\Length(min = 10, max = 255)
	 * 
	 */
	private $description;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="photo", type="string", length=255)
	 */
	private $photo;

	/**
	 * @Vich\UploadableField(mapping="cat_images", fileNameProperty="photo")
	 * @var File
	 */
	private $imageFile;

	/**
	 * @var ArrayCollection
	 * 
	 * @ORM\OneToMany(targetEntity="Hobby", mappedBy="category")
	 * 
	 */
	private $hobbies;

	/**
	 * @var ArrayCollection
	 * 
	 * @ORM\OneToMany(targetEntity="Activity", mappedBy="category")
	 */
	private $activities;

	public function __construct() {
		$this->hobbies = new ArrayCollection();
		$this->activities = new ArrayCollection();
	}

	public function __toString() {
		return $this->getName(). ' (toString Method)';
	}

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return Category
	 */
	public function setName($name) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return Category
	 */
	public function setDescription($description) {
		$this->description = $description;

		return $this;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Set photo
	 *
	 * @param string $photo
	 *
	 * @return Category
	 */
	public function setPhoto($photo) {
		$this->photo = $photo;

		return $this;
	}

	/**
	 * Get photo
	 *
	 * @return string
	 */
	public function getPhoto() {
		return $this->photo;
	}

	/**
	 * 
	 * @return Hobby
	 */
	public function getHobbies() {
		return $this->hobbies;
	}

	/**
	 * 
	 * @param ArrayCollection 
	 * @return \AppBundle\Entity\Hobby $hobbies
	 */
	public function setHobbies(ArrayCollection $hobbies) {
		$this->hobbies = $hobbies;
		return $this;
	}

	/**
	 * 
	 * @return ArrayCollection
	 */
	public function getActivities() {
		return $this->activities;
	}

	/**
	 * 
	 * @param ArrayCollection $activities
	 * @return \AppBundle\Entity\Category
	 */
	public function setActivities(ArrayCollection $activities) {
		$this->activities = $activities;
		return $this;
	}

	public function setImageFile(File $image = null) {
		$this->imageFile = $image;

		// VERY IMPORTANT:
		// It is required that at least one field changes if you are using Doctrine,
		// otherwise the event listeners won't be called and the file is lost
		/* if ($image) {
		  // if 'updatedAt' is not defined in your entity, use another property
		  $this->updatedAt = new \DateTime('now');
		  } */
	}

	public function getImageFile() {
		return $this->imageFile;
	}

	/**
	 * Add a activity in the category.
	 *
	 * @param Activity $activity
	 */
	public function addActivity($activity) {
		if ($this->activities->contains($activity)) {
			return;
		}
		$this->activities->add($activity);
		$activity->addActivity($this);
	}

	/**
	 * @param Activity $activity
	 */
	public function removeActivity($activity) {
		if (!$this->activities->contains($activity)) {
			return;
		}
		$this->activities->removeElement($activity);
		$activity->removeActivity($this);
	}
}
