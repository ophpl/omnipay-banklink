<?php

namespace Omnipay\Banklink\Message;

class PurchaseRequest extends AbstractRequest
{
    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        $this->validate(
            'amount',
            'currency',
            'description',
            'returnUrl',
            'cancelUrl'
        );

        $client = $this->getClient();

        // API needs an integer, so generate random integer, field max allowed length is 20
        $id = (int) hrtime(true);

        $request = $client->getPaymentRequest(
            $id,
            floatval($this->getAmount()),
            $this->getDescription(),
            $this->langToISO6392($this->getLanguage()),
            $this->getCurrency(),
            [
                'VK_CANCEL' => $this->getCancelUrl(),
            ]
        );

        return [
            'id' => $id,
            'url' => $request->getRequestUrl(),
            'data' => $request->getRequestData(),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
