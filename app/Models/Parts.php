<?php

namespace App\Models;

use App\Http\Controllers\Request;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    protected $primaryKey = 'PartID';
    protected $fillable = [
        'PartID',
        'FKBrandID',
        'Name',
        'Price',
        'Stock',
        'Specifications',
    ];

    public function getComponentsByPartID($partID)
    {
        return Parts::where('PartID', $partID)->get();
    }

    public function updateProduct($partID, $data)
    {
        $product = $this->findOrFail($partID);
        $product->update($data);
    }
}
