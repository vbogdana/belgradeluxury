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
                    <a href="{{ route('cms.testemonials') }}">Testemonials ></a>&nbsp;
                    @if(isset($testemonial))
                    Edit Testemonial
                    @else
                    Create Testemonial
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($testemonial))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.testemonials.edit', ['testID' => $testemonial->testID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.testemonials.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                            <label for="author" class="col-md-4 control-label">Author</label>

                            <div class="col-md-6">
                                <input id="author" type="text" maxlength="255" class="form-control" name="author" value="{{ isset($testemonial) ? $testemonial->author : old('author') }}" autofocus>

                                @if ($errors->has('author'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('profession_en') ? ' has-error' : '' }}">
                            <label for="profession_en" class="col-md-4 control-label">Profession (eng)*</label>

                            <div class="col-md-6">
                                <input id="profession_en" type="text" maxlength="255" class="form-control" name="profession_en" value="{{ isset($testemonial) ? $testemonial->profession_en : old('profession_en') }}" required>

                                @if ($errors->has('profession_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profession_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('profession_sr') ? ' has-error' : '' }}">
                            <label for="profession_sr" class="col-md-4 control-label">Profession (ser)*</label>

                            <div class="col-md-6">
                                <input id="profession_sr" type="text" maxlength="255" class="form-control" name="profession_sr" value="{{ isset($testemonial) ? $testemonial->profession_sr : old('profession_sr') }}" required>

                                @if ($errors->has('profession_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profession_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('content_en') ? ' has-error' : '' }}">
                            <label for="content_en" class="col-md-4 control-label">Testemonial (eng)*</label>

                            <div class="col-md-6">
                                <textarea id="content_en" maxlength="800" 
                                          rows="5" cols="70" class="form-control" required
                                          name="content_en">{{ isset($testemonial) ? $testemonial->content_en : old('content_en') }}</textarea>
                                
                                @if ($errors->has('content_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('content_sr') ? ' has-error' : '' }}">
                            <label for="content_sr" class="col-md-4 control-label">Testemonial (ser)*</label>

                            <div class="col-md-6">
                                <textarea id="content_sr" maxlength="800" 
                                          rows="5" cols="70" class="form-control" required 
                                          name="content_sr">{{ isset($testemonial) ? $testemonial->content_sr : old('content_sr') }}</textarea>
                                
                                @if ($errors->has('content_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($testemonial))
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Main image (square dimensions)</label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image" value="{{ old('image') }}">
                                
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
                                    @if (isset($testemonial))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.testemonials') }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
