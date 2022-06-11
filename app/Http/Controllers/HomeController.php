<?php

namespace App\Http\Controllers;

use App\Models\advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ContactMe;
use App\Mail\ContactUsAdmin;
use App\Notifications\UserAdDelete;
use App\Notifications\UserSoonAdDelete;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;
class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reauthenticate(Request $request)
    {
        // get the logged in user
        $user = Auth::user();

        // initialise the 2FA class
        $google2fa = app('pragmarx.google2fa');

        // generate a new secret key for the user
        $user->google2fa_secret = $google2fa->generateSecretKey();

        // save the user
        $user->save();

        // generate the QR image
        $QR_Image = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        // Pass the QR barcode image to our view.
        return view('google2fa.register', [
            'QR_Image' => $QR_Image,
            'secret' => $user->google2fa_secret,
            'reauthenticating' => true
        ]);
    }
    //Hirdetesek page
    public function search(Request $request)
    {
        if ($request->isMethod('get')) {
            $title = $request->get('title');
            $listanimaltype=$request->get('animal_type');
            switch($listanimaltype){
                case "Kutya":
                    $listanimaltype="dog";
                    break;
                case "Macska":
                    $listanimaltype="cat";
                    break;
                case "Nyúl":
                    $listanimaltype="rabbit";
                    break;
                case "Sündisznó":
                    $listanimaltype="hedgehog";
                    break;
                case "Papagáj":
                    $listanimaltype="parrot";
                    break;
                default: $listanimaltype;
            }
            $listzips=$request->get('zip_number');
            $advertisements = advertisement::where('title', 'LIKE', '%' . $title . '%')->where('animal_type', 'LIKE', '%' . $listanimaltype . '%')->where('zip_number', 'LIKE', '%' . $listzips . '%')->where('approve', 1)->where('status', 'active')->where('search_find', 'search')->paginate(4);
            $ads = advertisement::where('approve', 1)->whereHas('titles')->paginate(4);
            $animals = DB::table('advertisements')->where('search_find', 'search')->where('approve', 1)->select('animal_type')->distinct()->take(2)->get()->pluck('animal_type')->sort();
            $zips = DB::table('advertisements')->where('search_find', 'search')->where('approve', 1)->select('zip_number')->distinct()->take(5)->inRandomOrder()->get()->pluck('zip_number')->sort();
            $allads = DB::table('advertisements')->where('approve', 1)->where('deleted_at', null)->where('search_find', 'search')->count();
            return view('website.hirdetesek', compact('advertisements','listanimaltype', 'listzips'))->with('ads', $ads)->with('allads', $allads)->with('animals', $animals)->with('zips', $zips)->with('title', $title);
        }
    }
    //Main page
    public function Homesearch(Request $request)
    {
        if ($request->isMethod('get')) {
            $title = $request->get('title');
            $homeadverts = advertisement::where('title', 'LIKE', '%' . $title . '%')->where('approve', 1)->where('status', 'active')->get();
            $advertisements = advertisement::where('approve', 1)->whereHas('titles')->get();
        }
        return view('website.home', compact('homeadverts'))->with('advertisements', $advertisements)->with('title',$title);
    }
    public function index()
    {
        return view('website.home');
    }
    //SajatHirdetesek page
    public function ownads()
    {
        if (Auth::check()) {
            $ownads = advertisement::where('user_id', Auth::user()->id)->paginate(3);
            return view('website.sajatHirdetesek')->with('ownads', $ownads);
        } else
            return redirect('login');
    }
    //HirdetesekReszletei page
    public function hirdetesReszletei($id)
    {
        $ownad = advertisement::where('id', $id)->where('approve', 1)->where('status', 'active')->first();
        if( (Auth::check() && $ownad->user_id!=Auth::user()->id) || !Auth::check()){
            advertisement::find($id)->increment('views');
        }
        return view('website.hirdetesReszletei')->with('ownad', $ownad);
    }
    //HirdetesekReszltei page email
    public function sendEmail(Request $request, $id)
    {
        
        //googlerecaptcha
        $request->validate([
            'g-recaptcha-response' => 'required|string',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->get('g-recaptcha-response'),
            'remoteip' => $request->getClientIp(),
        ]);

        if (!$response->json('success')) {
            throw ValidationException::withMessages(['g-recaptcha-response' => 'Hiba az ellenőrzés során, próbáld újra!']);
        }
        //endgooglerecaptcha
        $advertisements = advertisement::find($id);
        $messageforuser = User::where('id', $advertisements->user_id)->first();
        $data = request(['name', 'email', 'subject', 'message', 'phone']);
        Mail::to($messageforuser)->send(new ContactMe($data));
        $ownad = advertisement::where('id', $id)->first();
        return redirect()->back()->with('success', 'Az email sikeresen elküldve ' . $advertisements->user->name . ' felhasználónak')->with('ownad', $ownad);
    }
    public function rolunk()
    {
        $allaprovads = DB::table('advertisements')->where('approve', 1)->count();;
        $allusers = DB::table('users')->count() + 123;
        $alldeletedads = DB::table('advertisements')->where('deleted_at','!=', null )->count()+23;
        
        return view('website.rolunk')->with('allaprovads', $allaprovads)->with('allusers', $allusers)->with('alldeletedads', $alldeletedads);
    }
    //talaltHirdetesek
    public function found(Request $request)
    {
        if ($request->isMethod('get')) {
            $title = $request->get('search');
            $foundanimalsearch=$request->get('foundanimalsearch');
            switch($foundanimalsearch){
                case "Kutya":
                    $foundanimalsearch="dog";
                    break;
                case "Macska":
                    $foundanimalsearch="cat";
                    break;
                case "Nyúl":
                    $foundanimalsearch="rabbit";
                    break;
                case "Sündisznó":
                    $foundanimalsearch="hedgehog";
                    break;
                case "Papagáj":
                    $foundanimalsearch="parrot";
                    break;
                default: $foundanimalsearch;
            }
            $foundlistzips=$request->get('foundzip_number');
            $foundads = advertisement::where('title', 'LIKE', '%' . $title . '%')->where('zip_number', 'LIKE', '%' . $foundlistzips . '%')->where('animal_type', 'LIKE', '%' . $foundanimalsearch . '%')->where('approve', 1)->where('status', 'active')->whereHas('found')->paginate(4);
            $animals = DB::table('advertisements')->where('search_find', 'find')->where('approve', 1)->select('animal_type')->distinct()->take(5)->get()->pluck('animal_type')->sort();
            $zips = DB::table('advertisements')->where('search_find', 'find')->where('approve', 1)->select('zip_number')->distinct()->take(5)->inRandomOrder()->get()->pluck('zip_number')->sort();
            $allads = DB::table('advertisements')->where('approve', 1)->where('deleted_at', null)->where('search_find', 'find')->count();
            return view('website.talaltHirdetesek', compact('foundanimalsearch','foundlistzips'))->with('foundads', $foundads)->with('animals', $animals)->with('zips', $zips)->with('allads', $allads)->with('title', $title);
        }
    }
    public function hasznalatiFeltetelek()
    {
        return view('website.hasznalatiFeltetelek');
    }
    public function adatkezeles()
    {
        return view('website.adatkezeles');
    }
    public function kapcsolat()
    {
        return view('website.kapcsolat');
    }
    public function kapcsolatEmail(Request $request)
    { 
        //googlerecaptcha
        $request->validate([
            'g-recaptcha-response' => 'required|string',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->get('g-recaptcha-response'),
            'remoteip' => $request->getClientIp(),
        ]);

        if (!$response->json('success')) {
            throw ValidationException::withMessages(['g-recaptcha-response' => 'Hiba az ellenőrzés során, próbáld újra!']);
        }
        //endgooglerecaptcha
        $messageforadmins = User::where('Admin', 1)->first();
        $datacontactUs = request(['name', 'email', 'subject', 'message']);
        Mail::to($messageforadmins)->send(new ContactUsAdmin($datacontactUs));
        return redirect()->back()->with('success', 'Az email sikeresen elküldve az Adminisztrátoroknak!');
    }

    public function maintenance(){
        return view('admin.maintenance');
    }
}
