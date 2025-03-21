@extends('layouts.master')
@section('content')
    <div>
        <div class="container">
            <div class="blanc">
                <h1>{{$title}}</h1>
            </div>
            {!! Form::open(['route'=>'postGenre']) !!}
            <div class="form-group">
                <label class="col-md-3 control-label">Genre :</label>
                <div class="col-md-6 ">
                    <select name="sel_genre" id="champgenre">
                        <option value="0" disabled selected="selected">Sélectionner un genre</option>

                        @foreach ($genre as $unG)
                            <option value="{{$unG->id_genre}}"
                            >{{$unG->lib_genre}}</option>
                        @endforeach

                    </select>
                </div>
            </div>




            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-default btn-primary"><span
                            class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="{ window.location = '{{ url('/listerMangas') }}';}">
                        <span class="glyphicon glyphicon-remove"></span>Annuler
                    </button>
                </div>
            </div>

        </div>
    </div>
