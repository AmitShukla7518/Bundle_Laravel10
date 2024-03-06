<?php

namespace App\Http\Controllers;

use App\Models\Callbackstandard;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StandardCallBackController extends Controller
{
    public function callbacklist()
    {
        return view('standardcallback.callbacklist');
    }
    public function callbacklistcreate(Request $request)
    {
        Callbackstandard::create([
            'mobile_no' => $request->mobile_no,
            'language' => $request->language,
            'flag' => "0",
            "created_by" => Auth::user()->email,
        ]);
        return back()->with("success", "Added Successfully!");
    }

    public function callback()
    {

        $time = now();
        // $languagecount = DB::table('call_back_list')
        //     ->select('language', DB::raw('count(*) as total'))
        //     ->groupBy('language')
        //     ->where('flag', '!=', "1")
        //     ->where('updated_at', '<', $time)
        //     ->get();
        $languagecount = DB::select(
            "select A.Language `Language`,ifnull(B.Count,0) `Count` from (select Language FROM `language`)A left join (SELECT language ,count(*) `Count` from stand_call_back_list B 
            where flag = '0' and  updated_at < now()
            group by language)B on A.Language =B.language"
        );
        // echo $languagecount;
        // dd($languagecount);
        return view('standardcallback.callback', compact('languagecount'));
    }

    public function getlangdetails(Request $request)
    {
        $language = $request->lang;

        // dd($time);
        $now = now();
        $dateTime = new DateTime();
        $time = $dateTime->modify('+15 minutes');
        $language = Callbackstandard::where('language', $language)
            ->where('updated_at', '<', $now)
            ->where('flag', '0')

            ->first();
        if ($language) {
            Callbackstandard::where('id', $language->id)->update(['updated_at' => $time]);
        }
        // dd($language);
        return response($language);
    }


    public function updatedetail(Request $request)
    {
        $dateTime = new DateTime();
        $time = $dateTime->modify('+15 minutes');
        $user = Auth::user()->email;
        $language = Callbackstandard::where('id', $request->dataid)->first();
        // dd($language);
        $Callback = Callbackstandard::find($request->dataid);
        if ($language->first_status = '' || $language->first_status == null) {
            $Callback->first_status = $request->status;
        } else {
            $Callback->ReupdatedStatus = $request->status;
            $Callback->flag = "1";
        }

        if ($language->updated_by = '' || $language->updated_by == null) {
            $Callback->updated_by = $user;
        } else {
            $Callback->re_updated_by = $user;
        }
        // if ($language->first_status != '' || $language->first_status != null) {
        //     $Callback->flag = "1";
        // }
        if ($request->status == 'Not-connected') {
            $Callback->updated_at = $time;
        }
        if ($request->status == 'Connected') {
            $Callback->flag = "1";
        }
        if ($language->CallbackTime = '' || $language->CallbackTime == null) {
            $Callback->CallbackTime = now();
        } else {
            $Callback->UpdatedCallbackTime = now();
        }
        $Callback->update();
        return back()->with('success', "Updated Successfully!");
    }

    public function reportview(Request $request)
    {
        if ($request->fromDate && $request->toDate) {
            $Datas = Callbackstandard::whereRaw(
                "(created_at >= ? AND created_at <= ?)",
                [$request->fromDate . " 00:00:00", $request->toDate . " 23:59:59"]
            )->get();
            return view('standardcallback.report', compact('Datas'));
        } else {
            return view('standardcallback.report');
        }
    }
}
