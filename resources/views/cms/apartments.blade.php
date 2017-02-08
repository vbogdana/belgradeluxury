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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">CMS Dashboard</div>

                <div class="panel-body">
                    @foreach($accommodation as $acc)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-12 col-sm-3">
                            <img class="img-responsive" src="{{ asset('storage/app/public/images/'.$acc->image) }}">
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            {{ $acc->title_en }}
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            {{ Form::open(['route' => ['cms.delete.accommodation', $acc->accID], 'method' => 'delete']) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-primary')) }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            {{ Form::open(['route' => ['cms.create.accommodation.image', $acc->accID], 'method' => 'get']) }}
                            {{ Form::submit('Add photo', array('class' => 'btn btn-primary')) }}
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
