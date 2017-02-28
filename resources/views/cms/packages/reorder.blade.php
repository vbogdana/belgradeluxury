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
                    Reorder packages on home page
                </div>
                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        Pair every package with a number 0-5.<br/>
                        Number represents their number in the package ring on the home page.<br/>
                        Package with the number 0 will be the center one, number 1 will be on the right side and number 5 on the left side.
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.packages.reorder') }}">
                        {{ csrf_field() }}
                        
                        <?php $i = 0; ?>
                        @foreach ($packages as $package)
                        <div class="form-group{{ $errors->has('package.'.$i) ? ' has-error' : '' }}">
                            <label for="package[{{$i}}]" class="col-md-4 control-label">{{ $package->title_en }}* (current position: {{ $package->position }})</label>

                            <div class="col-md-6">
                                <input id="package[{{$i}}]" type="number" step="1" min="0" max="5" class="form-control" name="package[{{$i}}]" value="{{ old('package.'.$i) }}" required>

                                @if ($errors->has('package.'.$i))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('package.'.$i) }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
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
@stop
