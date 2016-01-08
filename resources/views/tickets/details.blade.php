@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="title-show">
                {{ $ticket->title }}
                
                @include('tickets.partials.status', compact('ticket'))
                
            </h2>

            @if ($ticket->link)
                <p>
                    <a href="{{ $ticket->link }}" target="_blank" class="btn btn-info">Ver recurso</a>
                </p>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
    
            <p class="date-t">
                <span class="glyphicon glyphicon-time"></span> {{ $ticket->created_at->format('d/m/Y h:ia')}}
                - {{ $ticket->author->name }}
            </p>

            <h4 class="label label-info news">
                {{ count($ticket->voters) }} votos            
            </h4>
            
            <p class="vote-users">
                @foreach($ticket->voters as $user)
                    <span class="label label-info">{{ $user->name }}</span>
                @endforeach
            </p>
            
            @if (currentUser())
                @if(! currentUser()->hasVoted($ticket))
                {!! Form::open(['route' => ['votes.submit', $ticket->id], 'method' => 'POST']) !!}
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-thumbs-up"></span> Votar
                    </button>
                {!! Form::close() !!}
                @else
                {!! Form::open(['route' => ['votes.destroy', $ticket->id], 'method' => 'DELETE']) !!}
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-thumbs-down"></span> Eliminar Voto
                    </button>
                {!! Form::close() !!}
                @endif
            

                <h3>Nuevo Comentario</h3>
                
                @include('partials.errors')
                {!! Form::open(['route' => ['comments.submit', $ticket->id], 'method' => 'POST']) !!}
                    <div class="form-group">
                        <label for="comment">Comentarios:</label>
                        <textarea rows="4" class="form-control" name="comment" cols="50" id="comment">{{ old('comment') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Enlace:</label>
                        <input class="form-control" name="link" type="text" id="link" value="{{ old('link') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar comentario</button>
                {!! Form::close() !!}
            @endif

            <h3>Comentarios ({{ count($ticket->comments) }})</h3>
            
            @foreach($ticket->comments as $comment)
                <div {!! Html::classes(['well well-sm', 'well-selected' => $comment->selected ]) !!}>
                    <p><strong>{{ $comment->user->name }}</strong></p>
                    <p>{{ $comment->comment }}</p>
                    @if ($comment->link)
                        <p>
                            <a href="{{ $comment->link }}" rel="nofollow" target="_blank">
                                {{ $comment->link }}
                            </a>
                        </p>
                        
                        @can('selectResource', $ticket)
                        @if ($ticket->status == 'open')
                            {!! Form::open(['route' => ['tickets.select', $ticket, $comment]]) !!}
                                {!! Form::submit('Seleccionar tutorial', [
                                    'class' => 'btn btn-info'
                                ]) !!}
                            {!! Form::close() !!}
                            @endcan
                        @endif
                    @endif
                    <p class="date-t">
                        <span class="glyphicon glyphicon-time"></span>
                        {{ $comment->created_at->format('d/m/Y h:ia') }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection