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
                    @if(isset($place))
                    <a href="{{ route("cms.places") }}">Places ></a>&nbsp
                    {{ $place->title_en }} >&nbsp
                    @endif
                    All events
                </div>
                <div class="panel-heading">
                    @if(isset($place))
                    <a href="{{ route('cms.places.events.create', ['placeID' => $place->placeID]) }}">New event</a>
                    @else
                    <a href="{{ route('cms.events.create') }}">New event</a>
                    @endif
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
                            @if ($event->article->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$event->article->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <h4>{{ $event->article->title_en }}</h4>
                            @if ($event->place !== null)
                            <strong>Place: {{ $event->place->title_en }}</strong>
                            <br/>
                            @endif
                            @if ($event->article->category !== null)
                            <strong>Category: {{ $event->article->category->name_en }}</strong>
                            <br/>
                            @endif
                            <p>{{ $event->getDay() }}</p>
                            <p>{{ $event->date }}</p>
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.portal.articles.create.content', $event->article->category->name_en, $event->article->artID], 'method' => 'get']) }}
                            {{ Form::submit('Create sections', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.portal.articles.reorder', $event->article->category->name_en, $event->article->artID], 'method' => 'get']) }}
                            {{ Form::submit('Reorder sections', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.portal.articles.edit.sections', $event->article->category->name_en, $event->article->artID], 'method' => 'get']) }}
                            {{ Form::submit('Edit & Remove sections', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.events.edit', $event->evID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.events.edit.main-image', $event->evID], 'method' => 'get']) }}
                            {{ Form::submit('Edit event photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$event->evID}}">
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
                                                {{ Form::submit('Delete event', array('class' => 'btn btn-danger')) }}
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
