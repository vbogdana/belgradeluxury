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
                    <a href="{{ route('cms.accommodation.apartments') }}">Apartments ></a>&nbsp;
                    @if(isset($accommodation))
                    Edit Apartment
                    @else
                    Create Apartment
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($accommodation))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.accommodation.apartment.edit', ['accID' => $accommodation->accID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.accommodation.apartment.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                            <label for="title_en" class="col-md-4 control-label">Title (eng)*</label>

                            <div class="col-md-6">
                                <input id="title_en" type="text" maxlength="150" class="form-control" name="title_en" value="{{ isset($accommodation) ? $accommodation->title_en : old('title_en') }}" required autofocus>

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
                                <input id="title_ser" type="text" maxlength="150" class="form-control" name="title_ser" value="{{ isset($accommodation) ? $accommodation->title_ser : old('title_ser') }}" required>

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
                                <input id="address" type="text" maxlength="200" class="form-control" name="address" value="{{ isset($accommodation) ? $accommodation->address : old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
                            <label for="description_en" class="col-md-4 control-label">Description (eng)</label>

                            <div class="col-md-6">
                                <textarea id="description_en" maxlength="800" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_en">{{ isset($accommodation) ? $accommodation->description_en : old('description_en') }}</textarea>
                                
                                @if ($errors->has('description_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_ser') ? ' has-error' : '' }}">
                            <label for="description_ser" class="col-md-4 control-label">Description (ser)</label>

                            <div class="col-md-6">
                                <textarea id="description_ser" maxlength="800" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_ser">{{ isset($accommodation) ? $accommodation->description_ser : old('description_ser') }}</textarea>
                                
                                @if ($errors->has('description_ser'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_ser') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($accommodation) || !isset($apartment))
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Main image</label>

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
                        
                        <div class="form-group{{ $errors->has('geoLat') ? ' has-error' : '' }}">
                            <label for="geoLat" class="col-md-4 control-label">Geographic latitude*</label>

                            <div class="col-md-6">
                                <input id="geoLat" type="text" maxlength="100" class="form-control" name="geoLat" value="{{ isset($accommodation) ? $accommodation->geoLat : old('geoLat') }}" required>

                                @if ($errors->has('geoLat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geoLat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('geoLong') ? ' has-error' : '' }}">
                            <label for="geoLong" class="col-md-4 control-label">Geographic longitude*</label>

                            <div class="col-md-6">
                                <input id="geoLong" type="text" maxlength="100" class="form-control" name="geoLong" value="{{ isset($accommodation) ? $accommodation->geoLong : old('geoLong') }}" required>

                                @if ($errors->has('geoLong'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geoLong') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">Website link</label>

                            <div class="col-md-6">
                                <input id="link" type="text" maxlength="400" class="form-control" name="link" value="{{ isset($accommodation) ? $accommodation->link : old('link') }}">
                                
                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('people') ? ' has-error' : '' }}">
                            <label for="people" class="col-md-4 control-label">Number of people*</label>

                            <div class="col-md-6">
                                <input id="people" type="number" min="1" max="20" step="1" class="form-control" name="people" value="{{ isset($apartment) ? $apartment->people : old('people') }}" required>

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
                                @if (isset($apartment) && $apartment->tv)
                                <input type="radio" name="tv" value="1" checked> Yes
                                <input type="radio" name="tv" value="0"> No
                                @else
                                <input type="radio" name="tv" value="1" > Yes
                                <input type="radio" name="tv" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="hottub" class="col-md-4 control-label">Hot tub</label>

                            <div class="col-md-6">
                                @if (isset($apartment) && $apartment->hottub)
                                <input type="radio" name="hottub" value="1" checked> Yes
                                <input type="radio" name="hottub" value="0"> No
                                @else
                                <input type="radio" name="hottub" value="1"> Yes
                                <input type="radio" name="hottub" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="wifi" class="col-md-4 control-label">WiFi</label>

                            <div class="col-md-6">
                                @if (isset($apartment) && $apartment->wifi)
                                <input type="radio" name="wifi" value="1" checked> Yes
                                <input type="radio" name="wifi" value="0"> No
                                @else
                                <input type="radio" name="wifi" value="1"> Yes
                                <input type="radio" name="wifi" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="bar" class="col-md-4 control-label">Bar</label>

                            <div class="col-md-6">
                                @if (isset($apartment) && $apartment->bar)
                                <input type="radio" name="bar" value="1" checked> Yes
                                <input type="radio" name="bar" value="0"> No
                                @else
                                <input type="radio" name="bar" value="1"> Yes
                                <input type="radio" name="bar" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="airCondition" class="col-md-4 control-label">Air Condition</label>

                            <div class="col-md-6">
                                @if (isset($apartment) && $apartment->airCondition)
                                <input type="radio" name="airCondition" value="1" checked> Yes
                                <input type="radio" name="airCondition" value="0"> No
                                @else
                                <input type="radio" name="airCondition" value="1"> Yes
                                <input type="radio" name="airCondition" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="parking" class="col-md-4 control-label">Parking</label>

                            <div class="col-md-6">
                                @if (isset($apartment) && $apartment->parking)
                                <input type="radio" name="parking" value="1" checked> Yes
                                <input type="radio" name="parking" value="0"> No
                                @else
                                <input type="radio" name="parking" value="1"> Yes
                                <input type="radio" name="parking" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="cityCenter" class="col-md-4 control-label">City Center</label>

                            <div class="col-md-6">
                                @if (isset($apartment) && $apartment->cityCenter)
                                <input type="radio" name="cityCenter" value="1" checked> Yes
                                <input type="radio" name="cityCenter" value="0"> No
                                @else
                                <input type="radio" name="cityCenter" value="1"> Yes
                                <input type="radio" name="cityCenter" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if (isset($accommodation) && isset($apartment))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.accommodation.apartments') }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
