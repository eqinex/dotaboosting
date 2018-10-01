<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\RepositoryAwareTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    use RepositoryAwareTrait;

    /**
     * @Route("/profile", name="profile")
     */
    public function detailsAction(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('profile/index.html.twig');
    }
}