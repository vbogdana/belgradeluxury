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
                    All hosts
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.host.create') }}">New host</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete a host select 'Delete host'.<br/>
                        To edit info about an host select 'Edit data'.<br/>
                        To edit main photo of an host select 'Edit main photo'.<br/>
                    </div>
                    @foreach($hosts as $host)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($host->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$host->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <a href='{{ route("host") }}' target='_blank'>
                                <h4>{{ $host->name }}</h4>
                            </a>
                            <p>{{ $host->skills_en }}</p>
                            <p>{{ $host->hobbies_en }}</p>                            
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.host.edit', $host->hostID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.host.edit.main-image', $host->hostID], 'method' => 'get']) }}
                            {{ Form::submit('Edit host photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$host->hostID}}">
                                Delete a host
                            </button>
                            <div class="modal fade" id="myModal{{$host->hostID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete a host</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.host.delete', $host->hostID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete host', array('class' => 'btn btn-danger')) }}
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
                    
                    {{ $hosts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
