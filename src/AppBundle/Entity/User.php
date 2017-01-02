<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @Vich\Uploadable
 */
class User {

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
	 * @ORM\Column(name="gender", type="string", length=3)
	 */
	private $gender;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="firstname", type="string", length=45)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *          max=45, 
	 *          maxMessage = "Your firstname cannot be longer than {{ limit }} characters."
	 * )
	 * 
	 */
	private $firstname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="lastname", type="string", length=45)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *         max=45, 
	 *         maxMessage = "Your lastname cannot be longer than {{ limit }} characters."
	 * )
	 */
	private $lastname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="pseudo", type="string", length=45)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *          max=45, 
	 *          maxMessage ="Your pseudo cannot be longer than {{ limit }} characters."
	 * )
	 */
	private $pseudo;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=100, unique=true)
	 * @Assert\NotBlank()
	 * @Assert\Email(
	 *        message ="The email '{{ value }}' is not a valid email.",
	 *        checkMX = true
	 * )
	 */
	private $email;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="password", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *          min=6,
	 *          minMessage = "Password may have less {{ limit }} characters.")
	 */
	private $password;

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="birthdate", type="date")
	 * @Assert\DateTime()
	 */
	private $birthdate;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="address", type="string", length=250)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *          min= 10,
	 *          max= 250
	 * )
	 */
	private $address;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="zip", type="string", length=5)
	 * @Assert\NotBlank()
	 * @Assert\Length(min=5, max=5)
	 */
	private $zip;

	/**
	 *
	 * @var string
	 * 
	 * @ORM\Column(name="city", type="string", length=100)
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3, max=100)
	 */
	private $city;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="role", type="string", length=10)
	 */
	private $role = "ROLE_USER";

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="register_date", type="datetime")
	 */
	private $registerDate;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="photo", type="string", length=255)
	 */
	private $photo;

	/**
	 * @Vich\UploadableField(mapping="user_images", fileNameProperty="photo")
	 * @var File
	 */
	private $imageFile;

	/**
	 * One User have Many Reservations
	 * 
	 * @var Reservation
	 *
	 * @ORM\OneToMany(targetEntity="Reservation", mappedBy="user")
	 * 
	 */
	private $reservations;

	/**
	 * User can have many hobbies
	 * @var Hobby
	 * 
	 * @ORM\OneToMany(targetEntity="Hobby", mappedBy="user")
	 * 
	 */
	private $hobbies;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="user")
	 */
	private $comments;

	public function __construct() {
		$this->reservations = new ArrayCollection();
		$this->hobbies = new ArrayCollection();
		$this->comments = new ArrayCollection();
		$this->registerDate=new DateTime();
	}

	public function __toString() {
		return $this->getPseudo() . ' (toString Method)';
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
	 * Set gender
	 *
	 * @param string $gender
	 *
	 * @return User
	 */
	public function setGender($gender) {
		$this->gender = $gender;

		return $this;
	}

	/**
	 * Get gender
	 *
	 * @return string
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Set firstname
	 *
	 * @param string $firstname
	 *
	 * @return User
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;

		return $this;
	}

	/**
	 * Get firstname
	 *
	 * @return string
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * Set lastname
	 *
	 * @param string $lastname
	 *
	 * @return User
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;

		return $this;
	}

	/**
	 * Get lastname
	 *
	 * @return string
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * Set pseudo
	 *
	 * @param string $pseudo
	 *
	 * @return User
	 */
	public function setPseudo($pseudo) {
		$this->pseudo = $pseudo;

		return $this;
	}

	/**
	 * Get pseudo
	 *
	 * @return string
	 */
	public function getPseudo() {
		return $this->pseudo;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 *
	 * @return User
	 */
	public function setEmail($email) {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 *
	 * @return User
	 */
	public function setPassword($password) {
		$this->password = $password;

		return $this;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Set birthdate
	 *
	 * @param DateTime $birthdate
	 *
	 * @return User
	 */
	public function setBirthdate($birthdate) {
		$this->birthdate = $birthdate;

		return $this;
	}

	/**
	 * Get birthdate
	 *
	 * @return DateTime
	 */
	public function getBirthdate() {
		return $this->birthdate;
	}

	/**
	 * Set address
	 *
	 * @param string $address
	 *
	 * @return User
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
	 * @return User
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
	 * Set role
	 *
	 * @param string $role
	 *
	 * @return User
	 */
	public function setRole($role) {
		$this->role = $role;

		return $this;
	}

	/**
	 * Get role
	 *
	 * @return string
	 */
	public function getRole() {
		return $this->role;
	}

	/**
	 * Set registerDate
	 *
	 * @param DateTime $registerDate
	 *
	 * @return User
	 */
	public function setRegisterDate($registerDate) {
		$this->registerDate = $registerDate;

		return $this;
	}

	/**
	 * Get registerDate
	 *
	 * @return DateTime
	 */
	public function getRegisterDate() {
		return $this->registerDate;
	}

	/**
	 * Set photo
	 *
	 * @param string $photo
	 *
	 * @return User
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
	 * @return ArrayCollection
	 */
	public function getReservations() {
		return $this->reservations;
	}

	/**
	 * 
	 * @return ArrayCollection
	 */
	public function getHobbies() {
		return $this->hobbies;
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
	 * @param \AppBundle\Entity\Reservation $reservations
	 * @return \AppBundle\Entity\User
	 */
	public function setReservations(Reservation $reservations) {
		$this->reservations = $reservations;
		return $this;
	}

	/**
	 * 
	 * @param \AppBundle\Entity\Hobby $hobbies
	 * @return \AppBundle\Entity\User
	 */
	public function setHobbies(Hobby $hobbies) {
		$this->hobbies = $hobbies;
		return $this;
	}

	/**
	 * 
	 * @param ArrayCollection
	 * @return \AppBundle\Entity\User
	 */
	public function setComments(ArrayCollection $comments) {
		$this->comments = $comments;
		return $this;
	}

	public function getCity() {
		return $this->city;
	}

	public function setCity($city) {
		$this->city = $city;
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

	/**
	 * 
	 * @return 
	 */
	public function getImageFile() {
		return $this->imageFile;
	}

}
