<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Dictionary
 *
 * @ORM\Table(name="dictionary")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DictionaryRepository")
 */
class Dictionary
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private $word;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     */
    private $sorted;
    
    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $lenght;
    
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Score", mappedBy="word")
     */
    private $score;

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
     * Set word
     *
     * @param string $word
     *
     * @return Dictionary
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set sorted
     *
     * @param string $sorted
     *
     * @return Dictionary
     */
    public function setSorted($sorted)
    {
        $this->sorted = $sorted;

        return $this;
    }

    /**
     * Get sorted
     *
     * @return string
     */
    public function getSorted()
    {
        return $this->sorted;
    }
    
    /**
     * Set lenght
     *
     * @param integer $lenght
     *
     * @return Dictionary
     */
    public function setLenght($lenght)
    {
        $this->lenght = $lenght;

        return $this;
    }

    /**
     * Get lenght
     *
     * @return int
     */
    public function getLenght()
    {
        return $this->lenght;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->score = new ArrayCollection();
    }

    /**
     * Add score
     *
     * @param Score $score
     *
     * @return Dictionary
     */
    public function addScore(Score $score)
    {
        $this->score[] = $score;

        return $this;
    }

    /**
     * Remove score
     *
     * @param Score $score
     */
    public function removeScore(Score $score)
    {
        $this->score->removeElement($score);
    }

    /**
     * Get score
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScore()
    {
        return $this->score;
    }
}
