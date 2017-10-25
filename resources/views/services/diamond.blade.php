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
<title>@lang('titles.diamond') - Belgrade Luxury</title>
<meta name="description" content="" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.diamond') }} - Belgrade Luxury" />
<meta property="og:description" content="" />
<meta property="og:image" content='{{ url("/") }}/images/services/diamond.jpg' />   
@stop

@section('stylesheets')
@stop

@section('content')
<!--   START DIAMOND SERVICES DESCRIPTION PANEL SECTION      -->
<section id="diamond" class="service-description-section box panel widescreen background-properties" data-section-name="diamond-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float: right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">diamond</h2>
                    <p>
                        {{ trans_choice('services.diamond', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.diamond', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END DIAMOND SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => true])

<section id='service-info' class='service-info-section fullwidth panel space-y' data-section-name='service-info-panel'>
    <div class="container text-center row-list">
        <div class='description'>
            <h1 class='text-uppercase'>diamond</h1>
        </div>

        @include('services.list-service-texts', ['texts' => $texts, 'service' => 'diamond'])
    </div>  
</section>

@include('inquiry-section', ['service' => 'diamond'])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')

@stop