<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Kullanici;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalenderController extends Controller
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
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /*   $data['events'] = Event::all();
        $data['kullanici'] = Kullanici::all();
        for ($i = 0; $i < count($data['events']); $i++) {
            foreach ($data['kullanici'] as $user) {
                if ($data['events'][$i]['kullanici_id'] == $user['kullanici_id']) {
                    $data['events'][$i]['kullanici'] = $user['kullanici_adsoyad'];
                }
            }
        } */
        if ($request->ajax()) {

            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)

                ->get(['id', 'title', 'color', 'aciklama', 'kullanici_name', 'start', 'end']);


            return response()->json($data);
        }

        return view('index');
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
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addEvents(Request $request)
    {


        //$company   =  DB::insert('insert into events ( title, aciklama, color, kullanici_id, start, end) values (?, ?,?,?,?,?)', [$_POST['title'], $_POST['aciklama'], $_POST['color'], '44', $_POST['start'], $_POST['end']]);

        if ($request->ajax()) {


            $event = Event::create([
                'title' => $request->title,
                'aciklama' => $request->aciklama,
                'color' => $request->color,
                'start' => $request->start,
                'end' => $request->end,
                'kullanici_name' => $request->kullanici_id,

            ]);
            return response()->json($event);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editFormEvents(Request $request)
    {


        if ($request->ajax()) {


            $event = Event::updateorcreate(
                [
                    'id' => $request->id,
                ],
                [

                    'title' => $request->title,
                    'aciklama' => $request->aciklama,
                    'color' => $request->color,



                ]
            );
        }
        return response()->json($event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editEvents(Request $request)
    {


        if ($request->ajax()) {

            if ($request->drop == true) {
                $event = Event::updateorcreate(
                    [
                        'id' => $request->id,
                    ],
                    [

                        'start' => $request->start,
                        'end' => $request->end,


                    ]
                );
            } else {
                $event = Event::updateorcreate(
                    [
                        'id' => $request->id,
                    ],
                    [

                        'title' => $request->title,
                        'aciklama' => $request->aciklama,
                        'color' => $request->color,



                    ]
                );
            }
            return response()->json($event);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Events  $calender
     * @return \Illuminate\Http\Response
     */
    public function show(Event $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $events)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $events)
    {
        //
    }
}
