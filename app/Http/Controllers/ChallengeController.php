<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request...

        $challenge= new Challenge();

        $challenge->fill([
            'name' => $request->name,
            'map_ids' => $request->beatmaps,
            'user_ids' => $request->players
        ]);

        $challenge->save();
        $beatmap_ids = explode(";",  $request->beatmaps);
        $users = explode(";", $request->players);
        foreach ($beatmap_ids as $beatmap) {

        }
        DB::table('challenge_user_tt')->insert(
            ['challenge_id'=>0,'user_id'=>'','score'=>0,'beatmap_id'=>0,'beatmap_name'=>'']
        );
        return redirect()->to('challenges');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        //
    }
}
