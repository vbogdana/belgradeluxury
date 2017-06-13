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
                    <a href="{{ route('cms.partners') }}">Partners ></a>&nbsp;
                    @if(isset($partner))
                    Edit Partner
                    @else
                    Create Partner
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($partner))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.partners.edit', ['partID' => $partner->partID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.partners.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('partner') ? ' has-error' : '' }}">
                            <label for="partner" class="col-md-4 control-label">Partner *</label>

                            <div class="col-md-6">
                                <input id="partner" type="text" maxlength="255" class="form-control" name="partner" value="{{ isset($partner) ? $partner->partner : old('partner') }}" required autofocus>

                                @if ($errors->has('partner'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('partner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">Link *</label>

                            <div class="col-md-6">
                                <input id="link" type="text" maxlength="255" class="form-control" name="link" value="{{ isset($partner) ? $partner->link : old('link') }}" required>

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($partner))
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image (640x480px transparent png, logo white max width 500px)</label>

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
                                    @if (isset($partner))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.partners') }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
