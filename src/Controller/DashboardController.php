<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DashboardController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $number = random_int(0, 100);

        return new Response('Danilka ' . $number . ' boost');
    }
}