@extends('layouts.app')

@section('content')
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Főoldal</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3 style="text-align: center">Tartalom</h3>
                    <div id="posts" class="col-sm-12 row">

                        <div id="prod-pic" class="col-sm-6 column">
                            <img class="side-pic" src="/pictures/hir.jpeg";>
                            <h3 style="text-align: center">{{ $postsNum }} db hír</h3>
                        </div>
                        
                        <div id="prod-pic" class="col-sm-6 column"><br>
                            <img id="album-pic" class="side-pic" src="/pictures/camera.jpeg";><br>
                            <h3 style="text-align: center">{{ $albumsNum }} db album</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
@endsection
