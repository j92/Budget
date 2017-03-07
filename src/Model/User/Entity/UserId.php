<?php

namespace BudgetTool\Model\User\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UserId
{
    /** @var UuidInterface */
    private $id;

    public static function fromString(string $id)
    {
        return new self(Uuid::fromString($id));
    }

    /**
     * @return UserId
     */
    public static function generate(): UserId
    {
        return new self(Uuid::uuid4());
    }

    /**
     * UserId constructor.
     * @param UuidInterface $id
     */
    private function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function toString(): string 
    {
        return $this->id->toString();
    }
}