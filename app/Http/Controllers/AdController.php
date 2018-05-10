<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use App\Http\Requests\StoreAd as StoreAdRequest;
use Auth;
use Gate;
use App\Http\Requests\UpdateAd as UpdateAdRequest;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::published()->paginate();
        return view('ads.index', compact('ads'));
    }

    public function create()
    {
        return view('ads.create');
    }

    public function store(StoreAdRequest $request)
    {

        $data = $request->only('title', 'description');
        $data['slug'] = str_slug($data['title']);
        $data['user_id'] = Auth::user()->id;
        $ad = Ad::create($data);

        return redirect()->route('edit_ad', ['id' => $ad->id]);
    }

    public function drafts()
    {
        $adsQuery = Ad::unpublished();
        if(Gate::denies('see-all-drafts')) {
            $adsQuery = $adsQuery->where('user_id', Auth::user()->id);
        }
        $ads = $adsQuery->paginate();
        return view('ads.drafts', compact('ads'));
    }

    public function edit(Ad $ad)
    {
        return view('ads.edit', compact('ad'));
    }

    public function update(Ad $ad, UpdateAdRequest $request)
    {
        $data = $request->only('title', 'description');
        $data['slug'] = str_slug($data['title']);
        $ad->fill($data)->save();
        return back();
    }

    public function publish(Ad $ad)
    {
        $ad->published = true;
        $ad->save();
        return back();
    }

    public function show($id)
    {
        $ad = Ad::published()->findOrFail($id);
        return view('ads.show', compact('ad'));
    }

    public function delete($id)
    {
        $ad = Ad::published()->findOrFail($id);
        $ad->delete();
        return view('ads.show', compact('ad'));
    }


}
