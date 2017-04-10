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
                    <a href="{{ route('cms.accommodation') }}">Accommodation ></a>&nbsp;
                    Remove photos
                </div>

                <div class="panel-body">
                    @foreach($accImgs as $accImg)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-6">
                            @if ($accImg->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$accImg->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-6" style="padding-top: 15px">                           
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$accImg->imgID}}">
                                Remove photo
                            </button>
                            <div class="modal fade" id="myModal{{$accImg->imgID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Remove photo</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.accommodation.delete.image', $accImg->imgID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Remove photo', array('class' => 'btn btn-danger')) }}
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
                    
                    {{ $accImgs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
