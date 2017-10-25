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
<title>@lang('titles.business') - Belgrade Luxury</title>
<meta name="description" content="" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.business') }} - Belgrade Luxury" />
<meta property="og:description" content="" />      
<meta property="og:image" content='{{ url("/") }}/images/services/business.jpg' />   
@stop

@section('stylesheets')
@stop

@section('content')
<!--   START BUSINESS SERVICES DESCRIPTION PANEL SECTION      -->
<section id="business" class="service-description-section box panel widescreen background-properties" data-section-name="business-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float: right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.business')</h2>
                    <p>
                        {{ trans_choice('services.business', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.business', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END BUSINESS SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => true])

<section id='service-info' class='service-info-section fullwidth panel space-y' data-section-name='service-info-panel'>
    <div class="container text-center row-list">
        <div class='description'>
            <h1 class='text-uppercase'>@lang('common.business')</h1>
        </div>

        @include('services.list-service-texts', ['texts' => $texts, 'service' => 'business'])
    </div>
</section>

@include('inquiry-section', ['service' => 'business'])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')

@stop