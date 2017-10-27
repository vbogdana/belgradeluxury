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
<title>{{ $promotion['title_'.$locale] }} - Belgrade Luxury</title>
<meta name="description" content="{{ $promotion['meta_'.$locale] }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ $promotion['title_'.$locale] }} - Belgrade Luxury" />
<meta property="og:description" content="{{ $promotion['meta_'.$locale] }}"/>      
<meta property="og:image" content="{{ asset('storage/images/'.$promotion->image) }}" />   
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
            $url = substr($url, 0, $titleStart + 1).str_replace(' ', '-', $promotion['url_'.$localeCode]);
            echo $url;
        ?>
       ">
        {{ $properties['native'] }}
    </a>
</li>
@endforeach
@stop

@section('content')
<!--    START INTRO SECTION      -->
<section id="intro" class="contact-section panel widescreen background-properties" data-section-name="intro-panel" style="background-image: url('{{ asset('storage/images/'.$promotion->image) }}')">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
            <div class="description">
                <h1 class="text-uppercase" style="padding: 0 15px">{{ $promotion['title_'.$locale] }}</h1>
                <p>{!! html_entity_decode($promotion['description_'.$locale]) !!}</p>
                <a class="btn" data-scroll href="#offer-details">@lang('common.details')</a>
            </div>
        </div>
    </div>    
</section>
<!--    END INTRO SECTION      -->

@include('promotion-inquiry-section', $promotion)

<!--    START OFFER DETAILS SECTION      -->
<section id="offer-details" class="offer-details-section fullwidth space-y" data-section-name="offer-details-panel">
    <div class="container">
        <div class="description text-center text-uppercase">
            <h2> {{ $promotion['title_'.$locale] }} </h2>
            <h4 style="color: #C5B358"> {{ trans_choice('common.included', 1) }} @lang('common.services') </h4>
            <p></p>
            <div class="offer-details row hi-icon-effect text-center">
                <?php $i = 0; ?>
                @foreach($promotion->included_services as $service)
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
                @if($i%3 === 0)
                <div class="clearfix"></div>
                @endif
            </div>
        </div>
        
        <div class="description text-center text-uppercase space-y-t">
            <h2> {{ trans_choice('common.optional', 1) }} @lang('common.services') </h2>
            <p></p>
            <div class="offer-details row hi-icon-effect text-center">
                <?php $i = 0; ?>
                @foreach($promotion->optional_services as $service)
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
<!--    END OFFER DETAILS SECTION      -->

<!--    START BLOG SECTION      -->
<section id="about" class="about-section fullwidth background-properties" data-section-name="about-panel" style="background-image: url('{{ asset('storage/images/'.$promotion->background_image) }}')">
    <div class="overlay"></div>
    <div class="hero-holder space-y" style="background: rgba(0,0,0,0.5);">
        <div class="hero-inner">
            <div class="container">
                <div class="description text-center">
                    <h2 class="text-uppercase"> {{ $promotion['title_'.$locale] }} </h2>
                    <p></p>
                </div>

                {!! html_entity_decode($promotion['long_description_'.$locale]) !!}

                <div class="text-center">
                <a id="inquiry" class="btn" href='{{ route("promotions.inquiry", [ 'url' => str_replace(" ", "-", $promotion['url_'.$locale]) ]) }}'> @lang('common.send an inquiry') </a> 
                </div>

            </div>
        </div>
    </div>
</section>
<!--    END BLOG SECTION      -->

@include('social-section')

@stop

@section('scripts')

@stop
