<?php

namespace App\Controller;

use App\Entity\DotaBoostOrder;
use App\Traits\RepositoryAwareTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DotaBoostController extends AbstractController
{

    use RepositoryAwareTrait;
    const PER_PAGE = 20;

    /**
     * @Route("/dota/boost-orders", name="dota_boost_orders_list")
     */
    public function listAction(Request $request)
    {
        $filters = $request->get('filters', []);
        $currentPage = $request->get('page', 1);

        $orders = $this->getDotaBoostOrderRepository()->getAvailableOrders($filters, $currentPage, self::PER_PAGE);

        return $this->render('dota/boost_orders/list.html.twig', [
            'orders' => $orders,
            'statuses' => DotaBoostOrder::getStatusesList()
        ]);
    }

    /**
     * @Route("/dota/boost-orders/new", name="add_dota_boost_order")
     */
    public function addDotaBoostOrderAction(Request $request)
    {
        $dotaBoostOrderDetails = $request->get('dotaBoostOrder');
        $user = $this->getUser();

        if (!$user) {
            return $this->redirect($request->headers->get('referer'));
        }

        /** @var DotaBoostOrder $dotaBoostOrder */
        $dotaBoostOrder = new DotaBoostOrder();

        $dotaBoostOrder = $this->buildDotaBoostOrder($dotaBoostOrder, $dotaBoostOrderDetails);

        $em = $this->getDoctrine()->getManager();
        $em->refresh($dotaBoostOrder);

        $code = $dotaBoostOrder->getId() . '.DBO';

        $dotaBoostOrder->setCode($code);
        $em->persist($dotaBoostOrder);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @param DotaBoostOrder $dotaBoostOrder
     * @param $dotaBoostOrderDetails
     * @return DotaBoostOrder
     * @throws \Exception
     */
    protected function buildDotaBoostOrder(DotaBoostOrder $dotaBoostOrder, $dotaBoostOrderDetails)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if (!$dotaBoostOrder->getId()) {
            $dotaBoostOrder
                ->setOwner($user)
                ->setCreatedAt(new \DateTime())
            ;
        }

        $dotaBoostOrder
            ->setTitle($dotaBoostOrderDetails['title'])
            ->setDescription($dotaBoostOrderDetails['description'])
        ;

        $em->persist($dotaBoostOrder);
        $em->flush();

        return $dotaBoostOrder;
    }
}