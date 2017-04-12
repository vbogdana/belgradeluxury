<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -
-->

@extends('layouts.cms')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All vehicles
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.vehicles.create') }}">New vehicle</a>
                </div>
                <div class='panel-heading'>
                    {{ Form::open(['route' => 'cms.vehicles', 'method' => 'post', 'class' => 'form-horizontal']) }}
                    <div class="form-group{{ $errors->has('people') ? ' has-error' : '' }}">
                        <label for="people" class="col-md-3 control-label">Filter By Number of People</label>

                        <div class="col-md-6">
                            <input id="people" type="range" min="1" max="20" step="1" class="form-control" name="people" value="{{ old('people') }}" onchange="showPeople()">

                            @if ($errors->has('people'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('people') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-2">
                            <input id="peopleText" type="text" disabled="">
                        </div>
                    </div>
                    <div class='form-group text-center'>
                        {{ Form::submit('Filter', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                    </div>
                    {{ Form::close() }}
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete a vehicle select 'Delete vehicle'.<br/>
                        To edit info about an vehicle select 'Edit data'.<br/>
                        To edit main photo of an vehicle select 'Edit main photo'.<br/>
                        To add additional photos to an vehicle select 'Add photos'.<br/>
                        To remove photos from an vehicle select 'Remove photos'.
                    </div>
                    @foreach($vehicles as $veh)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($veh->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$veh->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <a href='{{ route("vehicles.vehicle", ['vehID' => $veh->vehID, 'title' => $veh->model]) }}' target="_blank">
                                <h4>{{ $veh->model }}</h4>
                            </a>                     
                            {{ $veh->brand }}
                            <br/><strong>{{ $veh->people }} people</strong>
                            <br/><strong>{{ $veh->price }}€</strong>
                            @if ($veh->link != null)
                            <br/><a href="{{ $veh->link }}">{{ $veh->link }}</a>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.vehicles.edit', $veh->vehID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.vehicles.edit.main-image', $veh->vehID], 'method' => 'get']) }}
                            {{ Form::submit('Edit main photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$veh->vehID}}">
                                Delete a vehicle
                            </button>
                            <div class="modal fade" id="myModal{{$veh->vehID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete a vehicle</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.vehicles.delete', $veh->vehID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete vehicle', array('class' => 'btn btn-danger')) }}
                                                <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.vehicles.create.images', $veh->vehID], 'method' => 'get']) }}
                            {{ Form::submit('Add photos', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.vehicles.delete.images', $veh->vehID], 'method' => 'get']) }}
                            {{ Form::submit('Remove photos', array('class' => 'btn btn-primary')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $vehicles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>   
    function showPeople() {
        var people = $('#people').val();
        $('#peopleText').attr('value', people);
    }
    
    showPeople();

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            window.location = window.location.href + '&page=' + page;
        });
    });
</script>
@stop
