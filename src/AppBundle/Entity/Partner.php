<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartnerRepository")
 * @UniqueEntity(fields="email", message="This email already exists")
 * @UniqueEntity(fields="pseudo", message="This username is not available")
 * @UniqueEntity(fields="commercialRegistry", message="This commercial registry is already used")
 */
class Partner {

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
	 * @ORM\Column (type="string", name="company", length=100)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 3,
	 *      max = 100,
	 *      minMessage = "Your company name must be at least {{ limit }} characters long",
	 *      maxMessage = "Your company name cannot be longer than {{ limit }} characters"
	 * )
	 */
	private $company;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="firstname", type="string", length=45)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 3,
	 *      max = 45,
	 *      minMessage = "Your contact firstname must be at least {{ limit }} characters long",
	 *      maxMessage = "Your contact firstname cannot be longer than {{ limit }} characters"
	 * )
	 */
	private $firstname;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="lastname", type="string" , length=45)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 3,
	 *      max = 45,
	 *      minMessage = "Your contact lastname must be at least {{ limit }} characters long",
	 *      maxMessage = "Your contact lastname cannot be longer than {{ limit }} characters"
	 * )
	 */
	private $lastname;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="pseudo", type="string", length=45)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 3,
	 *      max = 45,
	 *      minMessage = "Your login must be at least {{ limit }} characters long",
	 *      maxMessage = "Your login cannot be longer than {{ limit }} characters"
	 * )
	 */
	private $pseudo;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="email", type="string", length=45, unique=true)
	 * @Assert\NotBlank()
	 * @Assert\Email(
	 *     message = "The email '{{ value }}' is not a valid email.",
	 *     checkMX = true
	 * )
	 */
	private $email;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="password", type="string")
	 * 
	 */
	private $password;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="commercial_registry", type="string", length=9, unique=true)
	 * @Assert\NotBlank()
	 * @Assert\Regex(
	 *     pattern="/^[0-9]$/",
	 *     match=true,
	 *     message="Your commercial registry must contain numbers only"
	 * )
	 * @Assert\Length(
	 *      min = 9,
	 *      max = 9,
	 *      exactMessage = "This value should have exactly {{ limit }} characters."
	 * )
	 */
	private $commercialRegistry;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="address", type="string", length=250)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 5,
	 *      max = 250,
	 *      minMessage = "Your address must be at least {{ limit }} characters long",
	 *      maxMessage = "Your address cannot be longer than {{ limit }} characters"
	 * )
	 */
	private $address;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="zip", type="string", length=5)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 5,
	 *      max = 5,
	 *      exactMessage = "This value should have exactly {{ limit }} characters."
	 * )
	 */
	private $zip;

	/**
	 *
	 * @var string
	 * @ORM\Column (name="city", type="string", length=100)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *      min = 5,
	 *      max = 250,
	 *      minMessage = "The city must be at least {{ limit }} characters long",
	 *      maxMessage = "The city cannot be longer than {{ limit }} characters"
	 * )
	 */
	private $city;

	/**
	 *
	 * @var DateTime
	 * //ORM\Column (name="register_date", type="datetime")
	 */
	private $registerDate;

	/**
	 *
	 * @var string
	 * @Assert\NotBlank()
	 * @Assert\Length(min=6)
	 */
	private $plainPassword; //password en clair, pas encore encrypté

	/**
	 *
	 * @var ArrayCollection
	 * //ORM\OneToMany(targetEntity="Activity", mappedBy="partner")
	 */
	private $activities;

	function __construct() {
		$this->activities = new ArrayCollection();
		$this->registerDate=new DateTime();
	}

	function __toString() {
		return $this->getCompany() . ' (toString Method)';
	}

	/**
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
	public function getCompany() {
		return $this->company;
	}

	/**
	 * 
	 * @return string
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * 
	 * @return string
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * 
	 * @return string
	 */
	public function getPseudo() {
		return $this->pseudo;
	}

	/**
	 * 
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * 
	 * @return string
	 */
	public function getCommercialRegistry() {
		return $this->commercialRegistry;
	}

	/**
	 * 
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * 
	 * @return string
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * 
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * 
	 * @return DateTime
	 */
	public function getRegisterDate() {
		return $this->registerDate;
	}

	/**
	 * 
	 * @param int $id
	 * @return $this
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	/**
	 * 
	 * @param string $company
	 * @return $this
	 */
	public function setCompany($company) {
		$this->company = $company;
		return $this;
	}

	/**
	 * 
	 * @param string $firstname
	 * @return $this
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
		return $this;
	}

	/**
	 * 
	 * @param string $lastname
	 * @return $this
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
		return $this;
	}

	/**
	 * 
	 * @param string $pseudo
	 * @return $this
	 */
	public function setPseudo($pseudo) {
		$this->pseudo = $pseudo;
		return $this;
	}

	/**
	 * 
	 * @param string $email
	 * @return $this
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/**
	 * 
	 * @param string $commercialRegistry
	 * @return $this
	 */
	public function setCommercialRegistry($commercialRegistry) {
		$this->commercialRegistry = $commercialRegistry;
		return $this;
	}

	/**
	 * 
	 * @param string $address
	 * @return $this
	 */
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

	/**
	 * 
	 * @param string $zip
	 * @return $this
	 */
	public function setZip($zip) {
		$this->zip = $zip;
		return $this;
	}

	/**
	 * 
	 * @param string $city
	 * @return $this
	 */
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}

	/**
	 * 
	 * @param DateTime $registerDate
	 * @return $this
	 */
	public function setRegisterDate(DateTime $registerDate) {
		$this->registerDate = $registerDate;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * 
	 * @return string
	 */
	public function getPlainPassword() {
		return $this->plainPassword;
	}

	/**
	 * 
	 * @param string $password
	 * @return $this
	 */
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}

	/**
	 * 
	 * @param string $plainPassword
	 * @return $this
	 */
	public function setPlainPassword($plainPassword) {
		$this->plainPassword = $plainPassword;
		return $this;
	}

	/**
	 * 
	 * @param ArrayCollection $activities
	 * @return $this
	 */
	public function setActivities(ArrayCollection $activities) {
		$this->articles = $activities;
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
