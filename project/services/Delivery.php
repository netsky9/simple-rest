<?php

namespace app\services;

class Delivery{
    /**
     * @param string $fromAddress
     * @param string $toAddress
     * @return array
     */
    public function calcDeliveryCost(string $fromAddress, string $toAddress): array
    {
        //todo какая-то логика

        return [
            "fromAddress" => $fromAddress,
            "toAddress" => $toAddress,
            "cost" => "100 BYN"
        ];
    }
}
