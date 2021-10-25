<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function createAndIndex()
    {
        return view('indexCreateOffer');
    }

    public function postOffer()
    {
        $data = request()->validate([
            'attachment'=>'max:2240',
            'title'=>'required',
            'location'=>'required',
            'city'=>'required',
            'setup'=>'required',
            'description'=>'required',
        ]);

        if (!is_null(request()->attachment)) {
            $data['attachment'] = $data['attachment']->store('public');
        }

        auth()->user()->offers()->create($data);
        return back();
    }

    public function postDelete(Offer $offer)
    {
        $offer->delete();
        return back();
    }

    public function searchOffer()
    {
        $data = request()->validate([
            'keyword'=>'required',
            'filter_1'=>''
        ]);
        $filter = $data['filter_1'] ?? 'newest';

        if ($filter == 'newest') {
            $offers = Offer::where("title", 'LIKE', '%'.$data['keyword'].'%')->latest()->paginate(7)->appends(request()->query());
        } else {
            $offers = Offer::where("title", 'LIKE', '%'.$data['keyword'].'%')->paginate(7)->appends(request()->query());
        }

        return view('offer', compact('offers'));
    }
}
