<?php
namespace Leanplum;

use Guzzle\Http\Client;

/**
 * Default AWS client implementation
 */
class LeanplumClient implements LeanplumClientInterface
{
    /** @var string */
    const LEANPLUM_URL = 'https://www.leanplum.com/api?';

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
     * @param Message\Request\RequestAbstract|null $arguments
     * @return \Guzzle\Http\Message\Response
     */
    public function __call($method, $arguments = null)
    {
        $message = array_pop($arguments);
        if (!in_array($method, $this->validMethods())) {
            throw new \InvalidArgumentException("Invalid method");
        }

        $uriParams = array(
            'appId' => $this->appId,
            'clientKey' => $this->clientKey,
            'apiVersion' => $this->apiVersion,
        );

        $url = self::LEANPLUM_URL . http_build_query($uriParams);
        $request = $this->getClient()->post($url, null, json_encode($message->format()));
        return $request->send();
    }

    /**
     * Get client
     * @return Client
     */
    protected function getClient()
    {
        if (null === $this->client) {
            $this->client = new Client();
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
