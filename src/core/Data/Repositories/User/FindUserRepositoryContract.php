<?php

namespace Core\Data\Repositories\User;

use Core\Data\Repositories\User\FindUserRepositoryInputDto;
use Core\Domain\Entities\UserEntity;

interface FindUserRepositoryContract
{
    public function findOne(FindUserRepositoryInputDto $data): null|UserEntity;
}
