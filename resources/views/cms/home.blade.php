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
                        <?php $i = 0; ?>
                        @foreach($services as $service)
                            @if($i % 3 == 0 && $i != 0)
                            </div>
                            @endif
                            @if($i % 3 == 0)
                            <div class='row'>
                            @endif
                            @if($service->name_en == "Accommodation" || $service->name_en == "Vehicles")
                                <div class="col-sm-4">
                                     <a href="{{ route("cms.".strtolower($service->name_en)) }}">
                                         <h4>{{ $service->name_en }}</h4>
                                         <img class="img-responsive" src="{{ url("") }}/images/services/{{ strtolower($service->name_en) }}.jpg">
                                     </a>
                                 </div>
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
