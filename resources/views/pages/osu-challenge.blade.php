@extends('layouts.default')
@section('content')
    <div class="col-md-12 text-center">
        <div class="btn-group btn-group-lg">
            <a href="/challenges" class="btn btn-primary">View Challenges!</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createChallengeModal">Create
                Challenge!
            </button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createChallengeModal" tabindex="-1" role="dialog" aria-labelledby="createChallengeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createChallengeModalLabel">Create Challenge</h5>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('action' => 'ChallengeController@store')) }}
                    <div class="form-group">
                        {!! Form::label('name', 'Challenge Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('players', 'Players') !!}
                        {!! Form::text('players', '', array('class' => 'form-control', 'placeholder'=>'player1;player2;..')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('beatmaps', 'maps') !!}
                        {!! Form::text('beatmaps', '', array('class' => 'form-control', 'placeholder'=>'map1;map2;..')) !!}
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    {!! Form::submit('Create challenge', ['class' => 'btn btn-info']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection