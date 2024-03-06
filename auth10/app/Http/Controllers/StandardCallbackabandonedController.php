<?php

namespace App\Http\Controllers;

use App\Models\Callbackonabandonedstandard;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StandardCallbackabandonedController extends Controller
{
    public function callbackonabandoned()
    {
        $time = now();

        // $languagecount = DB::select(
        //     "select A.Language `Language`,ifnull(B.Count,0) `Count` from (select Language FROM `language`)A left join (SELECT language ,count(*) `Count` from stand_callbackabandoned B 
        //     where flag = '0' and  updated_at < now()
        //     group by language)B on A.Language =B.language"
        // );
        $languagecount = DB::select("SELECT language as Language,count(*) as Count FROM stand_callbackabandoned
        where flag='0' and  updated_at < now() group by language");

        // dd($languagecount);
        return view('standardcallbackonabandoned.callbackonabandoned', compact('languagecount'));
    }

    public function report(Request $request)
    {

        if ($request->fromDate && $request->toDate) {
            $Datas = Callbackonabandonedstandard::whereRaw(
                "(created_at >= ? AND created_at <= ?)",
                [$request->fromDate . " 00:00:00", $request->toDate . " 23:59:59"]
            )->get();
            return view('standardcallbackonabandoned.report', compact('Datas'));
        } else {
            return view('standardcallbackonabandoned.report');
        }
    }
    public function getdetailsabandoned(Request $request)
    {

        $language = $request->lang;
        $now = now();
        // dd($time);
        $dateTime = new DateTime();
        $time = $dateTime->modify('+10 minutes');
        $language = Callbackonabandonedstandard::where('language', $language)
            ->where('flag', '=', '0')
            ->where('updated_at', '<', $now)
            ->first();
        if ($language) {
            Callbackonabandonedstandard::where('id', $language->id)->update(['updated_at' => $time]);
            // $upt = Callbackonabandoned::where('id', '=', $data->id)->update(['lockstatus' => '2']);
            // dd($language->created_at->format('Y-m-d'));
            $data2 = Callbackonabandonedstandard::whereNull('first_status')->whereNull('ReupdatedStatus')->where('mobile_no', '=', $language->mobile_no)->where('id', '!=', $language->id)->where('flag', '=', '0')
                // ->whereRaw(
                //     "(created_at >= ? AND created_at <= ?)",
                //     [$language->created_at->format('Y-m-d') . " 00:00:00", $language->created_at->format('Y-m-d') . " 23:59:59"]
                // )
                ->update(['flag' => 'B']);
        }
        // dd($language);
        return response($language);
    }

    public function submit(Request $request)
    {
        // dd($request->all());
        $dateTime = new DateTime();
        $time = $dateTime->modify('+10 minutes');
        $user = Auth::user()->email;
        $language = Callbackonabandonedstandard::where('id', $request->dataid)->first();
        // dd($language);
        $Callback = Callbackonabandonedstandard::find($request->dataid);
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
}
