<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;
/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment {

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
	 * @ORM\Column (name="comment", type="text")
	 */
	private $comment;
	
	/**
	 *
	 * @var int
	 * @ORM\Column (name="note", type="integer")
	 * @Assert\NotBlank()
	 * @Assert\LessThanOrEqual(value=5, message="This value should be less than or equal to {{ compared_value }}")
	 * @Assert\GreaterThanOrEqual(value=0, message="This value should be greater than or equal to {{ compared_value }}")
	 */
	private $note;
	
	/**
	 *
	 * @var DateTime
	 * @ORM\Column (name="date", type="date")
	 */
	private $date;
	
	/**
	 *
	 * @var User
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
	 */
	private $user;
	
	/**
	 *
	 * @var Activity
	 * @ORM\ManyToOne(targetEntity="Activity", inversedBy="comments")
	 * @ORM\JoinColumn(name="activity_id", referencedColumnName="id", nullable=false)
	 */
	private $activity;
	
	public function __construct() {
		$this->date = new \DateTime();
	}

	public function __toString() {
		return $this->getComment()."(".$this->getNote()."/5)";
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
	 * 
	 * @return string
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * 
	 * @return int
	 */
	public function getNote() {
		return $this->note;
	}

	/**
	 * 
	 * @return DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * 
	 * @return User
	 */
	public function getUser() {
		return $this->user;
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
	 * @param string $comment
	 * @return $this
	 */
	public function setComment($comment) {
		$this->comment = $comment;
		return $this;
	}

	/**
	 * 
	 * @param int $note
	 * @return $this
	 */
	public function setNote($note) {
		$this->note = $note;
		return $this;
	}

	/**
	 * 
	 * @param DateTime $date
	 * @return $this
	 */
	public function setDate(DateTime $date) {
		$this->date = $date;
		return $this;
	}

	/**
	 * 
	 * @param User $user
	 * @return $this
	 */
	public function setUser(User $user) {
		$this->user = $user;
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
