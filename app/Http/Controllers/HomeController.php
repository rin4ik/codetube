<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserRepository $users)
    {
        return view('home', [
            'subscriptionVideos' => $users->videosFromSubscriptions($request->user())
        ]);
    }
}
