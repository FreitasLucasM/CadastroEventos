<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

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
        $event->items = $request->items;
        $event->date = $request->date;


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;


            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);

            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        $user->eventsAsParticipants()->attach($event->id);

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }
    public function show($id)
    {
        $event = Event::FindOrFail($id);
        $eventOwner = User::FindOrFail($event->user_id);
        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }
    public function eventos()
    {
        $search = request('search');
        if ($search) {
            $events = Event::where([
                ['title', 'ilike', '%' . $search . '%']
            ])->get();
        } else {
            $events = Event::all();
        }
        return view('events.events', ['events' => $events, 'search' => $search]);
    }
    public function criar()
    {
        return view('events.create');
    }
    public function myDashboard()
    {
        $user = auth()->user();
        $events = $user->events;
        $eventsAsParticipant = $user->eventsAsParticipants;
        return view('dashboard', ['events' => $events, 'participate' => $eventsAsParticipant, 'user' => $user]);
    }
    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return redirect('dashboard')->with('msg', 'Evento excluido com sucesso!');
    }
    public function edit($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);
        if ($user->id != $event->user_id) {
            return redirect('dashboard');
        } else {
            return view('events.edit', ['event' => $event]);
        }
    }
    public function update(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;


            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);

            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }
        Event::findOrFail($request->id)->update($data);
        return redirect('dashboard')->with('msg', 'Evento atualizado com sucesso!');
    }
    public function participate($id)
    {
        $user = auth()->user();
        $event = Event::findOrFail($id);
        $eventUsers = $user->eventsAsParticipants;
        if ($user->id == $event->user_id) {
            return redirect('/')->with('alert', 'O usuario é o dono do evento');
        } else {
            foreach ($eventUsers as $eventUser) {
                if ($eventUser->id == $id) {
                    return redirect('/')->with('alert', 'O usuario ja participa do evento');
                }
            }
            $user->eventsAsParticipants()->attach($id);
            return redirect('/dashboard')->with('msg', 'Participação confirmada!');
        }
    }
    public function delete($id)
    {
        $user = auth()->user();
        $user->eventsAsparticipants()->detach($id);

        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', 'Participação do evento ' . $event->title . ' removida com sucesso');
    }
}
