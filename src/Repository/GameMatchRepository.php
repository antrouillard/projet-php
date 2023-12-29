<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;
use Entity\GameMatch;

/**
 * @method GameMatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameMatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameMatch[]    findAll()
 * @method GameMatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameMatchRepository extends EntityRepository
{

}
