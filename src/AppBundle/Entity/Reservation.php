<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Repository\ReservationRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="ReservationRepository")
 */
class Reservation
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
     * @var DateTime
     *
     * @ORM\Column(name="date", type="date")
     * 
     */
    private $date;
    
    
    /**
     * Many reservation belong One one 
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="reservations")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;
    
    
    /**
     * One reservation Many details
     * @var DetailReservation
     * 
     * @ORM\OneToMany(targetEntity="DetailReservation", mappedBy="reservation")
     * 
     */
    private $detailsReservations;
    
    public function __construct() {
        $this->detailsReservations = new ArrayCollection();
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
     * Set date
     *
     * @param DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return DateTime
     */
    public function getDate()
    {
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
     * @return DetailReservation
     */
    public function getDetailsReservations() {
        return $this->detailsReservations;
    }

    
    /**
     * 
     * @param type $user
     * @return \AppBundle\Entity\Reservation
     */
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    
    /**
     * 
     * @param \AppBundle\Entity\DetailReservation $detailsReservations
     * @return \AppBundle\Entity\Reservation
     */
    public function setDetailsReservations(DetailReservation $detailsReservations) {
        $this->detailsReservations = $detailsReservations;
        return $this;
    }
    
    


}

