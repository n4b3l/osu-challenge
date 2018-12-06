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
        foreach ($beatmap_ids as $beatmap_id) {
            $map = DB::table('map_title_tt')->where('map_id',$beatmap_id)->first();
            if($map !== null) {
                $beatmap_name = $map->artist . " - " . $map->title;
            }
            else{
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://osu.ppy.sh/api/get_beatmaps",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"k\"\r\n\r\n" . \Config::get('values.OSU_API_KEY') . "\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"b\"\r\n\r\n" . $beatmap_id . "\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
                    CURLOPT_HTTPHEADER => array(
                        "Postman-Token: 0ba1199b-c949-4987-bdb6-a819ad1ff247",
                        "cache-control: no-cache",
                        "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
                    ),
                ));
                $resp = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $data = json_decode($resp, true);
                    $beatmap_name = $data[0]['artist'] . ' - ' . $data[0]['title'];
                    DB::table('map_title_tt')->insert(
                        ['map_id'=>$beatmap_id,'title'=>$data[0]['title'],'artist'=>$data[0]['artist']]
                    );
                }
            }
            foreach ($users as $user){
                DB::table('challenge_user_tt')->insert(
                    ['challenge_id'=>$challenge->id,'user_id'=>$user,'score'=>0,'beatmap_id'=>$beatmap_id,'beatmap_name'=>$beatmap_name]
                );
            }
        }
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
