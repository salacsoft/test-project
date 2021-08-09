<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PromotionInterface;

class PromotionController extends Controller
{
    //
    protected $promotion;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PromotionInterface $interface)
    {
        $this->promotion = $interface;
    }

    public function store(Request $request)
    {
        $request->validate($this->promotion->getRules(), $this->promotion->getCustomMessage());
        $this->promotion->store($request);
        return response()->json(["New Promotion successfully created!"],201);
    }


    public function getPromo($clientSlug)
    {
        $promotion =  $this->promotion->getPromo($clientSlug);
        return response()->json($promotion, 200);
    }


    public function all()
    {
        $promotions =  $this->promotion->all();
        return response()->json($promotions, 200);
    }


}
