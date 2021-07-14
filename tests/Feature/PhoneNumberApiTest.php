<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class PhoneNumberApiTest extends TestCase
{
    /**
     * Test listing phone numbers.
     *
     * @return void
     */
    public function testListPhoneNumbers()
    {
        $response = $this->get('api/phone-numbers');

        $response->assertStatus(200);
        $response->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'phone',
                            'country',
                            'state',
                            'country_code'
                        ]
                    ]
                ]
            );
    }

    /**
     * Test filter phone numbers by country.
     *
     * @return void
     */
    public function testFilterPhoneNumbersByCountry()
    {
        $country = 'MOROCCO';
        $response = $this->get('api/phone-numbers?country=' . $country);

        $response->assertStatus(200);

        $response->assertJson(
            function(AssertableJson $json) use ($country){

                $json->has('meta')
                ->has('links')
                ->has('data')
                ->has(
                    'data.0',
                    fn ($json) =>
                    $json->where('country', $country)->etc()
                );
            }
        );
    }

    /**
     * Test filter phone numbers by state.
     *
     * @return void
     */
    public function testFilterPhoneNumbersByState()
    {
        $valid = true;
        $response = $this->get('api/phone-numbers?valid=' . $valid);

        $response->assertStatus(200);

        $response->assertJson(
            function(AssertableJson $json) use ($valid){

                $json->has('meta')
                ->has('links')
                ->has('data')
                ->has(
                    'data.0',
                    fn ($json) =>
                    $json->where('state', 'OK')->etc()
                );
            }
        );
    }
}
