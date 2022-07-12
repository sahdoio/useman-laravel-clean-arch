<?php

namespace Core\Domain\Entities\Contracts;

use Core\Domain\Entities\Entity;
use JsonSerializable;

interface EntityContract extends JsonSerializable
{
    public function fill(array $data);
    public function toArray(bool $toSnakeCase = false): array;
    public function jsonSerialize(): array;
}
