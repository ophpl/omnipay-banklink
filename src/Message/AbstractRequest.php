<?php

namespace Omnipay\Banklink\Message;

use RKD\Banklink;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Get seller id.
     *
     * @return string seller id
     */
    public function getSellerId()
    {
        return $this->getParameter('sellerId');
    }

    /**
     * Set seller id.
     *
     * @param string $value seller id
     *
     * @return $this
     */
    public function setSellerId($value)
    {
        return $this->setParameter('sellerId', $value);
    }

    /**
     * Get seller name.
     *
     * @return string seller name
     */
    public function getSellerName()
    {
        return $this->getParameter('sellerName');
    }

    /**
     * Set seller name.
     *
     * @param string $value seller name
     *
     * @return $this
     */
    public function setSellerName($value)
    {
        return $this->setParameter('sellerName', $value);
    }

    /**
     * Get seller account.
     *
     * @return string seller account
     */
    public function getSellerAccount()
    {
        return $this->getParameter('sellerAccount');
    }

    /**
     * Set seller account.
     *
     * @param string $value seller account
     *
     * @return $this
     */
    public function setSellerAccount($value)
    {
        return $this->setParameter('sellerAccount', $value);
    }

    /**
     * Get public key, path to file or key string.
     *
     * @return string public key
     */
    public function getPublicKey()
    {
        return $this->getParameter('publicKey');
    }

    /**
     * Set public key, path to file or key string.
     *
     * @param string $value public key
     *
     * @return $this
     */
    public function setPublicKey($value)
    {
        return $this->setParameter('publicKey', $value);
    }

    /**
     * Get private key, path to file or key string.
     *
     * @return string private key
     */
    public function getPrivateKey()
    {
        return $this->getParameter('privateKey');
    }

    /**
     * Set private key, path to file or key string.
     *
     * @param string $value private key
     *
     * @return $this
     */
    public function setPrivateKey($value)
    {
        return $this->setParameter('privateKey', $value);
    }

    /**
     * Get private key password.
     *
     * @return string private key password
     */
    public function getPrivateKeyPassword()
    {
        return $this->getParameter('privateKeyPassword');
    }

    /**
     * Set private key password.
     *
     * @param string $value private key password
     *
     * @return $this
     */
    public function setPrivateKeyPassword($value)
    {
        return $this->setParameter('privateKeyPassword', $value);
    }

    /**
     * Get provider.
     *
     * @return string provider
     */
    public function getProvider()
    {
        return $this->getParameter('provider');
    }

    /**
     * Set provider.
     *
     * @param string $value provider
     *
     * @return $this
     */
    public function setProvider($value)
    {
        return $this->setParameter('provider', $value);
    }

    /**
     * Get locale.
     *
     * @return string locale
     */
    public function getLocale()
    {
        return $this->getParameter('locale');
    }

    /**
     * Set locale.
     *
     * @param string $value locale
     *
     * @return $this
     */
    public function setLocale($value)
    {
        return $this->setParameter('locale', $value);
    }

    /**
     * Get language, if not set fallback to locale.
     *
     * @return string language
     */
    public function getLanguage()
    {
        $language = $this->getParameter('language');

        if (empty($language)) {
            $locale = $this->getLocale();

            if (empty($locale)) {
                return '';
            }

            // convert to IETF locale tag if other style is provided and then get first part, primary language
            $language = strtok(str_replace('_', '-', $locale), '-');
        }

        return strtolower($language);
    }

    /**
     * Set language.
     *
     * @param string $value language
     *
     * @return $this
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    protected function getClient()
    {
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

        return $provider;
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
