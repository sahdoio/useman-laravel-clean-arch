<?php

declare(strict_types=1);

namespace Core\Domain\Entities;

use Core\Domain\Entities\Contracts\EntityContract;
use DateTimeInterface;
use RuntimeException;

abstract class Entity implements EntityContract
{
    /**
     * @param array $data
     */
    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            if ($value === null) {
                unset($data[$key]);
            }
        }

        foreach ($data as $attribute => $value) {
            $setter = 'set' . str_replace('_', '', ucwords($attribute, '_'));

            if (!method_exists($this, $setter)) {
                continue;
            }

            $this->$setter($value);
        }
    }

    /**
     * Output an array based on entity properties
     * @param bool $toSnakeCase
     * @return array
     */
    public function toArray(bool $toSnakeCase = false): array
    {
        $props = [];
        $propertyList = get_object_vars($this);

        foreach ($propertyList as $prop => $value) {
            if ($value instanceof DateTimeInterface) {
                $propertyList[$prop] = $value->format(DATE_ATOM);
            }
        }

        $propertyList = json_decode(json_encode($propertyList), true);

        foreach ($propertyList as $name => $value) {
            if ($toSnakeCase) {
                $name = mb_strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
            }

            $props[$name] = $value;
        }

        return $props;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

	/**
	 * __get
	 *
	 * @param string $property
	 * 
	 * @return mixed
	 * 
	 */
	public function __get(string $property): mixed
	{
		if (!property_exists($this, $property)) {
			throw new RuntimeException(sprintf("Invalid Property '%s'", $property));
		}

		return $this->{$property};
	}

	/**
	 * __set
	 *
     * @param string $key
     * @param mixed $value
	 * 
	 * @return void
	 * 
	 */
	public function __set(string $property, mixed $value): void
	{
		if (!property_exists($this, $property)) {
			throw new RuntimeException(sprintf("Invalid Property '%s'", $property));
		}

		$this->{$property} = $value;
	}
}
