<?php

namespace App\Http\Controllers;

use App\Models\ShippingDetails;

class ShippingDetailsController extends Controller
{
    public function index()
    {
        $shippingDetailsModel = new ShippingDetails;
        $shippingDetails = $shippingDetailsModel->getDetails();
        return view('pages.shippingDetails', compact('shippingDetails'));
    }

    public function store()
    {
        $shippingDetailsModel = new ShippingDetails;
        $shippingDetailsModel->create(request()->all());
        return redirect()->route('shippingDetails');
    }

    public function update(ShippingDetails $shippingDetails)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric',
            'country' => 'required',
            'phone' => 'required|numeric',
        ]);
        //use the model to update the record
        $shippingDetails->update($validatedData);
        
        //        return redirect()->route('shippingDetails');
    }

}
