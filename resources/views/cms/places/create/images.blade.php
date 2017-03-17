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
                    <a href="{{ route('cms.places') }}">Places ></a>&nbsp;
                    Add photos
                </div>
                <div class="panel-body">
                    <div class="panel-info" style="margin-bottom: 20px">
                        Here you can upload minimum 1 and maximum 5 photos at the same time. <br/>                        
                        For more photos you must repeat the process.
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.places.create.images', ['placeID' => $placeID]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('photo0') ? ' has-error' : '' }}">
                            <label for="photo0" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="photo0" type="file" name="photo0" value="{{ old('photo0') }}">
                                
                                @if ($errors->has('photo0'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo0') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        
                        <div class="form-group{{ $errors->has('photo1') ? ' has-error' : '' }}">
                            <label for="photo1" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="photo1" type="file" name="photo1" value="{{ old('photo1') }}">
                                
                                @if ($errors->has('photo1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        
                        <div class="form-group{{ $errors->has('photo2') ? ' has-error' : '' }}">
                            <label for="photo2" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="photo2" type="file" name="photo2" value="{{ old('photo2') }}">
                                
                                @if ($errors->has('photo2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        
                        <div class="form-group{{ $errors->has('photo3') ? ' has-error' : '' }}">
                            <label for="photo3" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="photo3" type="file" name="photo3" value="{{ old('photo3') }}">
                                
                                @if ($errors->has('photo3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        
                        <div class="form-group{{ $errors->has('photo4') ? ' has-error' : '' }}">
                            <label for="photo4" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="photo4" type="file" name="photo4" value="{{ old('photo4') }}">
                                
                                @if ($errors->has('photo4'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo4') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.places') }}">
                                    Cancel
                                </a>                    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
