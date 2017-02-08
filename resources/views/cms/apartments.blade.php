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
                    <div class="row">
                        <div class="col-xs-3">
                            <img class="img-responsive" src="{{ asset('storage/app/public/images/'.$acc->image) }}">
                        </div>
                        <div class="col-xs-3">
                            {{ $acc->title_en }}
                        </div>
                        <div class="col-xs-3">
                            {{ Form::open(['route' => ['cms.delete.accommodation', $acc->accID], 'method' => 'delete']) }}
                            {{ Form::submit('Delete') }}
                            {{ Form::close() }}
                        </div>
                        <div class="col-xs-3">
                            
                            <a href="{{ route("cms.create.accommodation.image", ["accID" => $acc->accID]) }}">Add photo</a>
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
