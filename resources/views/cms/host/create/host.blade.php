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
                    <a href="{{ route('cms.host') }}">Hosts ></a>&nbsp;
                    @if(isset($host))
                    Edit Host
                    @else
                    Create Host
                    @endif
                </div>
                <div class="panel-body">
                    <div class="panel-info" style="color: red; padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        !!! PRILIKOM UBACIVANJA SKILLS - SVAKI JEZIK I SVAKI SKIL RAZDVOJITI ";" (tacka-zarezom) !!!
                    </div>
                    @if(isset($host))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.host.edit', ['hostID' => $host->hostID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.host.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" maxlength="255" class="form-control" name="name" value="{{ isset($host) ? $host->name : old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                                                                                              
                        <div class="form-group{{ $errors->has('skills_en') ? ' has-error' : '' }}">
                            <label for="skills_en" class="col-md-4 control-label">Skills & languages (eng)*</label>

                            <div class="col-md-6">
                                <textarea id="skills_en" maxlength="400" 
                                          rows="5" cols="70" class="form-control" required
                                          name="skills_en">{{ isset($host) ? $host->skills_en : old('skills_en') }}</textarea>
                                
                                @if ($errors->has('skills_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skills_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('skills_sr') ? ' has-error' : '' }}">
                            <label for="skills_sr" class="col-md-4 control-label">Skills & languages (ser)*</label>

                            <div class="col-md-6">
                                <textarea id="skills_sr" maxlength="400" 
                                          rows="5" cols="70" class="form-control" required 
                                          name="skills_sr">{{ isset($host) ? $host->skills_sr : old('skills_sr') }}</textarea>
                                
                                @if ($errors->has('skills_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('skills_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('hobbies_en') ? ' has-error' : '' }}">
                            <label for="hobbies_en" class="col-md-4 control-label">Hobbies (eng)</label>

                            <div class="col-md-6">
                                <textarea id="hobbies_en" maxlength="800" 
                                          rows="5" cols="70" class="form-control"
                                          name="hobbies_en">{{ isset($host) ? $host->hobbies_en : old('hobbies_en') }}</textarea>
                                
                                @if ($errors->has('hobbies_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hobbies_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('hobbies_sr') ? ' has-error' : '' }}">
                            <label for="hobbies_sr" class="col-md-4 control-label">Hobbies (ser)</label>

                            <div class="col-md-6">
                                <textarea id="hobbies_sr" maxlength="800" 
                                          rows="5" cols="70" class="form-control" 
                                          name="hobbies_sr">{{ isset($host) ? $host->hobbies_sr : old('hobbies_sr') }}</textarea>
                                
                                @if ($errors->has('hobbies_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hobbies_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($host))
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
                                    @if (isset($host))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.host') }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
