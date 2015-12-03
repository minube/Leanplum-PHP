<?php
namespace Leanplum\Message\Request;

/**
 * Event to be tracked by Leanplum
 */
class Track extends RequestAbstract
{
    const ACTION = 'track';
    const DETECT_LOCATION_VALUE = '(detect)';
    const DEFAULT_CURRENCY_CODE = 'EUR';

    /** @var string */
    protected $event = 'Purchase';

    /** @var integer */
    protected $userId;

    /** @var string */
    protected $deviceId;

    /** @var boolean */
    protected $devMode;

    /** @var string */
    protected $action = self::ACTION;

    /** @var float */
    protected $value;

    /** @var string */
    protected $currencyCode;

    /** @var string  */
    protected $info;

    /** @var array */
    protected $params = array();

    /** @var integer */
    protected $messageId;

    /** @var boolean */
    protected $allowOffline;

    /**
     * Format entity
     * @return string
     */
    public function format()
    {
        return array(
            'action' => $this->getAction(),
            'userId' => $this->getUserId(),
            'deviceId' => $this->getDeviceId(),
            'devMode' => $this->getDevMode(),
            'event' => $this->getEvent(),
            'value' => $this->getValue(),
            'currencyCode' => $this->getCurrencyCode(),
            'info' => $this->getInfo(),
            'params' => $this->getParams(),
            'messageId' => $this->getMessageId(),
            'allowOffline' => $this->getAllowOffline(),
        );
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function addToParams($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function set($name, $value)
    {
        if (property_exists(get_class(), $name)) {
            $this->{$name} = $value;
        }
        return $this;
    }
}
