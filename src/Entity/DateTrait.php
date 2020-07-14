<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait DateTrait
{
    /**
     * @ORM\Column( type="datetime", nullable=true)
     * @Assert\Date()
     */
    private $date;

    /**
     * @return object \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

}