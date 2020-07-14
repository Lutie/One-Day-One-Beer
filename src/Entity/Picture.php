<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pictures")
 * @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
 */
class Picture
{

    use IdTrait;

    use NameTrait;

    use DescriptionTrait;

    use DateTrait;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(min=3, max=100)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

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

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

}