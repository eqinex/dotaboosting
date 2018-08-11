<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $number = random_int(0, 100);

        return $this->render('dashboard/index.html.twig', [
            'number' => $number
        ]);
    }
    /**
     * @Route("/dota", name="dota_page")
     */
    public function dotaPageAction()
    {
        $heroes = [
          'riki',
          'sven',
          'shaman'
        ];

        return $this->render('dota/list.html.twig', [
            'heroes' => $heroes
        ]);
    }
}