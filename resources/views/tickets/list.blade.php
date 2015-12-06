@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <h1>
                    Solicitudes Populares
                    <a href="#" class="btn btn-primary">
                        Nueva solicitud
                    </a>
                </h1>

                <p class="label label-info news">
                    Hay 20 Solicitudes Populares
                </p>

                @foreach($tickets as $ticket)
                    @include('tickets.partials.item', compact('ticket'))
                @endforeach

                <ul class="pagination">
                    <li class="disabled"><span>&laquo;</span></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="http://teachme.app/populares/?page=2">2</a></li> <li><a href="http://teachme.app/populares/?page=2" rel="next">&raquo;</a></li>
                </ul>
            </div>

            <hr>

            <p><a href="http://duilio.me" target="_blank">duilio.me</a></p>

        </div>
    </div>
</div>
@endsection
