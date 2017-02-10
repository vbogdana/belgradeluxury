<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -
-->

@extends('layouts.cms')

@section('content')
<style>
    .col-sm-4 a {
        height: 100%;
        width: 100%;
    }
    .col-sm-4 a:hover img {
        transform: scale(1.05);
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">CMS Dashboard</div>

                <div class="panel-body text-center">
                    <div class='container'>
                        @foreach($services as $service)
                            <?php $i = 0; ?>
                            @if($i % 3 == 0)
                            <div class='row'>
                            @endif
                                <div class="col-sm-4">
                                     <a href="{{ route("cms.".strtolower($service->name)) }}">
                                         <h4>{{ $service->name }}</h4>
                                         <img class="img-responsive" src="{{ url("") }}/images/services/{{ strtolower($service->name) }}.jpg">
                                     </a>
                                 </div>
                            @if($i % 3 == 0)
                            <div class='row'>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                    </div>                                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
