<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Score;
use Doctrine\ORM\EntityRepository;

/**
 * Class ScoreRepository
 * @package AppBundle\Repository
 */
class ScoreRepository extends EntityRepository
{
    use Persist;
}
