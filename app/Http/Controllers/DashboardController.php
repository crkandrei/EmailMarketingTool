<?php

namespace App\Http\Controllers;



use App\Models\Group;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the view of the customer.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
       return view('data.dashboard')->with('templates', Template::where('user_id',Auth::user()->id)->get())->with('groups', Group::where('user_id',Auth::user()->id)->get());
    }

}
