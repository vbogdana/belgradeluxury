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
                    {{ $s['name_en'] }} >&nbsp;
                    All service texts
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.services.texts.create', ['service' => $s->name_en]) }}">New service text</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete a service text select 'Delete service text'.<br/>
                        To edit info about a service text select 'Edit data'.<br/>
                        To edit main photo of a service text select 'Edit main photo'.<br/>
                    </div>
                    @foreach($texts as $text)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($text->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$text->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <h4>
                            <strong>{{ $text->title_en }}</strong>
                            </h4>
                            @if ($text->subtitle1_en != null)
                            {{ $text->subtitle1_en }}<br/>                         
                            @endif
                            @if ($text->subtitle2_en != null)
                            {{ $text->subtitle2_en }}<br/>                           
                            @endif
                            <p>{{ $text->content_en }}</p>                            
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.services.texts.edit', $s->name_en, $text->textID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.services.texts.edit.main-image', $s->name_en, $text->textID], 'method' => 'get']) }}
                            {{ Form::submit('Edit text photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$text->textID}}">
                                Delete service text
                            </button>
                            <div class="modal fade" id="myModal{{$text->textID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete service text</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.services.texts.delete', $s->name_en, $text->textID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete service text', array('class' => 'btn btn-danger')) }}
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
                    
                    {{ $texts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
