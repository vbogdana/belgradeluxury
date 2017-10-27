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
                    <a href="{{ route('cms.promotions') }}">Promotions ></a>&nbsp;
                    All promotions
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.promotions.create') }}">New promotion</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete a promotion select 'Delete promotion'.<br/>
                        To edit info about a promotion select 'Edit data'.<br/>
                        To edit main photo of a promotion select 'Edit main photo'.<br/>
                        To edit background photo of a promotion select 'Edit background photo'.<br/>
                    </div>
                    @foreach($promotions as $promotion)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($promotion->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$promotion->image) }}">
                            @else
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <a href='{{ route("promotion", [ 'title' => str_replace(' ', '-', $promotion->url_sr) ]) }}' target='_blank'>
                                <h4>{{ $promotion->title_en }}</h4>  
                            </a>                         
                            
                            @if ($promotion->visible)
                            {{ Form::open(['route' => ['cms.promotions.hide', $promotion->promID], 'method' => 'post']) }}
                            {{ Form::submit('Hide from home page', array('class' => 'btn btn-primary', 'style' => 'margin: 10px')) }}
                            @else
                            {{ Form::open(['route' => ['cms.promotions.show', $promotion->promID], 'method' => 'post']) }}
                            {{ Form::submit('Show on home page', array('class' => 'btn btn-primary', 'style' => 'margin: 10px')) }}
                            @endif
                            {{ Form::close() }}
                            
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.promotions.edit', $promotion->promID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.promotions.create.service', $promotion->promID], 'method' => 'get']) }}
                            {{ Form::submit('Add service', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.promotions.delete.services', $promotion->promID], 'method' => 'get']) }}
                            {{ Form::submit('Delete services', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                          
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$promotion->promID}}">
                                Delete promotion
                            </button>
                            <div class="modal fade" id="myModal{{$promotion->promID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete a promotion</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.promotions.delete', $promotion->promID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete promotion', array('class' => 'btn btn-danger')) }}
                                                <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.promotions.edit.image', 'promID' => $promotion->promID, 'imgType' => 'image'], 'method' => 'get']) }}
                            {{ Form::submit('Edit main photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.promotions.edit.image', 'promID' => $promotion->promID, 'imgType' => 'background_image'], 'method' => 'get']) }}
                            {{ Form::submit('Edit background photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $promotions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
