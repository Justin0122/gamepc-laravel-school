<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MyPc extends Model
{
    use HasFactory;

    protected $primaryKey = 'MyPcId';

    public function addPartToPC($partID, $partTypeID)
    {
        //get the userid from the session

        $parttype = new Parttype;
        $parttype = $parttype->getPartsByPartTypeID($partTypeID);
        $pc = new MyPc;
        $pc->{'FK' . $parttype->Name . 'Id'} = $partID;
        //if there's a space in the name, replace it with an underscore
        if (str_contains($parttype->Name, ' ')) {
            $parttype->Name = str_replace(' ', '', $parttype->Name);
        }
        $userid = Auth::user()->id;
        //put the userid in the pc object
        $pc->FKUserID = $userid;
        //check if the user already has a pc in the database and update it if so or create a new one if not\
        $pc = MyPc::where('FKUserID', $userid)->first();
        if ($pc) {
            $pc->{'FK' . $parttype->Name . 'Id'} = $partID;

        } else {
            $pc = new MyPc;
            $pc->{'FK' . $parttype->Name . 'Id'} = $partID;
            $pc->FKUserID = $userid;
        }
        $pc->save();
    }

    public function removeFromPc($parttype)
    {
        $pc = MyPc::where('FKUserID', Auth::user()->id)->first();
        //remove spaces from the parttype name
        $parttype = str_replace(' ', '', $parttype);
        $pc->{'FK' . $parttype . 'Id'} = null;
        $pc->save();
    }
}