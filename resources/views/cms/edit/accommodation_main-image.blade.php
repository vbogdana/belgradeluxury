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
                <div class="panel-heading">Change main photo of an accommodation</div>
                <div class="panel-body">
                    <div class="panel-info" style="margin-bottom: 20px">
                        Here you can change the main photo of an accommodation.
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.edit.accommodation.main-image', ['accID' => $accID]) }}">
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
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
