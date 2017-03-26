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
                    <a href="{{ route('cms.events') }}">Events ></a>&nbsp;
                    @if(isset($event))
                    Edit Event
                    @else
                    Create Event
                    @endif
                </div>
                <div class="panel-body">
                    <div class="panel-info" style="color: red; padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        !!! PRILIKOM UBACIVANJA SKILLS - SVAKI JEZIK I SVAKI SKIL RAZDVOJITI ";" (tacka-zarezom) !!!
                    </div>
                    @if(isset($event))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.events.edit', ['evID' => $event->evID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.events.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="day" class="col-md-4 control-label">Day*</label>

                            <div class="col-md-6">
                                <?php 
                                    $days = [ 0 => '', 1 => '', 2 => '', 3 => '', 4 => '', 5 => '', 6 => '' ];
                                    $strings = [ 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ];
                                    if (isset($event)) {
                                        $days[$event->day] = 'checked';
                                    } else {
                                        $days[0] = 'checked';
                                    }
                                ?>
                                @foreach($days as $day => $value)
                                <input type="radio" name="day" value="{{ $day }}" {{ $value }}> {{ $strings[$day] }}
                                @endforeach
                            </div>
                        </div>
                        
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
                                <input id="title_en" type="text" maxlength="255" class="form-control" name="title_en" value="{{ isset($event) ? $event->title_en : old('title_en') }}" required>

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
                                <input id="title_sr" type="text" maxlength="255" class="form-control" name="title_sr" value="{{ isset($event) ? $event->title_sr : old('title_sr') }}" required>

                                @if ($errors->has('title_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('reservations') ? ' has-error' : '' }}">
                            <label for="reservations" class="col-md-4 control-label">Reservations (ser)*</label>

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
                                <input id="image" type="file" name="image" value="{{ old('image') }}">
                                
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
                                <select id="category" name="category">
                                    <?php
                                        if (!isset($event)) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                    ?>
                                    <option value="null" {{ $selected }}>none</option>
                                    @foreach($categories as $category)
                                        <?php 
                                        if (isset($event) && ($event->ctgID !== null) && ($event->ctgID === $category->ctgID)) {
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
                        
                        <div class="form-group">
                            <label for="place" class="col-md-4 control-label">Place</label>

                            <div class="col-md-6">
                                <select id="place" name="place">
                                    <?php
                                        if (!isset($event)) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                    ?>
                                    <option value="null" {{ $selected }}>none</option>
                                    @foreach($places as $place)
                                        <?php 
                                        if (isset($event) && ($event->placeID !== null) && ($event->placeID === $place->placeID)) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        ?>     
                                    <option value="{{ $place->placeID }}" {{ $selected }}>{{ $place->title_en }}</option>
                                    @endforeach
                                </select>
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