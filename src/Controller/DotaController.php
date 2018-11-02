<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DotaController extends AbstractController
{
    /**
     * @Route("/dota/boost-orders", name="dota_boost_list")
     */
    public function boostListAction(Request $request)
    {

        return $this->render('dota/list.html.twig');
    }
}