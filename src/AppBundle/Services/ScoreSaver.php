<?php
declare(strict_types=1);

namespace AppBundle\Services;

use \Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Score;

/**
 * Class ScoreSaver
 * @package AppBundle\Services
 */
class ScoreSaver
{

    /**
     * @var EntityRepository
     */
    private $scoreRepository;
    /**
     * @var WordStackingGameplay
     */
    private $play;

    /**
     * ScoreSaver constructor.
     * @param EntityRepository $scoreRepository
     * @param WordStackingGameplay $play
     */
    public function __construct(EntityRepository $scoreRepository, WordStackingGameplay $play)
    {
        $this->scoreRepository = $scoreRepository;
        $this->play = $play;
    }

    /**
     * @param string $nickname
     * @return Score
     */
    public function save(string $nickname): Score
    {
        $score = new Score();
        $score->setNickname($nickname)
            ->setScore(count($this->play->getWords()))
            ->setWord($this->play->getBaseWord());

        $this->scoreRepository->persist($score);
        $this->scoreRepository->flush($score);
        $this->play->clear();
        return $score;
    }
}
