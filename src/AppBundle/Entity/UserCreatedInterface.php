<?php
namespace AppBundle\Entity;

use AppBundle\Entity\Security\User;

/**
 * Interface UserCreatedInterface
 * @package AppBundle\Entity
 */
interface UserCreatedInterface
{
    /**
     * @return User
     */
    public function getCreatedBy();

    /**
     * @param User $createdBy
     * @return $this
     */
    public function setCreatedBy(User $createdBy);
}
