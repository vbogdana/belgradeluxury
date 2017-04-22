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
<title>@lang('titles.wellness-&-spa') - Belgrade Luxury</title>
<meta name="description" content="" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.wellness-&-spa') }} - Belgrade Luxury" />
<meta property="og:description" content="" />
<meta property="og:image" content='{{ url("/") }}/images/services/wellness-&-spa.jpg' />   
@stop

@section('stylesheets')
@stop

@section('content')
<!--   START WELLNESS & SPA SERVICES DESCRIPTION PANEL SECTION      -->
<section id="wellness" class="service-description-section box panel widescreen background-properties" data-section-name="wellness-&-spa-panel">
    <div class="overlay"></div>
    <div class="box-left">
        <div class="hero-holder">
            <div class="hero-inner">
                <div class="description">
                    <h1 class="text-uppercase">@lang('common.wellness-&-spa')</h1>
                    <p>
                        {{ trans_choice('services.wellness-&-spa', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.wellness-&-spa', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END WELLNESS & SPA SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => true])

<section id='service-info' class='service-info-section fullwidth panel space-y' data-section-name='service-info-panel'>
    <div class="container text-center row-list">
        <div class='description'>
            <h1 class='text-uppercase'>@lang('common.wellness-&-spa')</h1>
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