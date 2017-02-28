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
                        
                        <div class="form-group{{ $errors->has('title_ser') ? ' has-error' : '' }}">
                            <label for="title_ser" class="col-md-4 control-label">Title (ser)*</label>

                            <div class="col-md-6">
                                <input id="title_ser" type="text" maxlength="255" class="form-control" name="title_ser" value="{{ isset($package) ? $package->title_ser : old('title_ser') }}" required>

                                @if ($errors->has('title_ser'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_ser') }}</strong>
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
                                <textarea id="description_en" maxlength="800" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_en">{{ isset($package) ? $package->description_en : old('description_en') }}</textarea>
                                
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
                                          name="description_ser">{{ isset($package) ? $package->description_ser : old('description_ser') }}</textarea>
                                
                                @if ($errors->has('description_ser'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_ser') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($package))
                        <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                            <label for="symbol" class="col-md-4 control-label">Symbol image</label>

                            <div class="col-md-6">
                                <input id="symbol" type="file" name="symbol" value="{{ old('symbol') }}">
                                
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
                                <input id="cardFront" type="file" name="cardFront" value="{{ old('cardFront') }}">
                                
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
                                <input id="cardBack" type="file" name="cardBack" value="{{ old('cardBack') }}">
                                
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
