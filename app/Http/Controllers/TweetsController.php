<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet; //Need to pull in our model to use it.
use App\User; // Let's pull in our User model!
use Auth; //Need to pull in Auth in order to use it.

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tweets = Tweet::query()
                    ->join( 'users', 'tweets.user_id', '=', 'users.id' )
                    ->get();

        Return view('tweeter.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        if ($user)
          return view('tweeter.create');
        else //Uh oh, logged out. Redirect.
          return redirect('/tweeter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // assign and check user all at once.
        if ($user = Auth::user()) { //Proceed and store data if the user is logged in.
          $validatedData = $request->validate(array(
                  'message' => 'required|max:240'
              ));
              $tweet = new Tweet;
              $tweet->user_id = $user->id;
              $tweet->message = $validatedData['message'];
              $tweet->save();

          return redirect('/tweeter')->with('success', 'Tweet has been saved.');
        }
        return redirect('/tweeter');
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
        $tweet = Tweet::findOrFail($id);
        $tweetUser = $tweet->user()->get()[0];
        return view('tweeter.show', compact('tweet'), compact('tweetUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
      if ($user = Auth::user()) {
        $tweet = Tweet::findOrFail($id);

        return view('tweeter.edit', compact('tweet'));
      }

      return redirect('/tweeter');

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
        //
      if ($user = Auth::user()) {
        $validatedData = $request->validate(array(
          'message' => 'required|max:240',
          ));

          Tweet::whereId($id)->update($validatedData);

          return redirect('/tweeter')->with('success', 'Tweet has been updated.');
      }
        return redirect('/tweeter');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      if ($user = Auth::user()) {
        $tweet = Tweet::findOrFail($id);

        $tweet->delete();

        return redirect('/tweeter')->with('success', 'Tweet has been deleted.');
      }
        return redirect('/tweeter');
    }

}
