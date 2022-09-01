@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-10 offset-md1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td><a href="/events/view/{{$event->id}}">{{$event->title}}</a></td>
                <td>{{count($event->users)}}</td>
                <td>
                    <form action="/events/edit/{{$event->id}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-info edit-btn">
                            <ion-icon name="create-outline"></ion-icon> Editar
                        </button>
                    </form>
                    <form action="/events/view/{{$event->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon>
                            Deletar
                        </button>
                    </form>
                </td>
            </tr>

            @endforeach

        </tbody>

    </table>

    @else
    <p>Você ainda não possui eventos, <a href="/events/create">criar evento</a></p>
    @endif
</div>
<div class="col-md-10 offset-md1 dashboard-title-container">
    <h1>Eventos com presença confirmada</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">

    @if(count($participate) > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participate as $event)
            @if($event->user_id != $user->id)
            <tr>
                <td><a href="/events/view/{{$event->id}}">{{$event->title}}</a></td>
                <td>{{count($event->users)}}</td>
                <td>
                    <form action="/events/leave/{{$event->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon>
                            Não participar
                        </button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>

    </table>

    @else
    <p>Você ainda não participa de nenhum evento, <a href="/events/view">todos os eventos</a></p>
    @endif
</div>

@endsection