<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailFromAdminPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Feedback;
use App\Notifications\BGnotifyNewAdmin;
use App\Notifications\UserRestored;
use App\Notifications\UserRestoredAd;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    /**
     * @var string[]
     */
    /*public $whiteIps  = [
        '127.0.0.1',
    ];*/

    public function __construct(Request $request)
    {
       /*$urlcontains1 = str_contains(url()->current(), '/admin/home');
        $urlcontains3 = str_contains(url()->current(), '/website/advertisement');
        $urlcontains2 = str_contains(url()->current(), '/admin/restore/');
        $urlcontains4 = str_contains(url()->current(), '/admin/deletedAds');
        $urlcontains5 = str_contains(url()->current(), '/website/velemeny');
        $urlcontains6 = str_contains(url()->current(), '/admin/emailSend');
        $urlcontains7 = str_contains(url()->current(), '/admin/user/status/');
        $urlcontains8 = str_contains(url()->current(), '/admin/new_password');
        $urlcontains9 = str_contains(url()->current(), '/admin/getIps');
        $urlcontains = $urlcontains1 + $urlcontains2 + $urlcontains3 + $urlcontains4 + $urlcontains5 + $urlcontains6 + $urlcontains7 + $urlcontains8 + $urlcontains9;
        if ($urlcontains && !in_array($request->getClientIp(), $this->whiteIps)) {
            abort(404);
        }*/
        $this->middleware('auth');
    }
    public function index()
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            return view('admin/home');
        }
    }
    public function newPassword()
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            return view('/admin/new_password');
        } else
            abort(404);
    }

    public function newPasswordPost(Request $request)
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $this->validate($request, [
                'new_password' => 'required|min:6',
                'new_password2' => 'required|same:new_password',
                'old_password' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            $fail('Régi jelszó nem egyezik.');
                        }
                    },
                ],
            ]);
            $user = Auth::user();
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
            return redirect('/admin/new_password')->with(array('success' => 'A jelszó módosítás sikerült.'));
        } else
            abort(404);
    }
    public function adminhome()
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            //osszesito szamok kezdete
            $allreviews = DB::table('feedback')->count();
            $allads = DB::table('advertisements')->count();
            $allusers = DB::table('users')->count();
            $notifications = DB::table('advertisements')->where('status', 'inactive')->where('deleted_at', null)->count();
            $allviewsads = DB::table('advertisements')->sum('views');
            //osszesito szamok vege
            //feltoltott || fuggoben levo hirdetesek kezdete
            $ads = advertisement::where('approve', 1)->whereHas('allads')->orderBy('created_at', 'desc')->take(4)->get();
            $waitingads = advertisement::where('approve', 0)->where('deleted_at', null)->orderBy('created_at', 'desc')->get();
            //feltoltott || fuggoben levo hirdetesek vege
            //nemreg regisztraltak kezdete
            $users = User::orderBy('created_at', 'desc')->take(4)->get();
            //nemreg regisztraltak vege
            //fooldal diagramhoz adatok kezdete
            $adslastweek = advertisement::where('approve', 1)->where('created_at', '>', now()->subWeek()->startOfWeek())->where('created_at', '<', now()->subWeek()->endOfWeek())->count();
            $userslastweek = User::where('created_at', '>', now()->subWeek()->startOfWeek())->where('created_at', '<', now()->subWeek()->endOfWeek())->count();
            $feedbackslastweek = Feedback::where('created_at', '>', now()->subWeek()->startOfWeek())->where('created_at', '<', now()->subWeek()->endOfWeek())->count();
            $currentweekstart = now()->subWeek()->startOfWeek()->format("Y-m-d");
            $currentweekend = now()->subWeek()->endOfWeek()->format("Y-m-d");
            //statisztikak kezdete
            if ($userslastweek > 0) {
                $currentweekusers = User::where('created_at', '>', now()->startOfWeek())->where('created_at', '<', now()->endOfWeek())->count();
                $currentweekstatisticsusers = round(($currentweekusers / $userslastweek) * 100, 1);
            } else {
                $currentweekusers = 0;
                $currentweekstatisticsusers = 0;
            }

            if ($adslastweek > 0) {
                $currentweekads = advertisement::where('created_at', '>', now()->startOfWeek())->where('created_at', '<', now()->endOfWeek())->count();
                $currentweekstatisticsads = round(($currentweekads / $adslastweek) * 100, 1);
            } else {
                $currentweekads = 0;
                $currentweekstatisticsads = 0;
            }
            if ($feedbackslastweek > 0) {
                $currentfeedbacks = Feedback::where('created_at', '>', now()->startOfWeek())->where('created_at', '<', now()->endOfWeek())->count();
                $currentfeedbacksstatistics = round(($currentfeedbacks / $feedbackslastweek) * 100, 1);
            } else {
                $currentfeedbacks = 0;
                $currentfeedbacksstatistics = 0;
            }
            //statisztikak vege
            //fooldal diagramhoz adatok vege
            //nemreg erkezett velemenyek kezdete
            $lastreviews = Feedback::orderBy('created_at', 'desc')->take(3)->get();
            //nemreg erkezett velemenyek vege

            return view('/admin/home')->with('allusers', $allusers)->with('allads', $allads)->with('allreviews', $allreviews)->with('ads', $ads)->with('waitingads', $waitingads)
                ->with('notifications', $notifications)->with('users', $users)->with('adslastweek', $adslastweek)->with('currentweekstart', $currentweekstart)->with('currentweekend', $currentweekend)->with('lastreviews', $lastreviews)
                ->with('allviewsads', $allviewsads)->with('userslastweek', $userslastweek)->with('feedbackslastweek', $feedbackslastweek)->with('currentweekstatisticsusers', $currentweekstatisticsusers)
                ->with('currentweekusers', $currentweekusers)->with('currentweekstatisticsads', $currentweekstatisticsads)->with('currentweekads', $currentweekads)
                ->with('currentfeedbacks', $currentfeedbacks)->with('currentfeedbacksstatistics', $currentfeedbacksstatistics);
        } else
            abort(404);
    }
    public function MailsendAdmin()
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $adminusers = User::where('Admin', 1)->orderBy('name', 'asc')->get();
            $users = User::where('Admin', 0)->orderBy('name', 'asc')->get();
            return view('admin.emailSend')->with('users', $users)->with('adminusers', $adminusers);
        } else
            abort(404);
    }
    public function MailsendAdminPage(Request $request)
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $request->validate(
                ['subject' => 'required'],
                ['subject.required' => 'A tárgy mező kitöltése kötelező!'],
                ['message' => 'required'],
                ['message.required' => 'Az üzenet mező kitöltése kötelező!'],
            );
            $userprivatemail = $request->get('userprivatemail');
            $dataContacts = request(['message', 'subject']);
            if ($userprivatemail == "admins") {
                $adminmessages = User::where('Admin', 1)->get();
                foreach ($adminmessages as $adminmessage) {
                    Mail::to($adminmessage)->send(new SendEmailFromAdminPage($dataContacts));
                }
            } elseif ($userprivatemail == "users") {
                $usersmessages = User::where('Admin', 0)->get();
                foreach ($usersmessages as $usermessage) {
                    Mail::to($usermessage)->send(new SendEmailFromAdminPage($dataContacts));
                }
            }
            if ($userprivatemail != "admins" && $userprivatemail != "users") {
                Mail::to($userprivatemail)->send(new SendEmailFromAdminPage($dataContacts));
            }
            return redirect()->back()->with('success', 'Az üzenet sikeresen elküldve a(z) ' . $userprivatemail . ' email címre.');
        } else
            abort(404);
    }
    public function deletedAds(Request $request)
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $deletedads = advertisement::onlyTrashed()->get();
            if ($request->isMethod('get')) {
                $title = $request->get('title');
                $deletedAdSearch = advertisement::onlyTrashed()->where('title', 'LIKE', '%' . $title . '%')->get();
            }
            return view('admin.deletedadsList', compact('deletedAdSearch'))->with('deletedads', $deletedads);
        } else
            abort(404);
    }
    public function restore($id)
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            advertisement::withTrashed()->find($id)->restore();
            $advertisement = advertisement::find($id);
            $advertisement->approve = 1;
            $messageForUser = User::where('id', $advertisement->user_id)->first();
            $messageForUser->notify(new UserRestoredAd($advertisement));
            $advertisement->save();
            return back()->with('success', 'Sikeresen visszaállítottad a(z) ' . $id . '. hirdetést.');
        } else
            abort(404);
    }
    public function getIps(Request $request)
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            if ($request->isMethod('get')) {
                $title = $request->get('title');
                $signedUsersIps = $request->getClientIp();
                $signedUsers = Auth::check();
                return view('admin.userIps', compact('signedUsers'))->with('signedUsers', $signedUsers)->with('signedUsersIps', $signedUsersIps);
            }
            
        } else
            abort(404);
    }
    public function deletedUsers(Request $request)
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $deletedusers = User::onlyTrashed()->get();
            if ($request->isMethod('get')) {
                $title = $request->get('title');
                if(is_numeric($title)){
                    $deletedUserSearch = User::onlyTrashed()->where('id', 'LIKE', '%' . $title .'%')->get();
                }
                else{
                    $deletedUserSearch = User::onlyTrashed()->where('name', 'LIKE', '%' . $title . '%')->get();
                }
            }
            return view('admin.deletedusersList', compact('deletedUserSearch'))->with('deletedusers', $deletedusers);
        } else
            abort(404);
    }
    public function restoreUser($id)
    {
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            User::withTrashed()->find($id)->restore();
            $deltedeUserRestore = User::find($id);
            $messageForDeltedeUserRestore = User::where('id', $deltedeUserRestore->id)->first();
            $messageForDeltedeUserRestore->notify(new UserRestored($deltedeUserRestore));
            return back()->with('success', 'Sikeresen visszaállítottad a(z) ' . $id . '. felhasználót.');
        } else
            abort(404);
    }
    public function maintenance(Request $request){
        if(User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1 && Auth::user()->email=="bodge04@gmail.com"){
            if($request->has('maintenanceBtnUp') == true){
                Artisan::call('down',['--secret'=>'L4BP*%t_XcPvtbZ2@q7UE%N']);
            }
            else{
                Artisan::call('up');
            }
        }
        else
        abort(404);
        return view('admin.maintenance');
    }
}
