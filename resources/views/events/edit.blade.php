@extends('layouts.main')

@section('title', $event->title . ': Editar')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando {{$event->title}}</h1>
    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Evento: </label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{$event->title}}">

        </div>
        <div class="form-group">
            <label for="Description">Descrição: </label>
            <textarea class="form-control" id="description" name="description" placeholder="O que vai acontecer no Evento?">{{$event->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="city">Cidade: </label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Cidade do evento" value="{{$event->city}}">
        </div>
        <div class="form-group">
            <label for="city">Evento Privado: </label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{$event->private == 1 ? "selected = 'selected'" : ""}}>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Data do Evento: </label>
            <input type="date" name="date" id="date" class="form-control" value="{{$event->date->format('Y-m-d')}}">
        </div>
        <div class="form-group">
            <label for="items">Adicione itens de infraestrutura: </label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras">Cadeiras
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco">Palco
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open-bar">Open Bar
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Climatizado">Ambiente Climatizado
            </div>
        </div>
        <div class="form-group">
            <label for="image">Imagem: </label>
            <input type="file" name="image" id="image" class="form-control-file">
            <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview">
        </div>
        <input type="submit" class="btn btn-primary" value="Editar Evento">
    </form>

</div>

@endsection