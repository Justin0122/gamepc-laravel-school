<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingDetails extends Model
{
    protected $fillable = [
        'FKUserID',
        'name',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'phone',
    ];

    public function getDetails()
    {
        return ShippingDetails::where('FKUserID', auth()->user()->id)->first();
    }

    public function updateDetails($request)
    {
        $shippingDetails = $this->getDetails();
        $shippingDetails->name = $request->name;
        $shippingDetails->address = $request->address;
        $shippingDetails->city = $request->city;
        $shippingDetails->state = $request->state;
        $shippingDetails->zip = $request->zip;
        $shippingDetails->country = $request->country;
        $shippingDetails->phone = $request->phone;
        $shippingDetails->save();
    }

    public function validatePhoneNumber($attribute, $value, $parameters, $validator)
    {
        if (preg_match('/^\d+$/', $value)) {
            return true;
        }
        return false;
    }
}
