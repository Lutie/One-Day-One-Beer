<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait AuthorTrait
{

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min=3, max=100)
     */
    private $author;

    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

}