<?php

namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="CategoryRepository")
 */
class Category
{
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
     * @Assert\Length(min = 100, max = 100)
     * 
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min = 100, max = 100)
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
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Category
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


    
    
    


}

