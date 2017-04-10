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
<title>@lang('titles.accommodation') - Belgrade Luxury</title>
<meta name="description" content="{{ trans_choice('services.accommodation', 0) }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.accommodation') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ trans_choice('services.accommodation', 0) }}" />      
<meta property="og:image" content='{{ url("/") }}/images/services/accommodation.jpg' />   
@stop

@section('stylesheets')
@stop

@section('content')
<!--   START ACCOMMODATION SERVICES DESCRIPTION PANEL SECTION      -->
<section id="accommodation" class="service-description-section box panel widescreen background-properties" data-section-name="accommodation-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.accommodation')</h2>
                    <p>
                        {{ trans_choice('services.accommodation', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.accommodation', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END ACCOMMODATION SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => false])

@include('services.list', ['service' => 'accommodation', 'list' => $list, 'types' => $types, 'packages' => $packages])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@include('services.script', ['types' => $types])
@stop