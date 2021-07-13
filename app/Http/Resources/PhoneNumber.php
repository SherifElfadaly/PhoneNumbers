<?php

namespace App\Http\Resources;

use App\Contracts\PhoneNumberUtlInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class PhoneNumber extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (! $this->resource) {
            return [];
        }

        $phoneUtl = App::make(PhoneNumberUtlInterface::class);
        $phoneUtl->setPhoneNumber($this->phone);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'country' => $phoneUtl->getCountry(),
            'state' => $phoneUtl->validate() ? 'OK' : 'NOK',
            'country_code' => '+' . $phoneUtl->getCountryCode()
        ];
    }
}
