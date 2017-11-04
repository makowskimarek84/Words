<?php
declare(strict_types=1);

namespace AppBundle\Services;

use AppBundle\Helper\StringTools;
use \Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Dictionary as DictionaryEntity;

/**
 * Class Dictionary
 * @package AppBundle\Services
 */
class Dictionary
{

    /**
     * @var EntityRepository
     */
    private $dictionaryRepository;

    /**
     * Dictionary constructor.
     * @param EntityRepository $dictionaryRepository
     */
    public function __construct(EntityRepository $dictionaryRepository)
    {
        $this->dictionaryRepository = $dictionaryRepository;
    }

    /**
     * @param string $fileName
     * @param int $offset
     * @param int $limit
     */
    public function create(string $fileName, int $offset, int $limit)
    {
        $this->parseFile($fileName, $offset, $limit);
    }

    /**
     * @param string $fileName
     * @param int $offset
     * @param int $limit
     */
    protected function parseFile(string $fileName, int $offset, int $limit)
    {
        $file = new \SplFileObject($fileName);
        $file->seek($offset);
        for ($a=0; $a<$limit; $a++) {
            if ($file->eof()) {
                break;
            }
            $word = rtrim($file->current());
            $this->makeDictionary($word);
            $file->next();
        }
        $this->dictionaryRepository->flush();
    }

    /**
     * @param string $word
     */
    protected function makeDictionary(string $word)
    {
        $dictionaryElement = new DictionaryEntity();
        $dictionaryElement->setWord($word);
        $dictionaryElement->setLenght(mb_strlen($word));
        $dictionaryElement->setSorted(StringTools::sortChars($word));
        $this->dictionaryRepository->persist($dictionaryElement);
    }
}
