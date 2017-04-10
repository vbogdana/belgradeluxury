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
                    All testemonials
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.testemonials.create') }}">New testemonial</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete a testemonial select 'Delete testemonial'.<br/>
                        To edit info about an testemonial select 'Edit data'.<br/>
                        To edit main photo of an testemonial select 'Edit main photo'.<br/>
                    </div>
                    @foreach($testemonials as $test)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($test->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$test->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <h4>
                            @if ($test->author != null)
                            {{ $test->author }},                           
                            @endif
                            <strong>{{ $test->profession_en }}</strong>
                            </h4>
                            <p>{{ $test->content_en }}</p>                            
                        </div>
                        <div class="col-xs-12 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.testemonials.edit', $test->testID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.testemonials.edit.main-image', $test->testID], 'method' => 'get']) }}
                            {{ Form::submit('Edit author photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$test->testID}}">
                                Delete a testemonial
                            </button>
                            <div class="modal fade" id="myModal{{$test->testID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete a testemonial</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.testemonials.delete', $test->testID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete testemonial', array('class' => 'btn btn-danger')) }}
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
                    
                    {{ $testemonials->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
