<?php

namespace Omnipay\Banklink\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\ResponseInterface;

class AcceptNotification extends AbstractRequest implements NotificationInterface
{

    /** @var \RKD\Banklink\Response\PaymentResponse */
    protected $data;

    /**
     * Initialize the object with parameters, and try to parse the notification payload.
     *
     * If any unknown parameters passed, they will be ignored.
     * If payload was parsed correctly and signature is valid, then response will contain the parsed payload data.
     *
     * @param array $parameters An associative array of parameters
     *
     * @return $this
     * @throws RuntimeException
     */
    public function initialize(array $parameters = array())
    {
        parent::initialize($parameters);

        if (!empty($this->httpRequest->get('VK_SERVICE'))) {
            $client = $this->getClient();
            $data = $client->handleResponse($this->httpRequest->request->all());

            if ($data instanceof \RKD\Banklink\Response\PaymentResponse) {
                $this->data = $data;
            }
        }

        return $this;
    }

    /**
     * Get the raw data array for this message.
     * The raw data is from the notification payload.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * There is nothing to send in order to response to this webhook.
     * The merchant site just needs to return a HTTP 200.
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionReference()
    {
        return $this->data ? $this->data->getTransactionId() : '';
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionStatus()
    {
        if (!$this->data->wasSuccessful()) {
            return NotificationInterface::STATUS_FAILED;
        }

        return NotificationInterface::STATUS_COMPLETED;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return '';
    }

}
