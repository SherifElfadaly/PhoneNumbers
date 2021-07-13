<?php

namespace App\Utl;

use App\Contracts\PhoneNumberUtlInterface;
use App\Enums\PhoneNumberRegex;

class PhoneNumberUtl implements PhoneNumberUtlInterface
{
    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * Init new object.
     *
     * @param  string $phoneNumber
     * @return void
     */
    public function __construct($phoneNumber = null)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Set phone number.
     *
     * @param  string $phoneNumber
     * @return void
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Validate the given phone number.
     *
     * @return boolean
     */
    public function validate()
    {
        foreach (PhoneNumberRegex::all() as $pattern) {
            if (preg_match($pattern, $this->phoneNumber)) {
                $this->pattern = $pattern;
                return true;
            }
        }

        return false;
    }

    /**
     * Get the country from the phone number.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->getCountryByCode($this->getCountryCode());
    }

    /**
     * Get the country code from the phone number.
     *
     * @return string
     */
    public function getCountryCode()
    {
        return substr($this->phoneNumber, 1, 3);
    }

    /**
     * Get the country code related to the given country.
     *
     * @param  string $country
     * @return string
     */
    public function getCodeByCountry($country)
    {
        $pattern = PhoneNumberRegex::value($country);
        $pattern = str_replace('/\\', '', $pattern);
        $pattern = (string) str_replace('\\', '', $pattern);

        return substr($pattern, 0, 5);
    }

    /**
     * Get the country related to the given country code.
     *
     * @param  string $countryCode
     * @return string
     */
    public function getCountryByCode($countryCode)
    {
        foreach (PhoneNumberRegex::all() as $country => $pattern) {
            if (strpos($pattern, '/\(' . $countryCode . '\)') === 0) {
                return $country;
            }
        }

        return '';
    }
}
