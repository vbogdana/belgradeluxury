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
<title>Belgrade Luxury - @lang('titles.gastronomy') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury gastronomy, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade gastronomy, serbian clubs, serbian gastronomy, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade gastronomy, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route("gastronomy") }}">
<meta property="og:title" content="Belgrade Luxury - {{ Lang::get('titles.gastronomy') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury gastronomy, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
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

@include('inquiry-section')

@include('services.list', ['service' => 'gastronomy', 'list' => $list, 'types' => $types, 'packages' => $packages])

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
@include('services.script', ['types' => $types])
@stop