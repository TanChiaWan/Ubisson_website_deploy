<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RetrieveController extends Controller
{
    public function retrieveorg(Request $request)
    {
        $searchData = $request->all();

        $organizations = DB::table('organizations')->where($searchData)->get();
    
        return view('organization_list', ['organizations' => $organizations]);
    }

}