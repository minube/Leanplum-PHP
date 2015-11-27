<?php
namespace Leanplum;

/**
 * Represents an Leanplum client.
 */
interface LeanplumClientInterface
{
    /**
     * @param $method
     * @param Message\Request\RequestAbstract $arguments
     * @return \Guzzle\Http\Message\Response
     */
    public function __call($method, $arguments = null);
}
