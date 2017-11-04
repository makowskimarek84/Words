<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * Trait Persist
 * @package AppBundle\Repository
 */
trait Persist
{

    /**
     * @param $object
     */
    public function persist($object)
    {
        $this->_em->persist($object);
    }

    /**
     * @param null $object
     */
    public function flush($object = null)
    {
        $this->_em->flush($object);
    }
}
