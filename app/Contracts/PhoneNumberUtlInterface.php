<?php

namespace App\Contracts;

interface PhoneNumberUtlInterface
{   
    /**
     * Set phone number.
     *
     * @param  string $phoneNumber
     * @return void
     */
    public function setPhoneNumber($phoneNumber);

    /**
     * Validate the given phone number.
     *
     * @return boolean
     */
    public function validate();

    /**
     * Get the country from the phone number.
     *
     * @return string
     */
    public function getCountry();

    /**
     * Get the country code from the phone number.
     *
     * @return string
     */
    public function getCountryCode();

    /**
     * Get the country code related to the given country.
     *
     * @param  string $country
     * @return string
     */
    public function getCodeByCountry($country);

    /**
     * Get the country related to the given country code.
     *
     * @param  string $countryCode
     * @return string
     */
    public function getCountryByCode($countryCode);
}
