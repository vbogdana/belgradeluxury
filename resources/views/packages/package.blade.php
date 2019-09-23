<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  - 
-->
@extends('layouts.master')

<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>

@section('title-meta')
<!-- page titles and meta tags -->
<title>@lang('titles.package', ['package' => $package['title_'.$locale]]) - Belgrade Luxury</title>
<meta name="description" content="{{ strip_tags($package['description_'.$locale]) }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.package', ['package' => $package['title_'.$locale]]) }} - Belgrade Luxury" />
<meta property="og:description" content="{{ strip_tags($package['description_'.$locale]) }}"/>      
<meta property="og:image" content='{{ asset('storage/images/'.$package->cardFront) }}' />   
@stop

@section('stylesheets')
<link href="{{ url("") }}/css/services.css" rel="stylesheet" type="text/css">
@stop

@section('language-toolbar')
@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
<li>
    <a rel="alternate" hreflang="{{ $localeCode }}" 
       href="
        <?php 
            $url = LaravelLocalization::getLocalizedURL($localeCode);
            $titleStart = strrpos($url, "/");
            $titleEnd = strpos($url, "-");
            $url = substr($url, 0, $titleStart + 1).str_replace(' ', '-', $package['title_'.$localeCode]).substr($url, $titleEnd);
            echo $url;
        ?>
       ">
        {{ $properties['native'] }}
    </a>
</li>
@endforeach
@stop

@section('content')
<!--   START PACKAGE DESCRIPTION PANEL SECTION      -->
<section id="package-description" class="package-description-section box panel widescreen background-properties" data-section-name="package-description-panel">
    <div class="overlay"></div>
    <div class="box-right">
        <div class="hero-holder" style="float:right">
            <div class="hero-inner text-right">
                <div class="description">
                    <h1 class="text-uppercase">{{ $package['title_'.$locale] }} @lang('common.package')</h1>
                    <p>{!! html_entity_decode($package['description_'.$locale]) !!} </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--   END PACKAGE DESCRIPTION SECTION      -->

<!--   START INQUIRY SECTION      -->
<section id="inquiry" class="service-inquiry-section interstitial ribbon fullwidth space-y text-center" data-section-name="inquiry-panel">            
    <img class="img-responsive" src='{{ asset('storage/images/'.$package->symbol) }}' style='max-width: 300px; display: inline-block; margin-bottom: 0px'> 
    <div class="container text-center text-uppercase">              
        <h4>
        <a id="inquiry" style=""
           data-scroll href='#package-details'>
            <p style="margin: 5px 0; color: #E5E4E2">@lang('common.details')</p> 
            <i class='fa fa-pulse fa-angle-down' style="color: #E5E4E2; margin-left: 10px;"></i>
        </a> 
        </h4>   
    </div>   
</section>
<!--   END INQUIRY SECTION      -->

@include('package-inquiry-section', $package)

<!--   START PACKAGE DETAILS PANEL SECTION      -->
<section id="package-details" class="package-details-section box panel widescreen background-properties" data-section-name="package-details-panel">
    <div class="overlay"></div>
    <div class="container-fluid">
        <div class="widescreen">
            <div class="box-left">
                <div class="hero-holder">
                    <div class="hero-inner">
                        <div class="description">
                            <h2 class="text-uppercase">@lang('common.package details')</h2>
                            <p>
                                {{ trans_choice('common.booking', 0) }}
                            </p>
                            <p>
                                {{ trans_choice('common.booking', 1) }}
                            </p>
                            <p>
                                {{ trans_choice('common.booking', 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="package-details col-xs-12 col-sm-offset-5 col-sm-7 space-y-t text-center">
            <div class="row hi-icon-effect">
            <?php $i = 0; ?>
            @foreach($package->included_services as $ps)
                <div class="col-sm-4 text-uppercase">
                    <a href="{{ route(str_replace(" ", "-", strtolower($ps->service->name_en))) }}" class="hi-icon services-{{ strtolower($ps->service->name_en) }}"></a>
                    <h6>{{ $ps->service['name_'.$locale] }}</h6>
                    <h5>{{ $ps['title_'.$locale] }}</h5>        
                </div>               
            <?php $i++; ?>
                @if($i%3 === 0)
                <div class="clearfix"></div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
</section>
<!--   END PACKAGE DETAILS SECTION      -->

<!--    START OPTIONAL SERVICES SECTION      -->
<section id="offer-details" class="offer-details-section fullwidth space-y" data-section-name="offer-details-panel">
    <div class="container">  
        <div class="description text-center text-uppercase space-y-t">
            <h2> {{ trans_choice('common.optional', 1) }} @lang('common.services') </h2>
            <p></p>
            <div class="offer-details row hi-icon-effect text-center">
                <?php $i = 0; ?>
                @foreach($package->optional_services as $service)
                @if($i%3 === 0)
                <div class="clearfix"></div>
                @endif
                <div class="col-sm-4 text-uppercase">
                    <a href="{{ route(str_replace(" ", "-", strtolower($service->service->name_en))) }}" class="hi-icon services-{{ str_replace(" ", "-", strtolower($service->service->name_en)) }}"></a>
                    <h6>{{ $service->service['name_'.$locale] }}</h6>
                    <h5>{{ $service['title_'.$locale] }}</h5>     
                </div>
                <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </div>
    
</section>
<!--    END OPTIONAL SERVICES SECTION      -->

<!--    START ABOUT SECTION      -->
<section id="about" class="about-section fullwidth background-properties" data-section-name="about-panel" style="background-image: url('{{ asset('storage/images/'.$package->symbol) }}')">
    <div class="overlay"></div>
    <div class="hero-holder space-y" style="background: rgba(0,0,0,0.5);">
        <div class="hero-inner">
            <div class="container">
                <div class="description text-center">
                    <h2 class="text-uppercase"> {{ $package['title_'.$locale] }} {{ trans_choice('common.package', 0) }} </h2>
                    <p></p>
                </div>

                {!! html_entity_decode($package['long_description_'.$locale]) !!}

                <div class="text-center">
                <a id="inquiry" class="btn" href='{{ route("packages.inquiry", [ 'title' => str_replace(" ", "-", $package['title_'.$locale]) ]) }}'> @lang('common.send an inquiry') </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!--    END ABOUT SECTION      -->

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')
<script src="{{ url("/") }}/js/reflection.js"></script>
@stop
