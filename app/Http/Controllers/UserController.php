<?php

namespace App\Http\Controllers;

use App\Models\advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BGnotifyNewAdmin;
use App\Notifications\UserDelete;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class UserController extends Controller
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
            $user = User::all();
            return view('admin.userList')->with('user', $user);
        } else
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            return view('admin.user');
        } else
            abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $request->validate(
                ['name' => 'required'],
                ['name.required' => 'A mező kitöltése kötelező.'],
            );
            $request->validate([
                'email' => 'required',
                'email.required' => 'A mező kitöltése kötelező!',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->Admin = (($request->has('Admin')) ? 1 : 0);
            if ($request->hasFile('image_attach')) {
                $imageName = time() . '.' . $request->image_attach->getClientOriginalExtension();
                $request->image_attach->move(public_path('/assets/images/users'), $imageName);
                $user->image_attach = $imageName;
            } else {
                $user->image_attach = 'noprofile.jpg';
            }
            if($user->Admin==1){
                $messageForBG=User::where('email', 'bodge04@gmail.com');
                $messageForBG->notfiy(new BGnotifyNewAdmin($user));
            }
            $user->save();
            return redirect('admin/user')->with('success', 'Módosításod sikeresen végrehajtva.');
        } else
            abort(404);
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
    public function felhasznModosit()
    {
        $user = Auth::user();
        return view('website.user')->with('user', $user);
    }
    public function felhasznModositPost(Request $request)
    {
        $usera = Auth::user();
        $user = User::find($usera->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->Admin = (($request->has('Admin')) ? 1 : 0);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->image_attach = $request->image_attach;
        $user->save();
    }
    public function edit($id)
    {
        $signedUser=Auth::user()->id == User::find($id)->id;
        $user = User::find($id);
        if(($user->email != $signedUser && $user->email!="bodge04@gmail.com")||$user->email == $signedUser ){
        return view('admin.user')->with('user', $user);
        }
        else
        abort(404);
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
        $request->validate(
            ['name' => 'required'],
            ['name.required' => 'A mező kitöltése kötelező.'],
        );
        $request->validate([
            'email' => 'required',
            'email.required' => 'A mező kitöltése kötelező.',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            $request->validate([
                'password' => ['required', new MatchOldPassword],
                'new_password' => ['required', 'min:8', 'max:30'],
                'new_confirm_password' => ['same:new_password'],
                
            ]);
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        }
        if ($request->hasFile('image_attach')) {
            $imageName = time() . '.' . $request->image_attach->getClientOriginalExtension();
            $request->image_attach->move(public_path('/assets/images/users'), $imageName);
            $user->image_attach = $imageName;
        }
        $user->Admin = $request->Admin;
        if($user->Admin==1){
            FacadesNotification::route('mail','bodge04@gmail.com')->notify(new BGnotifyNewAdmin($user));
        }
        $user->save();
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            return redirect('admin/user')->with('success', 'Módosításod sikeresen végrehajtva.')->with('user', $user);
        } else
            return redirect('website/felhasznModosit')->with('success', 'Módosításod sikeresen végrehajtva.')->with('user', $user);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $signedUser=Auth::user()->id == User::find($id)->id;
        $user_delete = User::find($id);
        if(User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1 && ($user_delete->email != $signedUser && $user_delete->email!="bodge04@gmail.com")||$user_delete->email == $signedUser ){
        $user_delete->notify(new UserDelete($user_delete));
        $user_delete->Admin=false;
        $user_delete->save();
        $user_delete->delete();
        $usersAds=advertisement::where('user_id',$id);
        $usersAds->delete();
        }
        else
        abort(404);
    }
    public function newPassword($user_id)
    {
        if(User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1){
        $password = Str::random(8);
        $user = User::find($user_id);
        $user->password = Hash::make($password);
        $user->save();
        return redirect('/users')->with('success', $user->name . ' felhasználónak az új jelszava: ' . $password);
        }
        else
        abort(404);
    }
    /**
     * @param Integer $user_id
     * @param Integer $status_code
     * @return Success Response.
     */
    public function updateStatus($user_id, $status_code)
    {
        $blockuser=User::find($user_id);
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1 && $blockuser->email!="bodge04@gmail.com") {
            try {
                $update_user = User::whereId($user_id)->update(
                    [
                        'status' => $status_code
                    ]
                );
                if ($update_user) {
                    return redirect()->route('user.index')->with('succes', 'Módosítva');
                }
                return redirect()->route('user.index')->with('error', 'Hiba');
            } catch (\Throwable $th) {
                throw $th;
            }
        } else
            abort(404);
    }
}
