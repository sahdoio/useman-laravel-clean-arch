<?php

namespace Core\Implementations\Repositories\User;

use Core\Data\Repositories\User\FindUserRepositoryContract;
use Core\Data\Repositories\User\FindUserRepositoryInputDto;
use Core\Domain\Entities\UserEntity;
use Core\Implementations\Repositories\BaseRepository;

class FindUserRepository extends BaseRepository implements FindUserRepositoryContract
{
    protected string $modelClass = 'User';

    public function findOne(FindUserRepositoryInputDto $data): null|UserEntity
    {
        if ($data->email) {
            $this->queryBuilder->where('email', $data->email);;
        }

        if ($data->username) {
            $this->queryBuilder->where('username', $data->username);
        }  

        return $this->queryBuilder->first();
    }
}
