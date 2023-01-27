<?php

namespace app\controllers;

use app\services\Delivery;

class ApiController extends AbstractController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function calcDeliveryCost(): string
    {
        if (!isset($this->request->fromAddress) || empty($this->request->fromAddress)) {
            throw new \Exception('fromAddress not found!');
        }

        if (!isset($this->request->toAddress) || empty($this->request->toAddress)) {
            throw new \Exception('toAddress not found!');
        }

        // todo use Dependency injection
        return $this->response->json(
            (new Delivery())->calcDeliveryCost(
                $this->request->fromAddress,
                $this->request->toAddress
            )
        );
    }

    /**
     * @return string
     */
    public function createOrder(): string
    {
        return $this->response->json(
            [
                'id' => 1,
                'name' => 'Order 1',
                'from' => 'г. Минск, ул Корженевского, д 14',
                'to' => 'г. Минск, ул Якуба Колоса, д 4',
            ]
        );
    }

    /**
     * @return string
     */
    public function getOrderList(): string
    {
        return $this->response->json(
            [
                [
                    'id' => 1,
                    'name' => 'Order 1',
                ],
                [
                    'id' => 2,
                    'name' => 'Order 2',
                ],
                [
                    'id' => 3,
                    'name' => 'Order 3',
                ]
            ]
        );
    }

    /**
     * @param int $orderId
     * @return string
     */
    public function getOrder(int $orderId): string
    {
        return $this->response->json(
            [
                'id' => $orderId,
                'name' => 'Order 1',
                'from' => 'г. Минск, ул Корженевского, д 14',
                'to' => 'г. Минск, ул Якуба Колоса, д 4',
            ]
        );
    }
}