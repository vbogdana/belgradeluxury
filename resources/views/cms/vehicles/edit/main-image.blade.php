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
                    Change main photo
                </div>
                <div class="panel-body">
                    <div class="panel-info" style="margin-bottom: 20px">
                        Here you can change the main photo of a vehicle.
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('cms.vehicles.edit.main-image', ['vehID' => $vehID]) }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="photo0" class="col-md-4 control-label">Current Image</label>

                            <div class="col-md-6">
                                @if ($image != null)
                                <img class="img-responsive" src="{{ asset('storage/images/'.$image) }}">
                                @else
                                No image
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('photo0') ? ' has-error' : '' }}">
                            <label for="photo0" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="photo0" type="file" name="photo0" value="{{ old('photo0') }}">
                                
                                @if ($errors->has('photo0'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo0') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="margin-right: 15px">
                                    Upload
                                </button>
                                <a class="btn btn-default" style="margin-left: 15px" href="{{ route('cms.vehicles') }}">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                    
                    @if ($image != null)
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                                    Remove current image
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="modal fade text-center" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Remove current image</h4>
                                </div>

                                <div class="modal-body">
                                    Are you sure?<br/>
                                    <div style="margin-top: 15px">
                                        {{ Form::open(['route' => ['cms.vehicles.delete.main-image', $vehID], 'method' => 'delete', 'class' => 'form-horizontal' ]) }}
                                        {{ Form::submit('Remove current image', array('class' => 'btn btn-danger')) }}
                                        <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
