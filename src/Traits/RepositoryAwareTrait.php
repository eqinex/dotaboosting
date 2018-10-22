<?php

namespace App\Traits;

use App\Entity\User;
use App\Repository\UserRepository;

trait RepositoryAwareTrait
{
    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @return UserRepository
     */
    protected function getUserRepository()
    {
        return $this->getDoctrine()->getRepository(User::class);
    }
}