<?php

namespace App\Http\Controllers;

use App\Models\Parttype;
use Illuminate\Support\Facades\DB;


class ParttypeController extends Controller
{
    public function index($parttype)
    {
        //turn it all lowercase
        $parttype = strtolower($parttype);

        // get an instance of the PartType model
        $partTypeModel = new Parttype;

        // get the parttype id from the parttypes table
        $partType = $partTypeModel->getPartTypeByName($parttype);

        // get the parts from the parts table using the query builder with pagination
        $parts = DB::table('parts')->where('FKPartTypeID', $partType->PartTypeID)->paginate(5);
        // return the view with the parts
        return view('pc/parttype', ['parts' => $parts, 'parttype' => $parttype]);
    }
}