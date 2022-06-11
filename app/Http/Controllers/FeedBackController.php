<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\advertisement;

class FeedBackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $usera = Auth::user();
        $user = User::find($usera->id);
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $feedback = Feedback::all();
            return view('admin.feedbackList')->with('feedback', $feedback)->with('user', $user);
        } else
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Feedback::where('user_id', Auth::user()->id)->count() == 0 || User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1){
        if (!advertisement::where('user_id', Auth::user()->id)->count()==0 || User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1){
            $user_id = $request->get('user_id');
            $person = Auth::user($user_id);
            return view('website.velemeny')->with('mode', 'create')->with('person', $person);
        }
        else
        return redirect('website/home')->with('error','Nincs jogod véleményt írni, amíg nem töltöttél fel legalább egy hirdetést!');
        }
        else
        return redirect()->back()->with('error','Küldtél már visszajelzést korábban! Köszönjük!');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            ['stars' => 'required'],
            ['stars.required' => 'Kérjük értékeld csillagokkal az oldalt.'],
        ]);
        $feedback = new Feedback;
        $feedback->user_id = Auth::user()->id;
        $feedback->feedback_description=$request->feedback_description;
        $feedback->stars=$request->stars;
        $feedback->save();
        return redirect('website/home')->with('success', 'Sikeres! Köszönjük visszajelzésedet!')->with('feedback',$feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedbackdelete=Feedback::find($id);
        $feedbackdelete->delete();
    }
}
