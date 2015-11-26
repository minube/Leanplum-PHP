<?php
namespace Leanplum;

/**
 * Represents an Leanplum client.
 */
interface LeanplumClientInterface
{
    /**
     * @param $method
     * @param Message\Event|null $arguments
     * @return \Guzzle\Http\Message\Response
     */
    public function __call($method, Message\Event $arguments = null);
}
