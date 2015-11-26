<?php
namespace Leanplum;

use Guzzle\Http\Client;

/**
 * Default AWS client implementation
 */
class LeanplumClient implements LeanplumClientInterface
{
    /** @var string */
    const LEANPLUM_URL = 'https://www.leanplum.com/api';

    /** @var string */
    const API_VERSION = "1.0.6";

    /**
     * @var string
     */
    protected $clientKey = '';

    /**
     * @var string
     */
    protected $appId = '';

    /**
     * @var string
     */
    protected $apiVersion = self::API_VERSION;

    /**
     * @var Client|null
     */
    protected $client = null;

    /**
     * LeanplumClient constructor.
     * @param string $clientKey
     * @param string $appId
     * @param string $apiVersion
     * @internal param null|string $clientKey
     */
    public function __construct($clientKey = null, $appId = null, $apiVersion = null)
    {
        if (null !== $clientKey) {
            $this->setClientKey($clientKey);
        }
        if (null !== $appId) {
            $this->setAppId($appId);
        }
        if (null !== $apiVersion) {
            $this->setApiVersion($apiVersion);
        }
    }

    /**
     * @param string $clientKey
     * @return $this
     */
    public function setClientKey($clientKey)
    {
        $this->clientKey = $clientKey;
        return $this;
    }

    /**
     * @param string $appId
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
    }

    /**
     * @param string $apiVersion
     * @return $this
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
        return $this;
    }

    /**
     * @param $method
     * @param Message\Event|null $arguments
     * @return \Guzzle\Http\Message\Response
     */
    public function __call($method, Message\Event $arguments = null)
    {
        if (!in_array($method, $this->validMethods())) {
            throw new \InvalidArgumentException("Invalid method");
        }

        $requestBody = array(
            'action' => $method,
            'appId' => $this->appId,
            'clientKey' => $this->clientKey,
            'apiVersion' => $this->apiVersion,
        );
        $requestBody = array_merge((array) $arguments->format(), $requestBody);
        $request = $this->getClient()->post(null, null, $requestBody);
        return $request->send();
    }

    /**
     * @param Message\Event $event
     * @return Message\Response
     */
    public function track(Message\Event $event)
    {
        $request = $this->getClient()->post(
            null,
            null,
            array(
                'action' => __METHOD__,
                'appId' => $this->appId,
                'clientKey' => $this->clientKey,
                'apiVersion' => $this->apiVersion,
            )
        );
        return $request->send();
    }

    /**
     * Get client
     * @return Client
     */
    protected function getClient()
    {
        if (null === $this->client) {
            $this->client = new Client(self::LEANPLUM_URL);
        }
        return $this->client;
    }

    /**
     * @return array
     */
    protected function validMethods()
    {
        return array('track', 'start', 'resumeSession');
    }
}
