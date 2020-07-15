<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait NameTrait
{

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\Type("string")
     * @Assert\Length(min=10, max=100)
     */
    private $name;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}