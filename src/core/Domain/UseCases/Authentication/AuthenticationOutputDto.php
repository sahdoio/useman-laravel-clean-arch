<?php

declare(strict_types=1);

namespace Core\Domain\UseCases\Authentication;

use App\Core\Domain\Helpers\BaseDto;
use Core\Domain\Entities\UserEntity;

final class AuthenticationOutputDto extends BaseDto
{
    public function __construct(
        public readonly UserEntity $user
    ) {}
}