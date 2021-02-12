<?php

namespace App\Entity\Traits;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

trait HasDeletedAtTrait
{
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Type(DateTimeImmutable::class)
     */
    private $deletedAt;

    public function getDeletedAt(): \DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTimeImmutable $deletedAt = null): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function isDeleted(): bool
    {
        return null !== $this->deletedAt;
    }
}
