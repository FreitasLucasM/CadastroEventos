@extends('layouts.main')

@section('title', 'Bem vindo')

@section('content')
        <div id="search-container" class="col-md-12">
            <h1>Busque um Evento</h1>
            <form action="">
                <input type="text" id="search" name="search" class="form-control" placeholder="inserir efeito digitação...">
            </form>

        </div>
        <div id="events-container" class="col-md-12">
            <h2>Proximos Eventos</h2>
            <p class="subtitle">Veja os eventos nos proximos dias</p>
            <div id="cards-container" class="row">
                @foreach($events->sortByDesc('id') as $event)

            
                <div class="card col-md-3">
                    <img src="/img/events/{{$event->image}}" alt={{$event->title}}>
                    <div class="card-body">
                        <p class="card-date">10/09/2022</p>
                        <h5 class="card-title">{{$event->title}}</h5>
                        <p class="card-participants">X participantes</p>
                        <a href="/events/view/{{$event->id}}" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
@endsection
