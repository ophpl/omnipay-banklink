<?php

namespace Omnipay\Banklink;

use Omnipay\Banklink\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;

/**
 * Class Gateway.
 *
 * @phan-file-suppress PhanClassContainsAbstractMethod
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Banklink';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'sellerId' => '',
            'sellerName' => '',
            'sellerAccount' => '',
            'publicKey' => '',
            'privateKey' => '',
            'privateKeyPassword' => '',
            'provider' => '',
            'testMode' => false,
        ];
    }

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
     * @return AbstractRequest|PurchaseRequest
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Banklink\Message\PurchaseRequest', $parameters);
    }
}
