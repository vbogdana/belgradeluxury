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
                    <a href="{{ route('cms.vehicles') }}">Vehicles ></a>&nbsp;
                    @if(isset($vehicle))
                    Edit Vehicle
                    @else
                    Create Vehicle
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($vehicle))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.vehicles.edit', ['vehID' => $vehicle->vehID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.vehicles.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('brand') ? ' has-error' : '' }}">
                            <label for="brand" class="col-md-4 control-label">Brand*</label>

                            <div class="col-md-6">
                                <input id="brand" type="text" maxlength="150" class="form-control" name="brand" value="{{ isset($vehicle) ? $vehicle->brand : old('brand') }}" required autofocus>

                                @if ($errors->has('brand'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('brand') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                            <label for="model" class="col-md-4 control-label">Model*</label>

                            <div class="col-md-6">
                                <input id="model" type="text" maxlength="150" class="form-control" name="model" value="{{ isset($vehicle) ? $vehicle->model : old('model') }}" required>

                                @if ($errors->has('model'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('model') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type*</label>

                            <div class="col-md-6">
                                <input id="type" type="text" maxlength="200" class="form-control" name="type" value="{{ isset($vehicle) ? $vehicle->type : old('type') }}" required>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Price in €*</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="1" class="form-control" name="price" value="{{ isset($vehicle) ? $vehicle->price : old('price') }}" required>

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
                            <label for="description_en" class="col-md-4 control-label">Description (eng)</label>

                            <div class="col-md-6">
                                <textarea id="description_en" maxlength="800" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_en">{{ isset($vehicle) ? $vehicle->description_en : old('description_en') }}</textarea>
                                
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
                                          name="description_ser">{{ isset($vehicle) ? $vehicle->description_ser : old('description_ser') }}</textarea>
                                
                                @if ($errors->has('description_ser'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_ser') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($vehicle))
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
                        
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">Website link</label>

                            <div class="col-md-6">
                                <input id="link" type="text" maxlength="400" class="form-control" name="link" value="{{ isset($vehicle) ? $vehicle->link : old('link') }}">
                                
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
                                <input id="people" type="number" min="1" max="20" step="1" class="form-control" name="people" value="{{ isset($vehicle) ? $vehicle->people : old('people') }}" required>

                                @if ($errors->has('people'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('people') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="automatic" class="col-md-4 control-label">Automatic</label>

                            <div class="col-md-6">
                                @if (isset($vehicle) && $vehicle->automatic)
                                <input type="radio" name="automatic" value="1" checked> Yes
                                <input type="radio" name="automatic" value="0"> No
                                @else
                                <input type="radio" name="automatic" value="1" > Yes
                                <input type="radio" name="automatic" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="navigation" class="col-md-4 control-label">Navigation</label>

                            <div class="col-md-6">
                                @if (isset($vehicle) && $vehicle->navigation)
                                <input type="radio" name="navigation" value="1" checked> Yes
                                <input type="radio" name="navigation" value="0"> No
                                @else
                                <input type="radio" name="navigation" value="1"> Yes
                                <input type="radio" name="navigation" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="chauffeur" class="col-md-4 control-label">Chauffeur</label>

                            <div class="col-md-6">
                                @if (isset($vehicle) && $vehicle->chauffeur)
                                <input type="radio" name="chauffeur" value="1" checked> Yes
                                <input type="radio" name="chauffeur" value="0"> No
                                @else
                                <input type="radio" name="chauffeur" value="1"> Yes
                                <input type="radio" name="chauffeur" value="0" checked> No
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if (isset($vehicle))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.vehicles') }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
