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
                            <h4>{{ $veh->model }}</h4>                           
                            {{ $veh->brand }}
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
                            
                            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$veh->vehID}}">
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
                                                {{ Form::submit('Delete vehicle', array('class' => 'btn btn-primary')) }}
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
