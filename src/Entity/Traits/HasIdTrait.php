<?php


namespace App\Entity\Traits;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

trait HasIdTrait
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Serializer\Type("int")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    public function getId(): int
    {
        return $this->id;
    }
}
