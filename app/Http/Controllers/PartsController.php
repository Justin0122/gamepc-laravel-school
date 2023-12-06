<?php

namespace App\Http\Controllers;

use App\Models\Parts;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    public function index($parttype, $partID)
    {
        $componentModel = new Parts;
        $components = $componentModel->getComponentsByPartID($partID);
        foreach ($components as $c) {
            $specifications = json_decode($c->Specifications, true);
        }
        return view('pc/component', ['part' => $components, 'specifications' => $specifications]);
    }

    public function destroy($id)
    {
        $componentModel = new Parts;

        //delete the image files from the file system
//        if (file_exists(public_path('product_images/' . $components[0]->Name . '.png'))) {
//            unlink(public_path('product_images/' . $components[0]->Name . '.png'));
//        } else {
//            echo "File does not exist";
//        }

        $componentModel->where('PartID', $id)->delete();
        return redirect()->back();
    }

    public function update(Request $request, $partID)
    {
        $data = [
            'Name' => $request->input('Name'),
            'Brand' => $request->input('Brand'),
            'Price' => $request->input('Price'),
            'Stock' => $request->input('Stock'),
            'Specifications' => json_encode($request->input('Specifications'))
        ];

        (new Parts)->updateProduct($partID, $data);
        //set the session "updated" to true
        return redirect()->back()->with('updated', true);
    }

    public function addtopc(Request $request, $partID)
    {
        $parttype = Parts::where('PartID', $partID)->first();

        //use the model to add the part to the pc
        $pc = new \App\Models\MyPc;
        $pc->addPartToPC($partID, $parttype->FKPartTypeID);

        //go to the pc page with a message that the part was added
        return redirect()->route('pc')->with('added', $parttype->Name);
    }
}