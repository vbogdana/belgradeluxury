<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  - 
-->
@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>@lang('titles.sightseeing') - Belgrade Luxury</title>
<meta name="description" content="" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.sightseeing') }} - Belgrade Luxury" />
<meta property="og:description" content="" />
<meta property="og:image" content='{{ url("/") }}/images/services/sightseeing.jpg' />   
@stop

@section('stylesheets')
@stop

@section('content')
<!--   START SIGHTSEEING SERVICES DESCRIPTION PANEL SECTION      -->
<section id="sightseeing" class="service-description-section box panel widescreen background-properties" data-section-name="sightseeing-panel">
    <div class="overlay"></div>
    <div class="box-left">
        <div class="hero-holder">
            <div class="hero-inner">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.sightseeing')</h2>
                    <p>
                        {{ trans_choice('services.sightseeing', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.sightseeing', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END SIGHTSEEING SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => true])

<section id='service-info' class='service-info-section fullwidth panel space-y' data-section-name='service-info-panel'>
    <div class="container text-center row-list">
        <div class='description'>
            <h1 class='text-uppercase'>@lang('common.sightseeing')</h1>
            <p>

            </p>               
            <p></p>
        </div>

        @include('services.list-service-texts', ['texts' => $texts])
    </div> 
</section>

@include('inquiry-section')

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')

@stop