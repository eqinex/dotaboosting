<?php

namespace App\Controller;

use App\Traits\RepositoryAwareTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DotaController extends AbstractController
{

    use RepositoryAwareTrait;
    const PER_PAGE = 20;

    /**
     * @Route("/dota/boost-orders", name="dota_boost_list")
     */
    public function boostListAction(Request $request)
    {
        $filters = $request->get('filters', []);
        $currentPage = $request->get('page', 1);

        $orders = $this->getDotaBoostOrderRepository()->getAvailableOrders($filters, $currentPage, self::PER_PAGE);

        return $this->render('dota/list.html.twig', [
            'orders' => $orders
        ]);
    }
}