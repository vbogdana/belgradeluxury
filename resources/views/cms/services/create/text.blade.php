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
                    <a href="{{ route('cms.services.texts', ['service' => $s->name_en]) }}">{{ $s->name_en }} ></a>&nbsp;
                    @if(isset($text))
                    Edit service text: {{ $text->title_en }}
                    @else
                    Create service text
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($text))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.services.texts.edit', ['service' => $s->name_en, 'textID' => $text->textID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.services.texts.create', ['service' => $s->name_en]) }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                            <label for="title_en" class="col-md-4 control-label">Title (eng) *</label>

                            <div class="col-md-6">
                                <input id="title_en" type="text" maxlength="255" class="form-control" name="title_en" value="{{ isset($text) ? $text->title_en : old('title_en') }}" required autofocus>

                                @if ($errors->has('title_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('title_sr') ? ' has-error' : '' }}">
                            <label for="title_sr" class="col-md-4 control-label">Title (ser) *</label>

                            <div class="col-md-6">
                                <input id="title_sr" type="text" maxlength="255" class="form-control" name="title_sr" value="{{ isset($text) ? $text->title_sr : old('title_sr') }}" required>

                                @if ($errors->has('title_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('subtitle1_en') ? ' has-error' : '' }}">
                            <label for="subtitle1_en" class="col-md-4 control-label">Top subtitle (eng)</label>

                            <div class="col-md-6">
                                <input id="subtitle1_en" type="text" maxlength="255" class="form-control" name="subtitle1_en" value="{{ isset($text) ? $text->subtitle1_en : old('subtitle1_en') }}">

                                @if ($errors->has('subtitle1_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subtitle1_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('subtitle1_sr') ? ' has-error' : '' }}">
                            <label for="subtitle1_sr" class="col-md-4 control-label">Top subtitle  (ser)</label>

                            <div class="col-md-6">
                                <input id="subtitle1_sr" type="text" maxlength="255" class="form-control" name="subtitle1_sr" value="{{ isset($text) ? $text->subtitle1_sr : old('subtitle1_sr') }}">

                                @if ($errors->has('subtitle1_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subtitle1_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('subtitle2_en') ? ' has-error' : '' }}">
                            <label for="subtitle2_en" class="col-md-4 control-label">Bottom subtitle (eng)</label>

                            <div class="col-md-6">
                                <input id="subtitle2_en" type="text" maxlength="255" class="form-control" name="subtitle2_en" value="{{ isset($text) ? $text->subtitle2_en : old('subtitle2_en') }}">

                                @if ($errors->has('subtitle2_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subtitle2_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('subtitle2_sr') ? ' has-error' : '' }}">
                            <label for="subtitle2_sr" class="col-md-4 control-label">Bottom subtitle (ser)</label>

                            <div class="col-md-6">
                                <input id="subtitle2_sr" type="text" maxlength="255" class="form-control" name="subtitle2_sr" value="{{ isset($text) ? $text->subtitle2_sr : old('subtitle2_sr') }}">

                                @if ($errors->has('subtitle2_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subtitle2_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('content_en') ? ' has-error' : '' }}">
                            <label for="content_en" class="col-md-4 control-label">Text (eng)</label>

                            <div class="col-md-6">
                                <textarea id="content_en" maxlength="1020" 
                                          rows="5" cols="70" class="form-control"
                                          name="content_en">{{ isset($text) ? $text->content_en : old('content_en') }}</textarea>
                                
                                @if ($errors->has('content_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('content_sr') ? ' has-error' : '' }}">
                            <label for="content_sr" class="col-md-4 control-label">Text (ser)</label>

                            <div class="col-md-6">
                                <textarea id="content_sr" maxlength="1020" 
                                          rows="5" cols="70" class="form-control" 
                                          name="content_sr">{{ isset($text) ? $text->content_sr : old('content_sr') }}</textarea>
                                
                                @if ($errors->has('content_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($text))
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Main image </label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}">
                                
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if (isset($text))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.services.texts', ['service' => $s->name_en]) }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
