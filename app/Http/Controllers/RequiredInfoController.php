<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RequiredInfoInterface;

class RequiredInfoController extends Controller
{
    //

    protected $requiredInfo;

    public function __construct(RequiredInfoInterface $interface)
    {
        $this->requiredInfo = $interface;
    }

    public function store(Request $request)
    {
        $request->validate([
            "field_name" => "required",
            "is_required" => "required",
            "promotion_id" => "required|exists:promotions,id"
        ]);

        $this->requiredInfo->store($request);
        return response()->json("Promo validation field successfully created!",201);
    }

    public function delete($id)
    {
        $this->requiredInfo->delete($id);
        return response()->json("Promo validation field deleted!",200);
    }
}
