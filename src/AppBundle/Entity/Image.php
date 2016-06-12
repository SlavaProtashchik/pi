<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Image
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="image")
 *
 * @method $this setId($value)
 */
class Image
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $pathName;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Image
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set pathName
     *
     * @param string $pathName
     *
     * @return Image
     */
    public function setPathName($pathName)
    {
        $this->pathName = $pathName;

        return $this;
    }

    /**
     * Get pathName
     *
     * @return string
     */
    public function getPathName()
    {
        return $this->pathName;
    }
}
