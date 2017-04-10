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
                    All places
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.places.create') }}">New place</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete a place select 'Delete place'.<br/>
                        To edit info about an place select 'Edit data'.<br/>
                        To edit main photo of an place select 'Edit main photo'.<br/>
                        To add additional photos to an place select 'Add photos'.<br/>
                        To remove photos from an place select 'Remove photos'.
                    </div>
                    @foreach($places as $place)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($place->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$place->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <h4>{{ $place->title_en }}</h4> 
                            <strong class="text-uppercase">{{ $place->type }}</strong>
                            <br/>
                            {{ $place->address }}
                            <br/><strong>priority: {{ $place->getPriority() }}</strong>
                            @if ($place->link != null)
                            <br/><a href="{{ $place->link }}">{{ $place->link }}</a>
                            @endif
                            @if ($place->phone != null)
                            <br/><a href="tel:{{ $place->phone }}">{{ $place->phone }}</a>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.places.edit', $place->placeID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.places.edit.main-image', $place->placeID], 'method' => 'get']) }}
                            {{ Form::submit('Edit main photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$place->placeID}}">
                                Delete a place
                            </button>
                            <div class="modal fade" id="myModal{{$place->placeID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete a place</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.places.delete', $place->placeID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete place', array('class' => 'btn btn-danger')) }}
                                                <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.places.events.create', $place->placeID], 'method' => 'get']) }}
                            {{ Form::submit('Add an event', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.places.events', $place->placeID], 'method' => 'get']) }}
                            {{ Form::submit('View all events', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.places.create.images', $place->placeID], 'method' => 'get']) }}
                            {{ Form::submit('Add photos', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.places.delete.images', $place->placeID], 'method' => 'get']) }}
                            {{ Form::submit('Remove photos', array('class' => 'btn btn-primary')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $places->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
