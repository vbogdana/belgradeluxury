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
                    All partners
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.partners.create') }}">New partner</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete a partner select 'Delete partner'.<br/>
                        To edit info about an partner select 'Edit data'.<br/>
                        To edit main photo of an partner select 'Edit main photo'.<br/>
                    </div>
                    @foreach($partners as $partner)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($partner->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$partner->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <h4>
                            <strong>{{ $partner->partner }}</strong>
                            </h4>
                            <p>{{ $partner->link }}</p>  
                            
                            @if ($partner->visible)
                            {{ Form::open(['route' => ['cms.partners.hide', $partner->partID], 'method' => 'post']) }}
                            {{ Form::submit('Hide from PARTNERS page', array('class' => 'btn btn-primary', 'style' => 'margin: 10px')) }}
                            @else
                            {{ Form::open(['route' => ['cms.partners.show', $partner->partID], 'method' => 'post']) }}
                            {{ Form::submit('Show on PARTNERS page', array('class' => 'btn btn-primary', 'style' => 'margin: 10px')) }}
                            @endif
                            {{ Form::close() }}
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.partners.edit', $partner->partID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.partners.edit.main-image', $partner->partID], 'method' => 'get']) }}
                            {{ Form::submit('Edit partner photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$partner->partID}}">
                                Delete a partner
                            </button>
                            <div class="modal fade" id="myModal{{$partner->partID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete a partner</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.partners.delete', $partner->partID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete partner', array('class' => 'btn btn-danger')) }}
                                                <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $partners->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
