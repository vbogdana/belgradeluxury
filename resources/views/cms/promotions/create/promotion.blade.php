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
                    <a href="{{ route('cms.promotions') }}">Promotions ></a>&nbsp;
                    @if(isset($promotion))
                    Edit Promotion
                    @else
                    Create Promotion
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($promotion))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.promotions.edit', ['promID' => $promotion->promID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.promotions.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('meta_en') ? ' has-error' : '' }}">
                            <label for="meta_en" class="col-md-4 control-label">Meta tag description (eng)*</label>

                            <div class="col-md-6">
                                <input id="meta_en" type="text" maxlength="160" class="form-control" name="meta_en" value="{{ isset($promotion) ? $promotion->meta_en : old('meta_en') }}" required autofocus>

                                @if ($errors->has('meta_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('meta_sr') ? ' has-error' : '' }}">
                            <label for="meta_sr" class="col-md-4 control-label">Meta tag description (ser)*</label>

                            <div class="col-md-6">
                                <input id="meta_sr" type="text" maxlength="160" class="form-control" name="meta_sr" value="{{ isset($promotion) ? $promotion->meta_sr : old('meta_sr') }}" required>

                                @if ($errors->has('meta_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('url_en') ? ' has-error' : '' }}">
                            <label for="url_en" class="col-md-4 control-label">URL (eng)*</label>

                            <div class="col-md-6">
                                <input id="url_en" type="text" maxlength="255" class="form-control" name="url_en" value="{{ isset($promotion) ? $promotion->url_en : old('url_en') }}" required>

                                @if ($errors->has('url_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('url_sr') ? ' has-error' : '' }}">
                            <label for="url_sr" class="col-md-4 control-label">URL (ser)*</label>

                            <div class="col-md-6">
                                <input id="url_sr" type="text" maxlength="255" class="form-control" name="url_sr" value="{{ isset($promotion) ? $promotion->url_sr : old('url_sr') }}" required>

                                @if ($errors->has('url_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  

                        <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                            <label for="title_en" class="col-md-4 control-label">Title (eng)*</label>

                            <div class="col-md-6">
                                <input id="title_en" type="text" maxlength="255" class="form-control" name="title_en" value="{{ isset($promotion) ? $promotion->title_en : old('title_en') }}" required>

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
                                <input id="title_sr" type="text" maxlength="255" class="form-control" name="title_sr" value="{{ isset($promotion) ? $promotion->title_sr : old('title_sr') }}" required>

                                @if ($errors->has('title_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  
                        
                        <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
                            <label for="description_en" class="col-md-4 control-label">Description (eng)</label>

                            <div class="col-md-6">
                                <textarea id="description_en" maxlength="1020" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_en">{{ isset($promotion) ? $promotion->description_en : old('description_en') }}</textarea>
                                
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
                                          name="description_sr">{{ isset($promotion) ? $promotion->description_sr : old('description_sr') }}</textarea>
                                
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
                                          name="long_description_en">{{ isset($promotion) ? $promotion->long_description_en : old('long_description_en') }}</textarea>
                                
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
                                          name="long_description_sr">{{ isset($promotion) ? $promotion->long_description_sr : old('long_description_sr') }}</textarea>
                                
                                @if ($errors->has('long_description_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('long_description_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($promotion))
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Main image</label>

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
                        
                        
                        @if (!isset($promotion))
                        <div class="form-group{{ $errors->has('background_image') ? ' has-error' : '' }}">
                            <label for="background_image" class="col-md-4 control-label">Background image</label>

                            <div class="col-md-6">
                                <input id="background_image" type="file" class="form-control" name="background_image" value="{{ old('background_image') }}">
                                
                                @if ($errors->has('background_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('background_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if (isset($promotion))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.promotions') }}">Cancel</a>                                                
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
