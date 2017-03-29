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
                    All events
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.events.create') }}">New event</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete an event select 'Delete event'.<br/>
                        To edit info about an event select 'Edit data'.<br/>
                        To edit main photo of an event select 'Edit main photo'.<br/>
                    </div>
                    @foreach($events as $event)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($event->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$event->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <h4>{{ $event->title_en }}</h4>
                            <br/>
                            @if ($event->place !== null)
                            <strong>Place: {{ $event->place->title_en }}</strong>
                            @endif
                            <p>{{ $event->getDay() }}</p>
                            <p>{{ $event->date }}</p>
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.events.edit', $event->evID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.events.edit.main-image', $event->evID], 'method' => 'get']) }}
                            {{ Form::submit('Edit event photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$event->evID}}">
                                Delete an event
                            </button>
                            <div class="modal fade" id="myModal{{$event->evID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete an event</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.events.delete', $event->evID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete event', array('class' => 'btn btn-primary')) }}
                                                <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
