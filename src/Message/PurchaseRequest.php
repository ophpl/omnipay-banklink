<?php

namespace Omnipay\Banklink\Message;

use RKD\Banklink;

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

        $protocol = new Banklink\Protocol\IPizza(
            $this->getSellerId(),
            $this->getPrivateKey(),
            $this->getPrivateKeyPassword(),
            $this->getPublicKey(),
            $this->getReturnUrl(),
            $this->getSellerName(),
            $this->getSellerAccount()
        );

        $provider = $this->getProviderBanklink($protocol, $this->getProvider());

        if ($this->getTestMode()) {
            $provider->debugMode();
        }

        // API needs an integer, so generate random integer, field max allowed length is 20
        $id = (int) hrtime(true);

        $request = $provider->getPaymentRequest(
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

    protected function getProviderBanklink($protocol, $provider)
    {
        switch ($provider) {
            case 'seb.ee':
                return new Banklink\EE\SEB($protocol);
        }

        throw new \InvalidArgumentException(sprintf('provider %s not supported', $provider));
    }

    /**
     * Convert ISO-639-1 language code to ISO-639-2.
     *
     * @param string $language ISO-639-1 language code
     *
     * @return string ISO-639-2 language code
     */
    protected function langToISO6392(string $language)
    {
        $languages = [
            'en' => 'eng',
            'et' => 'est',
            'ru' => 'rus',
            'lv' => 'lat',
            'lt' => 'lit',
            'fi' => 'fin',
            'de' => 'deu',
        ];

        $language = strtolower($language);

        if (array_key_exists($language, $languages)) {
            return strtoupper($languages[$language]);
        }

        return 'ENG';
    }
}
