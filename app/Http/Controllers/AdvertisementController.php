<?php

namespace App\Http\Controllers;

use App\Models\advertisement;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\AdvertisementApprovedNotification;
use App\Notifications\AdvertisementModifyNotification;
use App\Notifications\AdvertisementModifyForAdmins;
use App\Notifications\AdvertisementSentUser;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewAdForAdmins;
use App\Notifications\UserAdDelete;
use App\Notifications\UserSoonAdDelete;
use Illuminate\Support\Carbon;
use PDF;

class AdvertisementController extends Controller
{
    /**
     * @var string[]
     */
    /*public $whiteIps  = [
        '127.0.0.2',
    ];
*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        /*$url=$request->url();
        if (($url=="https://nyomozoo.hu/website/advertisement" || $url=="https://www.nyomozoo.hu/website/advertisement") && !in_array($request->getClientIp(), $this->whiteIps)) {
            abort(404);
        }*/
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $usera = Auth::user();
        $user = User::find($usera->id);
        if (User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $advertisement = advertisement::all();
            if ($request->isMethod('get')) {
                $title = $request->get('title');
                $advertisementsearch = advertisement::where('title', 'LIKE', '%' . $title . '%')->get();
            }
            return view('admin.advertisementList', compact('advertisementsearch'))->with('advertisement', $advertisement)->with('user', $user);
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
        $user_id = $request->get('user_id');
        $person = Auth::user($user_id);
        return view('website.advertisement')->with('mode', 'create')->with('person', $person);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $advertisement = new Advertisement;
        $advertisement->user_id = Auth::user()->id;
        $advertisement->title = $request->title;
        $advertisement->name = $request->name;
        $advertisement->disappeared = $request->disappeared;
        $advertisement->zip_number = $request->zip_number;
        $advertisement->animal_type = $request->animal_type;
        $advertisement->comment = $request->comment;
        $advertisement->characteristics = $request->characteristics;
        $advertisement->phone_number = $request->phone_number;
        $advertisement->pre_phone_number = $request->pre_phone_number;
        $advertisement->chip = (($request->has('chip')) ? true : false);
        $advertisement->sex = $request->sex;
        $advertisement->search_find = $request->search_find;
        $advertisement->approve = false;
        $advertisement->status="inactive";
        if ($request->hasFile('image_attach')) {
            $imageName = time() . '.' . $request->image_attach->getClientOriginalExtension();
            $request->image_attach->move(public_path('/assets/images/advertisement'), $imageName);
            $advertisement->image_attach = $imageName;
        } else {
            $advertisement->image_attach = 'noimage.jpg';
        }
        if ($advertisement->approve == 0) {
            $administrator = User::where('Admin', 1)->first();
            $advertisement->user_id == Auth::user()->id;
            $usernotify = User::where('id', $advertisement->user_id)->first();
            $usernotify->notify(new AdvertisementSentUser($advertisement));
            $administrator->notify(new NewAdForAdmins($advertisement));
        }
        $advertisement->save();
        return redirect('website/sajatHirdetesek')->with('success', 'Az Adminisztrátor(ok)hoz befutott a hirdetésed! Értesítünk, amint elfogadták.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(advertisement $advertisement)
    {
        if (($advertisement->user_id == Auth::user()->id && $advertisement->approve == 1) || User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            if ($advertisement->user_id == Auth::user()->id && User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
                $advertisement->approve = true;
            }
            if ($advertisement->user_id == Auth::user()->id && !User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
                $advertisement->approve = false;
            }
            return view('website.advertisement')->with('mode', 'edit')->with('advertisement', $advertisement);
        } else
            abort(404);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, advertisement $advertisement)
    {
        if ($advertisement->user_id == Auth::user()->id || User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $advertisement->title = $request->title;
            $advertisement->name = $request->name;
            $advertisement->disappeared = $request->disappeared;
            $advertisement->zip_number = $request->zip_number;
            $advertisement->animal_type = $request->animal_type;
            $advertisement->comment = $request->comment;
            $advertisement->characteristics = $request->characteristics;
            $advertisement->phone_number = $request->phone_number;
            $advertisement->pre_phone_number = $request->pre_phone_number;
            $advertisement->chip = (($request->has('chip')) ? true : false);
            $advertisement->sex = $request->sex;
            $advertisement->search_find = $advertisement->search_find;
            $advertisement->approve = (($request->has('approve')) ? true : false);
            if($advertisement->approve==true){
                $advertisement->status="active";
            }
            else{
                $advertisement->status="inactive";
            }
            if ($request->hasFile('image_attach')) {
                $imageName = time() . '.' . $request->image_attach->getClientOriginalExtension();
                $request->image_attach->move(public_path('/assets/images/advertisement'), $imageName);
                $advertisement->image_attach = $imageName;
            }
            if ($advertisement->approve == 1 && $advertisement->status=="active") {
                $messageforuser = User::where('id', $advertisement->user_id)->first();
                $messageforuser->notify(new AdvertisementApprovedNotification($advertisement));
            }
            if ($advertisement->approve == 0) {
                $messageforusermodi = User::where('id', $advertisement->user_id)->first();
                $messageforusermodi->notify(new AdvertisementModifyNotification($advertisement));
                //
                $administrator = User::where('Admin', 1)->first();
                $advertisement->user_id == Auth::user()->id;
                $administrator->notify(new AdvertisementModifyForAdmins($advertisement));
            }
            $advertisement->save();
            return redirect('website/sajatHirdetesek')->with('success', 'Módosításod sikeresen végrehajtva!');
        } else
            abort(404);
    }
    public function openPDF($id)
    {
        $advertisement = advertisement::where('id', $id)->first();
        if (Auth::user()->id == $advertisement->user_id && $advertisement->search_find == "search" || User::where('id', Auth::user()->id)->where('Admin', 1)->count() == 1) {
            $advertisements = advertisement::where('id', $id)->where('approve', 1)->first();
            $url = "https://nyomozoo.hu/website/hirdetesReszletei/" . $id;
            // hirdetesPDF is the view that includes the downloading content

            // Set title in the PDF
            PDF::SetTitle("Nyomozoo.hu PDF generálás");
            PDF::AddPage();
            $view = \View::make('/website/hirdetesPDF', ['advertisements' => $advertisements]);
            $html_content = $view->render();
            PDF::writeHTML($html_content, true, false, true, false, '');
            $style = array(
                'border' => false,
                'padding' => 4,
                'fgcolor' => array(96, 191, 183),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1, // height of a single module in points
                'text-align' => 2
            );
            PDF::write2DBarcode($url, 'QRCODE,H', 151, 220, 80, 50, $style, 'N');
            PDF::Text(86, 271, '© 2022. Nyomozoo.hu');
            // sajathirdetes is the name of the PDF downloading
            PDF::Output('sajathirdetes_nyomozoo_hu.pdf');
        } else
            abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(advertisement $advertisement)
    {
       $advertisement->status="inactive";
       $advertisement->save();
    }
}
