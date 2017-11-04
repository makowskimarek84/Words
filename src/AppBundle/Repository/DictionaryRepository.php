<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\DBAL\Statement;
use AppBundle\Entity\Dictionary;
use Doctrine\ORM\EntityRepository;

/**
 * Class DictionaryRepository
 * @package AppBundle\Repository
 */
class DictionaryRepository extends EntityRepository
{
    use Persist;

    /**
     * @param string $word
     * @return Dictionary|null
     */
    public function findByWord(string $word):?Dictionary
    {
        $qb = $this->createQueryBuilder('w');
        $qb->andWhere($qb->expr()->eq('w.word', ':word'));
        $qb->setParameter('word', $word);
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param int $lenght
     * @return Dictionary
     */
    public function findRandom(int $lenght):Dictionary
    {
        $conn = $this->_em->getConnection();
        $sql = 'SELECT id FROM `dictionary` WHERE lenght = ? ORDER BY RAND() LIMIT 1 ';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $lenght);
        $stmt->execute();
        $wordId = $stmt->fetchColumn(0);
        return $this->find($wordId);
    }

    /**
     * @return Statement
     */
    public function getAllScored(): Statement
    {
        $conn = $this->_em->getConnection();
        $sql = '
            SELECT dictionary.word, dictionary.id, topscore.max as topScore, topscore.count as scores, score.nickname 
            FROM `dictionary` 
            INNER JOIN (
                SELECT s.word_id, max(s.score) as max, count(s.score) as count
                FROM score s
                GROUP BY s.word_id
            ) as topscore ON topscore.word_id = dictionary.id
            LEFT JOIN score ON score.word_id = dictionary.id AND topscore.max = score.score
            ORDER BY scores DESC, topScore DESC';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
