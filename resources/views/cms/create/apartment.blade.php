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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Apartment</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/cms/create/apartment') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                            <label for="title_en" class="col-md-4 control-label">Title (eng)*</label>

                            <div class="col-md-6">
                                <input id="title_en" type="text" maxlength="150" class="form-control" name="title_en" value="{{ old('title_en') }}" required autofocus>

                                @if ($errors->has('title_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('title_ser') ? ' has-error' : '' }}">
                            <label for="title_ser" class="col-md-4 control-label">Title (ser)*</label>

                            <div class="col-md-6">
                                <input id="title_ser" type="text" maxlength="150" class="form-control" name="title_ser" value="{{ old('title_ser') }}" required autofocus>

                                @if ($errors->has('title_ser'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_ser') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address*</label>

                            <div class="col-md-6">
                                <input id="address" type="text" maxlength="200" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description_en" class="col-md-4 control-label">Description (eng)</label>

                            <div class="col-md-6">
                                <textarea id="description_en" maxlength="800" rows="5" cols="70" class="form-control" name="description_en" value="{{ old('description_en') }}" autofocus>
                                </textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description_ser" class="col-md-4 control-label">Description (ser)</label>

                            <div class="col-md-6">
                                <textarea id="description_ser" maxlength="800" rows="5" cols="70" class="form-control" name="description_ser" value="{{ old('description_ser') }}" autofocus>
                                </textarea>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('geoWidth') ? ' has-error' : '' }}">
                            <label for="geoWidth" class="col-md-4 control-label">Geo Width*</label>

                            <div class="col-md-6">
                                <input id="geoWidth" type="text" maxlength="100" class="form-control" name="geoWidth" value="{{ old('geoWidth') }}" required autofocus>

                                @if ($errors->has('geoWidth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geoWidth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('geoHeight') ? ' has-error' : '' }}">
                            <label for="geoHeight" class="col-md-4 control-label">Geo Height*</label>

                            <div class="col-md-6">
                                <input id="geoHeight" type="text" maxlength="100" class="form-control" name="geoHeight" value="{{ old('geoHeight') }}" required autofocus>

                                @if ($errors->has('geoHeight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geoHeight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="link" class="col-md-4 control-label">Website link</label>

                            <div class="col-md-6">
                                <input id="link" type="text" maxlength="400" class="form-control" name="link" value="{{ old('link') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('people') ? ' has-error' : '' }}">
                            <label for="people" class="col-md-4 control-label">Number of people*</label>

                            <div class="col-md-6">
                                <input id="people" type="number" min="1" max="20" step="1" class="form-control" name="people" value="{{ old('people') }}" required autofocus>

                                @if ($errors->has('people'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('people') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="tv" class="col-md-4 control-label">TV</label>

                            <div class="col-md-6">
                                <input id="tv" type="checkbox" class="form-control" name="tv" value="{{ old('tv') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="hottub" class="col-md-4 control-label">Hot tub</label>

                            <div class="col-md-6">
                                <input id="hottub" type="checkbox" class="form-control" name="hottub" value="{{ old('hottub') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="wifi" class="col-md-4 control-label">WiFi</label>

                            <div class="col-md-6">
                                <input id="wifi" type="checkbox" class="form-control" name="wifi" value="{{ old('wifi') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="bar" class="col-md-4 control-label">Bar</label>

                            <div class="col-md-6">
                                <input id="bar" type="checkbox" class="form-control" name="bar" value="{{ old('bar') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="airCondition" class="col-md-4 control-label">Air Condition</label>

                            <div class="col-md-6">
                                <input id="airCondition" type="checkbox" class="form-control" name="airCondition" value="{{ old('airCondition') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="parking" class="col-md-4 control-label">Parking</label>

                            <div class="col-md-6">
                                <input id="parking" type="checkbox" class="form-control" name="parking" value="{{ old('parking') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="cityCenter" class="col-md-4 control-label">City Center</label>

                            <div class="col-md-6">
                                <input id="cityCenter" type="checkbox" class="form-control" name="cityCenter" value="{{ old('cityCenter') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
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
