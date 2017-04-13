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
                    All packages
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.packages.create') }}">New package</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete a package select 'Delete package'.<br/>
                        To edit info about a package select 'Edit data'.<br/>
                        To edit symbol photo of a package select 'Edit symbol photo'.<br/>
                        To edit card front photo of a package select 'Edit card front photo'.<br/>
                        To edit card back photo of a package select 'Edit card back photo'.<br/>
                    </div>
                    @foreach($packages as $package)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($package->symbol != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$package->symbol) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <a href='{{ route("package", [ 'title' => str_replace(' ', '-', $package->title_sr) ]) }}' target='_blank'>
                                <h4>{{ $package->title_en }}</h4>  
                            </a>                         
                            Position on home page: {{ $package->position }}
                            <br/><strong>{{ $package->price }}€</strong>
                            
                            @if ($package->visible)
                            {{ Form::open(['route' => ['cms.packages.hide', $package->packID], 'method' => 'post']) }}
                            {{ Form::submit('Hide from home page', array('class' => 'btn btn-primary', 'style' => 'margin: 10px')) }}
                            @else
                            {{ Form::open(['route' => ['cms.packages.show', $package->packID], 'method' => 'post']) }}
                            {{ Form::submit('Show on home page', array('class' => 'btn btn-primary', 'style' => 'margin: 10px')) }}
                            @endif
                            {{ Form::close() }}
                            
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.packages.edit', $package->packID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.packages.create.service', $package->packID], 'method' => 'get']) }}
                            {{ Form::submit('Add service', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.packages.delete.services', $package->packID], 'method' => 'get']) }}
                            {{ Form::submit('Delete services', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                          
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$package->packID}}">
                                Delete package
                            </button>
                            <div class="modal fade" id="myModal{{$package->packID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete an package</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.packages.delete', $package->packID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete package', array('class' => 'btn btn-danger')) }}
                                                <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.packages.edit.image', 'packID' => $package->packID, 'imgType' => 'symbol'], 'method' => 'get']) }}
                            {{ Form::submit('Edit symbol photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.packages.edit.image', 'packID' => $package->packID, 'imgType' => 'cardFront'], 'method' => 'get']) }}
                            {{ Form::submit('Edit card front photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.packages.edit.image', 'packID' => $package->packID, 'imgType' => 'cardBack'], 'method' => 'get']) }}
                            {{ Form::submit('Edit card back photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $packages->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
