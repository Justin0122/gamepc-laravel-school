<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parttype extends Model
{
    public function getPartTypeByName($name)
    {
        return PartType::where('Name', $name)->first();
    }

    public function getPartsByPartTypeID($PartTypeID)
    {
        return PartType::where('PartTypeID', $PartTypeID)->first();
    }

}

class Part extends Model
{
    public function getPartsByPartType($partTypeId)
    {
        return Part::where('FKParttypeID', $partTypeId)->get();
    }
}