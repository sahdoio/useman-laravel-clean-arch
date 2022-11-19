<?php

namespace Core\Data\UseCases\Authentication;

use Core\Data\Repositories\User\FindUserRepositoryContract;
use Core\Data\Repositories\User\FindUserRepositoryInputDto;
use Core\Domain\UseCases\Authentication\AuthenticationContract;
use Core\Domain\UseCases\Authentication\AuthenticationInputDto;
use Core\Domain\UseCases\Authentication\AuthenticationOutputDto;

class Authentication implements AuthenticationContract
{
    /**
     * @param FindUserRepositoryContract $findUserRepository
     *
     */
    public function __construct(
        private readonly FindUserRepositoryContract $findUserRepository
    ) {}

    public function exec(AuthenticationInputDto $data): AuthenticationOutputDto
    {
        $user = $this->findUserRepository->findOne(new FindUserRepositoryInputDto(
            email: $data->email,
            username: $data->username
        ));

        // password validation
        // in progress ...

        $loginUcOutputData = new AuthenticationOutputDto($user);

        return $loginUcOutputData;
    }
}
