<?php
/**
 * @todo 
 * - delete attribut pseudo ? already have usename in fos user model 
 * - delete email and password in this class 
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=10)
     *
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
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=45, nullable=true)
     * 
     * @Assert\Length(
     *          max=45, 
     *          maxMessage ="Your pseudo cannot be longer than {{ limit }} characters."
     * )
     */
    private $pseudo;

    
# Your My\MyBundle\Entity\User extends FOS\UserBundle\Entity\User, which in turn extends 
#FOS\UserBundle\Model\User, which already has a $username field. It also has an $email 
#field. So you simply need to remove the $username and $email fields from your class.
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
    # protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *          min=6,
     *          minMessage = "Password may have less {{ limit }} characters.")
     */
    # protected $password;

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
     * @ORM\Column(name="zip", type="string", length=10)
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=10)
     * 
     */
    private $zip;
    
    /**
     * @ORM\Column(name="city", type="string", nullable=true)
     * @Assert\NotBlank()
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
     * @ORM\Column(name="register_date", type="date")
     */
    private $registerDate;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    
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
    
    
    /**
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="user")
     */
    private $activities;
    
    
    
    
    
    
    public function __construct() {
        # For FOSUserBundle 
        parent::__construct();
        
        $this->reservations = new ArrayCollection();
        $this->hobbies = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->registerDate = new DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return User
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set birthdate
     *
     * @param DateTime $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return User
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set registerDate
     *
     * @param DateTime $registerDate
     *
     * @return User
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return DateTime
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
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
    
    /**
     * 
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    
    /**
     * 
     * @param type $city
     * 
     */
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }
    
    
    public function getCompany() {
        return $this->company;
    }

    public function getCommercialRegistry() {
        return $this->commercialRegistry;
    }

    public function getActivities() {
        return $this->activities;
    }

    public function setCompany($company) {
        $this->company = $company;
        return $this;
    }

    public function setCommercialRegistry($commercialRegistry) {
        $this->commercialRegistry = $commercialRegistry;
        return $this;
    }

    public function setActivities(ArrayCollection $activities) {
        $this->activities = $activities;
        return $this;
    }






    
    
}

