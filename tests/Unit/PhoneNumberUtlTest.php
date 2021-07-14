<?php

namespace Tests\Unit;

use App\Utl\PhoneNumberUtl;
use PHPUnit\Framework\TestCase;

class PhoneNumberUtlTest extends TestCase
{
    /**
     * Test a valid phone number.
     *
     * @return void
     */
    public function testValidPhoneNumber()
    {
        $phoneNumberUtl = new PhoneNumberUtl('(212) 698054317');
        $this->assertTrue($phoneNumberUtl->validate());
    }

    /**
     * Test a invalid phone number.
     *
     * @return void
     */
    public function testInValidPhoneNumber()
    {
        $phoneNumberUtl = new PhoneNumberUtl('(212) 6980543172');
        $this->assertFalse($phoneNumberUtl->validate());
    }

    /**
     * Test a get phone number country.
     *
     * @return void
     */
    public function testGetPhoneNumberCountry()
    {
        $phoneNumberUtl = new PhoneNumberUtl('(212) 698054317');
        $this->assertEquals($phoneNumberUtl->getCountry(), 'MOROCCO');
    }

    /**
     * Test get phone country code by country.
     *
     * @return void
     */
    public function testGetPhoneCountryCodeByCountry()
    {
        $phoneNumberUtl = new PhoneNumberUtl();
        $this->assertEquals($phoneNumberUtl->getCodeByCountry('MOROCCO'), '(212)');
    }

    /**
     * Test get country by phone country code.
     *
     * @return void
     */
    public function testGetCountryByPhoneCountryCode()
    {
        $phoneNumberUtl = new PhoneNumberUtl();
        $this->assertEquals($phoneNumberUtl->getCountryByCode('212'), 'MOROCCO');
    }
}
