<?php
namespace Leanplum\Message\Request;

/**
 * Session to be started by Leanplum
 */
class Session extends RequestAbstract
{
    /** @var string */
    protected $systemName;

    /** @var string */
    protected $systemVersion;

    /** @var string */
    protected $browserName;

    /** @var string */
    protected $browserVersion;

    /** @var string */
    protected $deviceName;

    /** @var string */
    protected $deviceModel;

    /** @var string */
    protected $userAttributes;

    /** @var string */
    protected $locale;

    /** @var string */
    protected $country;

    /** @var string */
    protected $region;

    /** @var string */
    protected $city;

    /** @var string */
    protected $location;

    /** @var string */
    protected $timezone;

    /** @var integer */
    protected $timezoneOffsetSeconds;

    /** @var string */
    protected $versionName;

    /** @var boolean */
    protected $background;

    /** @var boolean */
    protected $includeDefaults;

    /**
     * Format entity
     * @return string
     */
    public function format()
    {
        return json_encode(
            array(
                'systemName' => $this->getSystemName(),
                'systemVersion' => $this->getSystemVersion(),
                'browserName' => $this->getBrowserName(),
                'browserVersion' => $this->getBrowserVersion(),
                'deviceName' => $this->getDeviceName(),
                'deviceModel' => $this->getDeviceModel(),
                'userAttributes' => $this->getUserAttributes(),
                'locale' => $this->getLocale(),
                'country' => $this->getCountry(),
                'region' => $this->getRegion(),
                'city' => $this->getCity(),
                'location' => $this->getLocation(),
                'timezone' => $this->getTimezone(),
                'timezoneOffsetSeconds' => $this->getTimezoneOffsetSeconds(),
                'versionName' => $this->getVersionName(),
                'background' => $this->getBackground(),
                'includeDefaults' => $this->getIncludeDefaults(),
            )
        );
    }
}
