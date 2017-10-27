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
                    <a href="{{ route('cms.promotions') }}">Promotions ></a>&nbsp;{{ $promotion->title_en }} promotion >&nbsp;
                    Delete services
                </div>

                <div class="panel-body">
                    @foreach($promotion->services as $service)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-6">
                            <h3>{{ $service->service->name_en }}</h3>
                            <h4>{{ $service->title_en }}</h4>
                            @if ($service->optional)
                            <h5 style="color:ORANGE">OPTIONAL SERVICE</h5>
                            @endif
                        </div>
                        <div class="col-xs-6" style="padding-top: 15px">                           
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{ $service->prmsID }}">
                                Delete service
                            </button>
                            <div class="modal fade" id="myModal{{ $service->prmsID }}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete service</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.promotions.delete.service', $service->prmsID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete service', array('class' => 'btn btn-danger')) }}
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
