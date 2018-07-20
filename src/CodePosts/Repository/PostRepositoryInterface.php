<?php

namespace CodePress\CodePosts\Repository;

use CodePress\CodeDatabase\Contracts\RepositoryInterface;
use CodePress\CodeDatabase\Contracts\CriteriaCollectionInterface;

/**
 * Description of PostRepositoryInterface
 *
 * @author gabriel
 */
interface PostRepositoryInterface extends RepositoryInterface, CriteriaCollectionInterface
{

    public function updateState(int $id, $state);
}
