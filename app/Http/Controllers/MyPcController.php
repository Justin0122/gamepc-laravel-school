<?php

namespace App\Http\Controllers;

use App\Models\Parts;
use App\Models\Parttype;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyPcController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        //get everything from mypc table where fkuserid = userid and put them in a var dump them
        $myPc = DB::table('my_pcs')->where('FKUserID', $user->id)->get();
        $myPc = json_decode($myPc, true);

        $types = array('cpu', 'motherboard', 'cpucooler', 'case', 'gpu', 'ram', 'storage', 'casecooler', 'psu', 'os');

        //get the part information except the specifications
        $componentModel = new Parts;
        $partTypeModel = new PartType;
        $components = [];
        try {
            foreach ($types as $type) {
                $partComponents = $componentModel->getComponentsByPartID($myPc[0]["FK" . $type . "Id"]);
                $partComponents = json_decode($partComponents, true);
                //push the part information into the array
                foreach ($partComponents as $component) {
                    $partType = $partTypeModel->getPartsByPartTypeID($component['FKPartTypeID']);
                    $component['partTypeName'] = $partType->Name;
                    $components[] = (object)$component;
                }
            }
        } catch (\Exception $e) {

        }
        return view('pc.pc', ['components' => $components, 'types' => $types]);
    }

    public function remove($partID, $partTypeID)
    {
        $parttype = Parts::where('PartID', $partTypeID)->first();
        //use removeFromPc function from mypc model
        $myPc = new \App\Models\MyPc;
        $myPc->removeFromPc($partID, $partTypeID);
        return redirect()->back()->with('removed', $parttype->Name);
    }
}