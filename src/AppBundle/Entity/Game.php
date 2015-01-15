<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateOfGame", type="datetime")
     */
    private $dateOfGame;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateOfGame
     *
     * @param \DateTime $dateOfGame
     * @return Game
     */
    public function setDateOfGame($dateOfGame)
    {
        $this->dateOfGame = $dateOfGame;

        return $this;
    }

    /**
     * Get dateOfGame
     *
     * @return \DateTime 
     */
    public function getDateOfGame()
    {
        return $this->dateOfGame;
    }
}
