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
                    <a href="{{ route('cms.places') }}">Places ></a>&nbsp;
                    @if(isset($place))
                    Edit Place
                    @else
                    Create Place
                    @endif
                </div>
                <div class="panel-body">
                    <div class="panel-info" style="color: red; padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        !!! PRILIKOM UBACIVANJA WORKING HOURS - SVAKI DAN RAZDVOJITI ";" (tacka-zarezom) !!!
                    </div>
                    @if(isset($place))
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.places.edit', ['placeID' => $place->placeID]) }}">
                    @else
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.places.create') }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                            <label for="title_en" class="col-md-4 control-label">Title (eng)*</label>

                            <div class="col-md-6">
                                <input id="title_en" type="text" maxlength="255" class="form-control" name="title_en" value="{{ isset($place) ? $place->title_en : old('title_en') }}" required autofocus>

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
                                <input id="title_sr" type="text" maxlength="255" class="form-control" name="title_sr" value="{{ isset($place) ? $place->title_sr : old('title_sr') }}" required>

                                @if ($errors->has('title_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">Type*</label>

                            <div class="col-md-6">
                                <?php 
                                    $type = ['restaurant' => '', 'bar' => '', 'club' => '', 'kafana' => '', 'splav' => ''];
                                    if (isset($place)) {
                                        $type[$place->type] = 'checked';
                                    } else {
                                        $type['restaurant'] = 'checked';
                                    }
                                ?>
                                @foreach($type as $t => $value)
                                <input type="radio" name="type" value="{{ $t }}" {{ $value }}> {{ $t }}
                                @endforeach
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label for="priority" class="col-md-4 control-label">Priority</label>

                            <div class="col-md-6">
                                <select name="priority" class='form-control'>
                                    <option value="1" 
                                            <?php if (isset($place) && $place->priority == 1) echo "selected" ?>
                                            >low</option>
                                    <option value="2" 
                                            <?php if (isset($place) && $place->priority == 2) echo "selected" ?>
                                            >medium</option>
                                    <option value="3" 
                                            <?php if (isset($place) && $place->priority == 3) echo "selected" ?>
                                            >high</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="form-group{{ $errors->has('description_en') ? ' has-error' : '' }}">
                            <label for="description_en" class="col-md-4 control-label">Description (eng)</label>

                            <div class="col-md-6">
                                <textarea id="description_en" maxlength="1020" 
                                          rows="5" cols="70" class="form-control" 
                                          name="description_en">{{ isset($place) ? $place->description_en : old('description_en') }}</textarea>
                                
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
                                          name="description_sr">{{ isset($place) ? $place->description_sr : old('description_sr') }}</textarea>
                                
                                @if ($errors->has('description_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address*</label>

                            <div class="col-md-6">
                                <input id="address" type="text" maxlength="255" class="form-control" name="address" value="{{ isset($place) ? $place->address : old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('hours_en') ? ' has-error' : '' }}">
                            <label for="hours_en" class="col-md-4 control-label">Hours (eng) * (separate each with ;)</label>

                            <div class="col-md-6">
                                <input id="hours_en" type="text" maxlength="255" class="form-control" name="hours_en" value="{{ isset($place) ? $place->hours_en : old('hours_en') }}" required>

                                @if ($errors->has('hours_en'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hours_en') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('hours_sr') ? ' has-error' : '' }}">
                            <label for="hours_sr" class="col-md-4 control-label">Hours (ser) * (separate each with ;)</label>

                            <div class="col-md-6">
                                <input id="hours_sr" type="text" maxlength="255" class="form-control" name="hours_sr" value="{{ isset($place) ? $place->hours_sr : old('hours_sr') }}" required>

                                @if ($errors->has('hours_sr'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hours_sr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if (!isset($place))
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Main image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image" value="{{ old('image') }}" class='form-control'>
                                
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
                                <input id="geoLat" type="text" maxlength="255" class="form-control" name="geoLat" value="{{ isset($place) ? $place->geoLat : old('geoLat') }}" required>

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
                                <input id="geoLong" type="text" maxlength="255" class="form-control" name="geoLong" value="{{ isset($place) ? $place->geoLong : old('geoLong') }}" required>

                                @if ($errors->has('geoLong'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('geoLong') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('seating') ? ' has-error' : '' }}">
                            <label for="seating" class="col-md-4 control-label">Types of seating*</label>

                            <div class="col-md-6">
                                <?php 
                                $i = 0;
                                ?>
                                @foreach($seatings as $seating)                               
                                <input id="seating[{{ $i }}]" type="checkbox" name="seating[{{ $i }}]" value="{{ $seating->seatID }}"
                                    <?php
                                        if (isset($place)) {
                                            foreach($place->seatings as $s) {
                                                if ($s->seating->seatID === $seating->seatID) {
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    ?>
                                       >
                                <label for="seating[{{ $i++ }}]">{{ $seating->type_en }}</label>
                                &nbsp;&nbsp;
                                @endforeach 
                                
                                @if ($errors->has('seating'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seating') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">Website link</label>

                            <div class="col-md-6">
                                <input id="link" type="text" maxlength="255" class="form-control" name="link" value="{{ isset($place) ? $place->link : old('link') }}">
                                
                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>   
                        
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Contact phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" maxlength="255" class="form-control" name="phone" value="{{ isset($place) ? $place->phone : old('phone') }}">
                                
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                              
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @if (isset($place))
                                    Edit
                                    @else
                                    Create
                                    @endif
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.places') }}">Cancel</a>                                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
