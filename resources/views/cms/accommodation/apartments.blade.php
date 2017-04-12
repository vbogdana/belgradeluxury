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
                    All apartments
                </div>
                <div class="panel-heading">
                    <a href="{{ route('cms.accommodation.apartment.create') }}">New apartment</a>
                </div>
                <div class='panel-heading'>
                    {{ Form::open(['route' => 'cms.accommodation.apartments', 'method' => 'post', 'class' => 'form-horizontal']) }}
                    <div class="form-group{{ $errors->has('people') ? ' has-error' : '' }}">
                        <label for="people" class="col-md-3 control-label">Filter By Number of People</label>

                        <div class="col-md-6">
                            <input id="people" type="range" min="1" max="20" step="1" class="form-control" name="people" value="{{ old('people') }}" onchange="showPeople()">

                            @if ($errors->has('people'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('people') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-2">
                            <input id="peopleText" type="text" disabled="">
                        </div>
                    </div>
                    <div class='form-group text-center'>
                        {{ Form::submit('Filter', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                    </div>
                    {{ Form::close() }}
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
                            No image
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <a href='{{ route("accommodation.single", ['accID' => $acc->accID, 'title' => $acc->title_sr]) }}' target='_blank'>
                                <h4>{{ $acc->title_en }}</h4>
                            </a>
                            @if ($acc->spa)
                            <h5><strong>SPA</strong></h5>
                            @endif                          
                            <a href='http://maps.apple.com/?q={{ $acc->geoLat.','.$acc->geoLong }}' target='_blank'>{{ $acc->address }}</a>
                            <br/><strong>{{ $acc->apartment()->people }} people</strong>
                            <br/><strong>{{ $acc->price }}€</strong>
                            @if ($acc->link != null)
                            <br/><a href="{{ $acc->link }}">{{ $acc->link }}</a>
                            @endif
                            <br/><strong>priority: {{ $acc->getPriority() }}</strong>
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.accommodation.apartment.edit', $acc->accID], 'method' => 'get']) }}
                            {{ Form::submit('Edit data', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.accommodation.edit.main-image', $acc->accID], 'method' => 'get']) }}
                            {{ Form::submit('Edit main photo', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            <button class="btn btn-danger" data-toggle="modal" data-target="#myModal{{$acc->accID}}">
                                Delete apartment
                            </button>
                            <div class="modal fade" id="myModal{{$acc->accID}}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete an apartment</h4>
                                        </div>

                                        <div class="modal-body">
                                            Are you sure?<br/>
                                            <div style="margin-top: 15px">
                                                {{ Form::open(['route' => ['cms.accommodation.delete', $acc->accID], 'method' => 'delete']) }}                      
                                                {{ Form::submit('Delete apartment', array('class' => 'btn btn-danger')) }}
                                                <button type="button" class="btn btn-default" style="margin-left: 15px" data-dismiss="modal">Cancel</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3" style="padding-top: 15px">
                            {{ Form::open(['route' => ['cms.accommodation.create.images', $acc->accID], 'method' => 'get']) }}
                            {{ Form::submit('Add photos', array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 5px')) }}
                            {{ Form::close() }}
                            
                            {{ Form::open(['route' => ['cms.accommodation.delete.images', $acc->accID], 'method' => 'get']) }}
                            {{ Form::submit('Remove photos', array('class' => 'btn btn-primary')) }}
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

@section('scripts')
<script>   
    function showPeople() {
        var people = $('#people').val();
        $('#peopleText').attr('value', people);
    }
    
    showPeople();

    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            window.location = window.location.href + '&page=' + page;
        });
    });
</script>
@stop
