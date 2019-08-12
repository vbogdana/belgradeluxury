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
                    @if (isset($placeID))
                    <a href="{{ route('cms.places') }}">Places ></a>&nbsp;
                    @else
                    <a href="{{ route('cms.events') }}">Events ></a>&nbsp;
                    @endif
                    @if(isset($event))
                    Edit Event
                    @else
                    Create Event
                    @endif
                </div>
                <div class="panel-body">
                    @if(isset($event))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.events.edit', ['evID' => $event->evID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.events.create') }}">
                    @endif
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has("date") ? ' has-error' : '' }}">
                            <label for="date" class="col-md-4 control-label">Date *</label>

                            <div class="col-md-6">
                                <input id="date" type="date" maxlength="255" class="form-control" name="date" value="{{ isset($event) ? $event->date : old('date') }}" required>

                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                                                                                              
                        <div class="form-group{{ $errors->has("title_en") ? ' has-error' : '' }}">
                            <label for="title_en" class="col-md-4 control-label">Title (eng)*</label>

                            <div class="col-md-6">
                                <input id="title_en" type="text" maxlength="255" class="form-control" name="title_en" value="{{ isset($event) ? $event->article->title_en : old('title_en') }}" required>

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
                                <input id="title_sr" type="text" maxlength="255" class="form-control" name="title_sr" value="{{ isset($event) ? $event->article->title_sr : old('title_sr') }}" required>

                                @if ($errors->has('title_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('reservations') ? ' has-error' : '' }}">
                            <label for="reservations" class="col-md-4 control-label">Reservations last until: * (ex. 21:30h)</label>

                            <div class="col-md-6">
                                <input id="reservations" type="text" maxlength="255" class="form-control" name="reservations" value="{{ isset($event) ? $event->reservations : old('reservations') }}" >

                                @if ($errors->has('reservations'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reservations') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        
                        @if (!isset($event))
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Main image (square dimensions)</label>

                            <div class="col-md-6">
                                <input id="image" class='form-control' type="file" name="image" value="{{ old('image') }}">
                                
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select id="category" name="category" class='form-control'>
                                    <?php
                                        if (!isset($event)) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                    ?>                                    
                                    @foreach($categories as $category)
                                        <?php 
                                        if (isset($event) && ($event->article->ctgID !== null) && ($event->article->ctgID == $category->ctgID)) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        ?>     
                                    <option value="{{ $category->ctgID }}" {{ $selected }}>{{ $category->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                            <label for="place" class="col-md-4 control-label">Place</label>

                            <div class="col-md-6">
                                <select id="place" name="place" class='form-control'>
                                    <?php
                                        if (!isset($event) && !isset($placeID)) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                    ?>
                                    <option value="none" {{ $selected }}>none</option>
                                    @foreach($places as $place)
                                        <?php 
                                        if (isset($event) && ($event->placeID !== null) && ($event->placeID == $place->placeID)) {
                                            $selected = "selected";
                                        } else {
                                            if (isset($placeID) && ($placeID == $place->placeID)) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                        }
                                        ?>     
                                    <option value="{{ $place->placeID }}" {{ $selected }}>{{ $place->title_en }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('place'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('place') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
                            <label for="description_en" class="col-md-4 control-label">Short Description (eng) *</label>

                            <div class="col-md-6">
                                <textarea id="description_en" maxlength="255" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_en">{{ isset($event) ? $event->article->description_en : old('description_en') }}</textarea>
                                
                                @if ($errors->has('description_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_sr') ? ' has-error' : '' }}">
                            <label for="description_sr" class="col-md-4 control-label">Short Description (ser) *</label>

                            <div class="col-md-6">
                                <textarea id="description_sr" maxlength="255"  
                                          rows="5" cols="70" 
                                          class="form-control" 
                                          name="description_sr">{{ isset($event) ? $event->article->description_sr : old('description_sr') }}</textarea>
                                
                                @if ($errors->has('description_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if (isset($event))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.events') }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
