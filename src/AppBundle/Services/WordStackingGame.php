<?php
declare(strict_types=1);

namespace AppBundle\Services;

use AppBundle\Exception\WordDoesNotExistException;
use AppBundle\Exception\WordDoesNotSuitPatternException;
use AppBundle\Exception\WordWasWrittenBeforeException;
use AppBundle\Helper\StringTools;
use AppBundle\Entity\Dictionary;

/**
 * Class WordStackingGame
 * @package AppBundle\Services
 */
class WordStackingGame
{

    /**
     * @var WordStackingGameplay
     */
    private $play;
    /**
     * @var DictionaryFinder
     */
    private $dictionaryFinder;

    /**
     * WordStackingGame constructor.
     * @param DictionaryFinder $dictionaryFinder
     * @param WordStackingGameplay $play
     */
    public function __construct(DictionaryFinder $dictionaryFinder, WordStackingGameplay $play)
    {
        $this->dictionaryFinder = $dictionaryFinder;
        $this->play = $play;
    }

    /**
     * @return string
     */
    public function start(): string
    {
        if ($wordId = $this->play->getChallenge()) {
            $word = $this->dictionaryFinder->findById($wordId);
        } else {
            $word = $this->getRandomWord();
        }
        $this->play->clear();
        $this->play->setBaseWord($word);

        return $word->getWord();
    }

    /**
     * @param string $word
     * @return string
     */
    public function check(string $word): string
    {
        $this->validate($word);

        $this->play->addWord($word);

        return $word;
    }

    /**
     * @return Dictionary
     */
    protected function getRandomWord(): Dictionary
    {
        return $this->dictionaryFinder->getRandom(12);
    }


    /**
     * @param string $word
     * @throws WordDoesNotExistException
     * @throws WordDoesNotSuitPatternException
     * @throws WordWasWrittenBeforeException
     */
    protected function validate(string $word)
    {
        if (!$this->dictionaryFinder->find($word)) {
            throw new WordDoesNotExistException();
        }
        if (!$this->compareWords($word)) {
            throw new WordDoesNotSuitPatternException();
        }
        if (!$this->wasWrittenBefore($word)) {
            throw new WordWasWrittenBeforeException();
        }
    }

    /**
     * @param string $word
     * @param string|null $pattern
     * @return null|string
     */
    protected function compareWords(string $word): ?string
    {
        $pattern = $this->play->getBaseWordName();
        $newWordCharsArray = StringTools::mbCountChars($word);
        $patternWordCharsArray = StringTools::mbCountChars($pattern);
        foreach ($newWordCharsArray as $letter => $occurence) {
            if (!array_key_exists($letter, $patternWordCharsArray)) {
                return null;
            }
            if ($occurence > $patternWordCharsArray[$letter]) {
                return null;
            }
        }
        return $word;
    }

    /**
     * @param string $word
     * @return string
     */
    protected function wasWrittenBefore(string $word): ?string
    {
        $list = $this->play->getWords();
        if (!in_array($word, $list)) {
            return $word;
        } else {
            return null;
        }
    }
}
