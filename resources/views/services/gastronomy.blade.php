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
<title>@lang('titles.gastronomy') - Belgrade Luxury</title>
<meta name="description" content="{{ trans_choice('services.gastronomy', 2).' '.trans_choice('services.gastronomy', 0) }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.gastronomy') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ trans_choice('services.gastronomy', 2).' '.trans_choice('services.gastronomy', 0) }}" />
<meta property="og:image" content='{{ url("/") }}/images/services/gastronomy.jpg' />   
@stop

@section('stylesheets')

@stop

@section('content')
<!--   START GASTRONOMY SERVICES DESCRIPTION PANEL SECTION      -->
<section id="gastronomy" class="service-description-section box panel widescreen background-properties" data-section-name="gastronomy-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h2 class="text-uppercase">@lang('common.gastronomy')</h2>
                    <p>
                        {{ trans_choice('services.gastronomy', 0) }}
                    </p>
                    <p>
                        {{ trans_choice('services.gastronomy', 1) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END GASTRONOMY SERVICES DESCRIPTION SECTION      -->

@include('contact-us-section', ['inquiry' => false])

@include('services.list', ['service' => 'gastronomy', 'list' => $list, 'types' => $types, 'packages' => $packages])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@include('services.script', ['types' => $types])
@stop