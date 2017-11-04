<?php
declare(strict_types=1);

namespace AppBundle\Services;

use \Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Statement;
use AppBundle\Entity\Dictionary as DictionaryEntity;

/**
 * Class DictionaryFinder
 * @package AppBundle\Services
 */
class DictionaryFinder
{

    /**
     * @var EntityRepository
     */
    private $dictionaryRepository;

    /**
     * DictionaryFinder constructor.
     * @param EntityRepository $dictionaryRepository
     */
    public function __construct(EntityRepository $dictionaryRepository)
    {
        $this->dictionaryRepository = $dictionaryRepository;
    }

    /**
     * @param string $word
     * @return DictionaryEntity
     */
    public function find(string $word): ?DictionaryEntity
    {
        return $this->dictionaryRepository->findByWord($word);
    }

    /**
     * @param int $id
     * @return DictionaryEntity
     */
    public function findById(int $id): DictionaryEntity
    {
        return $this->dictionaryRepository->find($id);
    }

    /**
     * @param int $lenght
     * @return DictionaryEntity
     */
    public function getRandom(int $lenght): DictionaryEntity
    {
        return $this->dictionaryRepository->findRandom($lenght);
    }

    /**
     * @return Statement
     */
    public function getAllScored(): Statement
    {
        return $this->dictionaryRepository->getAllScored();
    }
}
