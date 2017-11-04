<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Dictionary;

/**
 * Dictionary
 *
 * @ORM\Table(name="score")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScoreRepository")
 */
class Score
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
     * @ORM\ManyToOne(targetEntity="Dictionary", inversedBy="word")
     */
    private $word;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=false, nullable=false)
     */
    private $nickname;
    
    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $score;

    

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
     * Set nickname
     *
     * @param string $nickname
     *
     * @return Score
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return Score
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set word
     *
     * @param Dictionary $word
     *
     * @return Score
     */
    public function setWord(Dictionary $word = null)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return \AppBundle\Entity\Dictionary
     */
    public function getWord()
    {
        return $this->word;
    }
}
