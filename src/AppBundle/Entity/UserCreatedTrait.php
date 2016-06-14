<?php
namespace AppBundle\Entity;

use AppBundle\Entity\Security\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class UserCreatedTrait
 * @package AppBundle\Entity
 */
trait UserCreatedTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Security\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id", nullable=true)
     */
    protected $createdBy;

    /**
     * {@inheritdoc}
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedBy(User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
