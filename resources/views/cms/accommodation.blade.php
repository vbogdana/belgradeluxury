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
                <div class="panel-heading">Accommodation Dashboard</div>

                <div class="panel-body text-center">
                    <div class="col-sm-4">
                        <a href="{{ route("cms.accommodation.apartments") }}">
                            <h4>Apartments</h4>
                            <img class="img-responsive" src="{{ url("") }}/images/services/apartments.jpg">
                        </a>
                    </div>
                    <div class="col-sm-4 col-sm-offset-0">
                        <a href="{{ route("cms.accommodation.hotels") }}">
                            <h4>Hotels</h4>
                            <img class="img-responsive" src="{{ url("") }}/images/services/hotels.jpg">
                        </a>
                    </div>
                    <div class="col-sm-4 col-sm-offset-0">
                        <a href="{{ route("cms.accommodation.spas") }}">
                            <h4>Spas</h4>
                            <img class="img-responsive" src="{{ url("") }}/images/services/spas.jpg">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
