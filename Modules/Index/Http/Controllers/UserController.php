<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function preferences()
    {
    	return view('index::user.preferences', ['user'=>Auth::user()  ]);
    }


    public function savePreferences( Request $request, User $user )
    {
    	$user->update($request->only([
    		'show_blueprint_options',
		    'show_question_tree',
		    'show_option_pricing_in_index',
		    ]));
    	$user->save();
    	return redirect()->back()->with('message','Saved Changes');
    }
}
