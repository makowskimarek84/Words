<?php
declare(strict_types=1);

namespace AppBundle\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use AppBundle\Entity\Dictionary;
use AppBundle\Repository\DictionaryRepository;

/**
 * Class WordStackingGameplay
 * @package AppBundle\Services
 */
class WordStackingGameplay
{

    /**
     * @var SessionInterface
     */
    private $session;
    /**
     * @var DictionaryRepository
     */
    private $dictionaryRepository;

    /**
     * WordStackingGameplay constructor.
     * @param DictionaryRepository $dictionaryRepository
     * @param SessionInterface $session
     */
    public function __construct(DictionaryRepository $dictionaryRepository, SessionInterface $session)
    {
        $this->session = $session;
        $this->dictionaryRepository = $dictionaryRepository;
    }

    /**
     * @param Dictionary $word
     * @return Dictionary
     */
    public function setBaseWord(Dictionary $word): Dictionary
    {
        $this->session->set('word.name', $word->getWord());
        $this->session->set('word.id', $word->getId());

        return $word;
    }

    /**
     * @return Dictionary|null
     */
    public function getBaseWord():?Dictionary
    {
        if (!$this->session->has('word.id')) {
            return null;
        }
        return $this->dictionaryRepository->find($this->session->get('word.id'));
    }

    /**
     *
     */
    public function clear()
    {
        $this->session->remove('list');
        $this->session->remove('word.id');
        $this->session->remove('word.name');
        $this->session->remove('challenge');
    }

    /**
     * @return null|int
     */
    public function getChallenge():?int
    {
        if ($this->session->has('challenge')) {
            return (int)$this->session->get('challenge');
        }
        return null;
    }

    /**
     * @return null|string
     */
    public function getBaseWordName():?string
    {
        if (!$this->session->has('word.name')) {
            return null;
        }
        return $this->session->get('word.name');
    }

    /**
     * @param string $word
     * @return string
     */
    public function addWord(string $word): string
    {
        $list = $this->getWords();
        $this->session->set('list', array_merge($list, [$word]));
        return $word;
    }

    /**
     * @return array
     */
    public function getWords(): array
    {
        if (!$this->session->has('list') || !is_array($this->session->get('list'))) {
            return [];
        }
        return $this->session->get('list');
    }

    /**
     * @param int $id
     */
    public function setChallenge(int $id)
    {
        $this->session->set('challenge', $id);
    }

    /**
     * @return int|null
     */
    protected function getBaseWordId():?int
    {
        if (!$this->session->has('word.id')) {
            return null;
        }
        return (int)$this->session->get('word.id');
    }
}
