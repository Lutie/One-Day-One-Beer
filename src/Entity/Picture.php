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
     * @Assert\File(
     *     maxSize = "3000k",
     *     mimeTypes = {"image/jpeg", "image/png"},
     *     mimeTypesMessage = "Veuillez déposer une image (jpg ou png) valide (3mo maximum)"
     * )
     */
    private $file_upload;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="boolean")
     */
    private $validated = false;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->validate = false;
    }

    /**
     * @param string
     */
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

    /**
     * @param string
     */
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

    /**
     * @return mixed
     */
    public function getFileUpload()
    {
        return $this->file_upload;
    }

    /**
     * @param mixed $standard_file_upload
     */
    public function setFileUpload($file_upload): void
    {
        $this->file_upload = $file_upload;
    }

    /**
     * @param boolean
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getValidated()
    {
        return $this->validated;
    }

}