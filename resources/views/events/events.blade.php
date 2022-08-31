@extends('layouts.main')

@section('title', 'Eventos')

@section('content')

<div id="search-container-event" class="col-md-12">
    <form action="/events/view" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="inserir efeito digitação...">
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Voce esta pesquisando por {{$search}}</h2>
    @else
    <h2>Proximos Eventos</h2>
    @endif
    <div id="cards-container" class="row">
        @foreach($events->sortByDesc('id') as $event)


        <div class="card col-md-3" id="cards">
            <img src="/img/events/{{$event->image}}" class="img-fluid" alt={{$event->title}}>
            <div class="card-body">
                <p class="card-date">{{date('d/m/Y', strtotime($event->date))}}</p>
                <h5 class="card-title">{{$event->title}}</h5>
                <p class="card-participants">X participantes</p>
                <a href="/events/view/{{$event->id}}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>

        @endforeach
        @if(count($events) == 0)
        <p>Sua busca não teve resultados! <a href="/events/view">Ver todos.</a></p>

        @endif
    </div>
</div>

@endsection