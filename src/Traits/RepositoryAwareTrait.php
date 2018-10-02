<?php

namespace App\Traits;

use App\Entity\User;
use App\Repository\UserRepository;

trait RepositoryAwareTrait
{
    /**
     * @return UserRepository
     */
    protected function getUserRepository()
    {
        return $this->getDoctrine()->getRepository(User::class);
    }
}