@extends('layouts.main')

@section('title', 'Bem vindo')

@section('content')
<div id="search-container" class="col-md-12">
    <h1>Busque um Evento</h1>
    <form action="/events/view" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="inserir efeito digitação...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    <h2>Proximos Eventos</h2>
    <p class="subtitle">Veja os eventos nos proximos dias</p>
    <div id="cards-container" class="row">
        @foreach($events->sortByDesc('id') as $event)
        @if($event->private)
        @else
        <div class="card col-md-3" id="cards">
            <img src="/img/events/{{$event->image}}" class="img-fluid" alt={{$event->title}}>
            <div class="card-body">
                <p class="card-date">{{date('d/m/Y', strtotime($event->date))}}</p>
                <h5 class="card-title">{{$event->title}}</h5>
                <p class="card-participants">{{count($event->users)}} Participantes</p>
                <a href="/events/view/{{$event->id}}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endif
        @endforeach
        @if(count($events) == 0)
        <p>Sem eventos no momento, crie um novo evento!</p>

        @endif
    </div>
</div>
@endsection