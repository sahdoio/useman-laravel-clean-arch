<?php

declare(strict_types=1);

namespace Core\Domain\Entities;

final class UserEntity extends Entity
{
	/**
	 * __construct
	 *
	 * @param array $values
	 * 
	 */
	public function __construct(
        private string $name,
        private string $username,
        private string $email,
        private string $password
    )
	{}
}