<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('welcome', ['events' => $events]);
    }

    public function store(Request $request)
    {
        $event = new Event;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->city = $request->city;
        $event->private = $request->private;


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;


            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);

            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }
        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }
    public function show($id)
    {

        $event = Event::FindOrFail($id);
        return view('events.show', ['event' => $event]);
    }
    public function eventos()
    {
        return view('events.events');
    }
    public function criar()
    {
        return view('events.create');
    }
    public function logar()
    {
        return view('sign.signin');
    }
    public function cadastrar()
    {
        return view('sign.signup');
    }
}
