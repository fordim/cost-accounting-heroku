<?php

namespace App\Entity\Traits;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

trait HasCreatedAtTrait
{
    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     * @Serializer\Type(DateTimeImmutable::class)
     */
    private $createdAt;

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
