<?php

namespace App\Entity;

use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasUpdatedAtTrait;
use App\Entity\Traits\HasDeletedAtTrait;
use App\Entity\Traits\HasCreatedAtTrait;
use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 * @ORM\Table("comment")
 */
class Comment
{
    use HasIdTrait, HasCreatedAtTrait, HasDeletedAtTrait, HasUpdatedAtTrait;

    /**
     * @ORM\Column(type="integer")
     */
    private $pageId;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textComment;

    public function getPageId(): int
    {
        return $this->pageId;
    }

    public function setPageId(int $pageId): self
    {
        $this->pageId = $pageId;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;
        return $this;
    }

    public function getTextComment(): string
    {
        return $this->textComment;
    }

    public function setTextComment(string $textComment): self
    {
        $this->textComment = $textComment;
        return $this;
    }
}
