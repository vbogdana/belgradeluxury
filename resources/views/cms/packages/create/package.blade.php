<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -
-->

@extends('layouts.cms')

@section('content')

@include('cms.instructions.links-paragraphs')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" style="border: 1px solid orange">
                LINKS AND PARAGRAPHS CAN ONLY BE USED IN THE <b>DESCRIPTION AND LONG DESCRIPTION FIELDS</b>!!!
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('cms.packages') }}">Packages ></a>&nbsp;
                    @if(isset($package))
                    Edit Package
                    @else
                    Create Package
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($package))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.packages.edit', ['packID' => $package->packID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.packages.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                            <label for="title_en" class="col-md-4 control-label">Title (eng)*</label>

                            <div class="col-md-6">
                                <input id="title_en" type="text" maxlength="255" class="form-control" name="title_en" value="{{ isset($package) ? $package->title_en : old('title_en') }}" required autofocus>

                                @if ($errors->has('title_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('title_sr') ? ' has-error' : '' }}">
                            <label for="title_sr" class="col-md-4 control-label">Title (ser)*</label>

                            <div class="col-md-6">
                                <input id="title_sr" type="text" maxlength="255" class="form-control" name="title_sr" value="{{ isset($package) ? $package->title_sr : old('title_sr') }}" required>

                                @if ($errors->has('title_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Price in €*</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="1" class="form-control" name="price" value="{{ isset($package) ? $package->price : old('price') }}" required>

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
                                <textarea id="description_en" maxlength="1020" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_en">{{ isset($package) ? $package->description_en : old('description_en') }}</textarea>
                                
                                @if ($errors->has('description_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_sr') ? ' has-error' : '' }}">
                            <label for="description_sr" class="col-md-4 control-label">Description (ser)</label>

                            <div class="col-md-6">
                                <textarea id="description_sr" maxlength="1020" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_sr">{{ isset($package) ? $package->description_sr : old('description_sr') }}</textarea>
                                
                                @if ($errors->has('description_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('long_description_en') ? ' has-error' : '' }}">
                            <label for="long_description_en" class="col-md-4 control-label">Long Description (eng)</label>

                            <div class="col-md-6">
                                <textarea id="long_description_en" maxlength="3060" 
                                          rows="5" cols="70" class="form-control" 
                                          name="long_description_en">{{ isset($package) ? $package->long_description_en : old('long_description_en') }}</textarea>
                                
                                @if ($errors->has('long_description_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('long_description_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('long_description_sr') ? ' has-error' : '' }}">
                            <label for="long_description_sr" class="col-md-4 control-label">Long Description (ser)</label>

                            <div class="col-md-6">
                                <textarea id="long_description_sr" maxlength="3060" 
                                          rows="5" cols="70" class="form-control" 
                                          name="long_description_sr">{{ isset($package) ? $package->long_description_sr : old('long_description_sr') }}</textarea>
                                
                                @if ($errors->has('long_description_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('long_description_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($package))
                        <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                            <label for="symbol" class="col-md-4 control-label">Symbol image</label>

                            <div class="col-md-6">
                                <input id="symbol" type="file" class="form-control" name="symbol" value="{{ old('symbol') }}">
                                
                                @if ($errors->has('symbol'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('symbol') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        
                        @if (!isset($package))
                        <div class="form-group{{ $errors->has('cardFront') ? ' has-error' : '' }}">
                            <label for="cardFront" class="col-md-4 control-label">Card front image</label>

                            <div class="col-md-6">
                                <input id="cardFront" type="file" class="form-control" name="cardFront" value="{{ old('cardFront') }}">
                                
                                @if ($errors->has('cardFront'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cardFront') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        @if (!isset($package))
                        <div class="form-group{{ $errors->has('cardBack') ? ' has-error' : '' }}">
                            <label for="cardBack" class="col-md-4 control-label">Card back image</label>

                            <div class="col-md-6">
                                <input id="cardBack" type="file" class="form-control" name="cardBack" value="{{ old('cardBack') }}">
                                
                                @if ($errors->has('cardBack'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cardBack') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if (isset($package))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.packages') }}">Cancel</a>                                                
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
