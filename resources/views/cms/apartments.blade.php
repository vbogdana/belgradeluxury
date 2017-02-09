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
                    All apartments
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.create.apartment') }}">New apartment</a>
                </div>

                <div class="panel-body">
                    <div class="panel-info" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 20px">
                        To delete an apartment select 'Delete apartment'.<br/>
                        To edit info about an apartment select 'Edit data'.<br/>
                        To edit main photo of an apartment select 'Edit main photo'.<br/>
                        To add additional photos to an apartment select 'Add photos'.<br/>
                        To remove photos from an apartment select 'Remove photos'.
                    </div>
                    @foreach($accommodation as $acc)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            @if ($acc->image != null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$acc->image) }}">
                            @else
                            <img class="img-responsive" src="{{ url("") }}/images/services/accommodation.jpg">
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <h4>{{ $acc->title_en }}</h4>                           
                            {{ $acc->address }}
                            @if ($acc->link != null)
                            <br/><a href="{{ $acc->link }}">{{ $acc->link }}</a>
                            @endif
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.edit.apartment', $acc->accID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.edit.accommodation.main-image', $acc->accID], 'method' => 'get']) }}
                            {{ Form::submit('Edit main photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.delete.accommodation', $acc->accID], 'method' => 'delete']) }}
                            {{ Form::submit('Delete apartment', array('class' => 'btn btn-primary')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.create.accommodation.image', $acc->accID], 'method' => 'get']) }}
                            {{ Form::submit('Add photos', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    @endforeach
                    
                    {{ $accommodation->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
