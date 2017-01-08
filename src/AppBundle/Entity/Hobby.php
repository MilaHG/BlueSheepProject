<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Hobby
 *
 * @ORM\Table(name="hobby", uniqueConstraints={
 *      @ORM\UniqueConstraint(name="search_idx", columns={"id_user", "id_category"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HobbyRepository")
 * @UniqueEntity(
 *      fields={"user", "category"}, message="Vous avez déjà sélectionné cette catégorie."
 * )
 */
class Hobby {

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="note", type="integer")
	 *
	 */
	private $note;

	/**
	 * @var User
	 * 
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="hobbies")
	 * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
	 * 
	 */
	private $user;

	/**
	 * @var Category
	 * 
	 * @ORM\ManyToOne(targetEntity="Category", inversedBy="hobbies")
	 * @ORM\JoinColumn(name="id_category", referencedColumnName="id")
	 * 
	 */
	private $category;

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set note
	 *
	 * @param integer $note
	 *
	 * @return Hobby
	 */
	public function setNote($note) {
		$this->note = $note;

		return $this;
	}

	/**
	 * Get note
	 *
	 * @return int
	 */
	public function getNote() {
		return $this->note;
	}

	/**
	 * 
	 * @return User
	 */
	function getUser() {
		return $this->user;
	}

	/**
	 * 
	 * @return Category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * 
	 * @param User $user
	 */
	public function setUser(User $user) {
		$this->user = $user;
		return $this;
	}

	/**
	 * 
	 * @param Category $category
	 */
	public function setCategory(Category $category) {
		$this->category = $category;
		return $this;
	}

}
