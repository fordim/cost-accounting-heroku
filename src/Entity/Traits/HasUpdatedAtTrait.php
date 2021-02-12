<?php

namespace App\Entity\Traits;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

trait HasUpdatedAtTrait
{
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Type(DateTimeImmutable::class)
     */
    private $updatedAt;

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt = null): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
