<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use Illuminate\Http\Request;

class KasAPIController extends Controller
{
    public function get_all()
    {
        $kas = Kas::all();
        return response()->json([
            'kas'=>$kas,
        ]);
    }
}
