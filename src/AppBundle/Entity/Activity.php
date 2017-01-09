<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use\DateTime;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActivityRepository")
 */
class Activity {

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="participant_solo", type="boolean", nullable=true)
	 */
	private $participantSolo;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="participant_duo", type="boolean", nullable=true)
	 */
	private $participantDuo;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="participant_family", type="boolean", nullable=true)
	 */
	private $participantFamily;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="participant_friend", type="boolean", nullable=true)
	 */
	private $participantFriend;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="title", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 3,
	 *      max = 255,
	 *      minMessage = "Your activity's title must be at least {{ limit }} characters long",
	 *      maxMessage = "Your activity's title cannot be longer than {{ limit }} characters"
	 * )
	 * 
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="address", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 3,
	 *      max = 255,
	 *      minMessage = "Your activity's address must be at least {{ limit }} characters long",
	 *      maxMessage = "Your activity's address cannot be longer than {{ limit }} characters"
	 * )
	 */
	private $address;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="zip", type="string", length=5)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 5,
	 *      max = 5,
	 *      exactMessage = "Your activity's zip should have exactly {{ limit }} characters"
	 * )
	 */
	private $zip;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="city", type="string", length=100)
	 * @Assert\NotBlank()
	 */
	private $city;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="description", type="text", nullable=true)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 3,
	 *      max = 100,
	 *      minMessage = "Your activity's city must be at least {{ limit }} characters long",
	 *      maxMessage = "Your activity's city cannot be longer than {{ limit }} characters"
	 * )
	 */
	private $description;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="recording_date", type="date")
	 */
	private $recordingDate;

	/**
	 * @var Category
	 *
	 * @ORM\ManyToOne(targetEntity="Category", inversedBy="activities")
	 * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)	
	 */
	private $category;

	/**
	 * @var User
	 *
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="activities")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)	
	 * 
	 */
	private $partner;

	/**
	 *
	 * @var ArrayCollection
	 * @ORM\OneToMany(targetEntity="Product", mappedBy="activity")
	 */
	private $products;

	/**
	 *
	 * @var ArrayCollection
	 * @ORM\OneToMany(targetEntity="Photo", mappedBy="activity", cascade={"persist"})
	 */
	private $photos;

	/**
	 *
	 * @var ArrayCollection
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="activity")
	 */
	private $comments;
			
	function __construct() {
		$this->products = new ArrayCollection();
		$this->photos = new ArrayCollection();
		$this->comments = new ArrayCollection();
		$this->recordingDate = new DateTime();
	}
	
	public function __toString() {
		return $this->getTitle(). ' (toString Method)';
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
	 * Set participantSolo
	 *
	 * @param boolean $participantSolo
	 *
	 * @return Activity
	 */
	public function setParticipantSolo($participantSolo) {
		$this->participantSolo = $participantSolo;

		return $this;
	}

	/**
	 * Get participantSolo
	 *
	 * @return bool
	 */
	public function getParticipantSolo() {
		return $this->participantSolo;
	}

	/**
	 * Set participantDuo
	 *
	 * @param boolean $participantDuo
	 *
	 * @return Activity
	 */
	public function setParticipantDuo($participantDuo) {
		$this->participantDuo = $participantDuo;

		return $this;
	}

	/**
	 * Get participantDuo
	 *
	 * @return bool
	 */
	public function getParticipantDuo() {
		return $this->participantDuo;
	}

	/**
	 * Set participantFamily
	 *
	 * @param boolean $participantFamily
	 *
	 * @return Activity
	 */
	public function setParticipantFamily($participantFamily) {
		$this->participantFamily = $participantFamily;

		return $this;
	}

	/**
	 * Get participantFamily
	 *
	 * @return bool
	 */
	public function getParticipantFamily() {
		return $this->participantFamily;
	}

	/**
	 * Set participantFriend
	 *
	 * @param boolean $participantFriend
	 *
	 * @return Activity
	 */
	public function setParticipantFriend($participantFriend) {
		$this->participantFriend = $participantFriend;

		return $this;
	}

	/**
	 * Get participantFriend
	 *
	 * @return bool
	 */
	public function getParticipantFriend() {
		return $this->participantFriend;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 *
	 * @return Activity
	 */
	public function setTitle($title) {
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Set address
	 *
	 * @param string $address
	 *
	 * @return Activity
	 */
	public function setAddress($address) {
		$this->address = $address;

		return $this;
	}

	/**
	 * Get address
	 *
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Set zip
	 *
	 * @param string $zip
	 *
	 * @return Activity
	 */
	public function setZip($zip) {
		$this->zip = $zip;

		return $this;
	}

	/**
	 * Get zip
	 *
	 * @return string
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Set city
	 *
	 * @param string $city
	 *
	 * @return Activity
	 */
	public function setCity($city) {
		$this->city = $city;

		return $this;
	}

	/**
	 * Get city
	 *
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 *
	 * @return Activity
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
	 * Set recordingDate
	 *
	 * @param \DateTime $recordingDate
	 *
	 * @return Activity
	 */
	public function setRecordingDate(DateTime $recordingDate) {
		$this->recordingDate = $recordingDate;

		return $this;
	}

	/**
	 * Get recordingDate
	 *
	 * @return \DateTime
	 */
	public function getRecordingDate() {
		return $this->recordingDate;
	}

	/**
	 * Set category
	 *
	 * @param integer $category
	 *
	 * @return Activity
	 */
	public function setCategory(Category $category) {
		$this->category = $category;

		return $this;
	}

	/**
	 * Get category
	 *
	 * @return int
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Set user
	 *
	 * @param integer $user
	 *
	 * @return Activity
	 */
	public function setPartner(User $partner) {
		$this->partner = $partner;

		return $this;
	}
        
        public function getPartner() {
            return $this->partner;
        }

        
	/**
	 * Get user
	 *
	 * @return int
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * 
	 * @return Product
	 * 
	 */
	public function getProducts() {
		return $this->products;
	}

	/**
	 * 
	 * @return ArrayCollection
	 */
	public function getPhotos() {
		return $this->photos;
	}

	/**
	 * 
	 * @return ArrayCollection
	 */
	public function getComments() {
		return $this->comments;
	}

	/**
	 * 
	 * @param ArrayCollection $products
	 * @return $this
	 */
	public function setProducts(ArrayCollection $products) {
		$this->products = $products;
		return $this;
	}

	/**
	 * 
	 * @param ArrayCollection $photos
	 * @return $this
	 */
	public function setPhotos(ArrayCollection $photos) {
		$this->photos = $photos;
		return $this;
	}

	/**
	 * 
	 * @param ArrayCollection $comments
	 * @return $this
	 */
	public function setComments(ArrayCollection $comments) {
		$this->comments = $comments;
		return $this;
	}

	public function getAverageNote() {
		$averageNote=0;
		$c=0;
		foreach ($this->getComments() as $comment) {
			$averageNote+=$comment->getNote();
			$c++;
		}
		if ($c==0){
			return false;
		}
		$averageNote/=count($this->getComments());
		return $averageNote;
	}
        
        public function countPhoto() {
            
            return count($this->photos);
            
        }
}
