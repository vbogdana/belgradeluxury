
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>@lang('promotions.exit.title') - Belgrade Luxury</title>
<meta name="description" content="{{ Lang::get('promotions.exit.meta') }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('promotions.exit.title') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ Lang::get('promotions.exit.meta') }}" />     
<meta property="og:image" content='{{ url("/") }}/images/promotions/exit4.jpg' />   
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
            $url = substr($url, 0, $titleStart + 1).substr($url, $titleStart + 1);
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
<section id="intro" class="contact-section panel widescreen background-properties" data-section-name="intro-panel" style="background-image: url('../../images/promotions/exit.jpg')">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
            <div class="description">
                <h1 class="text-uppercase" style="padding: 0 15px">@lang('promotions.exit.title')</h1>
                <p>@lang('promotions.exit.description')</p>
                <a class="btn" data-scroll href="#offer-details">@lang('common.details')</a>
            </div>
        </div>
    </div>    
</section>
<!--    END INTRO SECTION      -->

<!--    START OFFER DETAILS SECTION      -->
<section id="offer-details" class="offer-details-section fullwidth space-y" data-section-name="offer-details-panel">
    <div class="container">
        <div class="description text-center text-uppercase">
            <h2> {{ trans_choice('promotions.exit.offer.title', 0) }} </h2>
            <h4 style="color: #C5B358"> {{ trans_choice('promotions.exit.offer.title', 1) }} </h4>
            <p></p>
            <div class="offer-details row hi-icon-effect text-center">
                @for($i=0; $i<7; $i++)
            <?php
            $service = explode( ":", trans_choice('promotions.exit.offer.services', $i) );
            ?>
                @if($i%3 === 0)
                <div class="clearfix"></div>
                @endif
                <div class="col-sm-4 text-uppercase">
                    <a href="{{ route($service[0]) }}" class="hi-icon services-{{ $service[0] }}"></a>
                    <h6>@lang('common.'.$service[0])</h6>
                    <h5>{{ $service[1] }}</h5>        
                </div>
                @endfor
                @if($i%3 === 0)
                <div class="clearfix"></div>
                @endif
            </div>
        </div>
        
        <div class="description text-center text-uppercase space-y-t">
            <h2> {{ trans_choice('promotions.exit.offer.title', 2) }} </h2>
            <p></p>
            <div class="offer-details row hi-icon-effect text-center">
                @for($i=0; $i<2; $i++)
            <?php
            $service = explode( ":", trans_choice('promotions.exit.offer.optional', $i) );
            ?>
                @if($i%3 === 0)
                <div class="clearfix"></div>
                @endif
                <div class="col-sm-4 text-uppercase">
                    <a href="{{ route($service[0]) }}" class="hi-icon services-{{ $service[0] }}"></a>
                    <h6>@lang('common.'.$service[0])</h6>
                    <h5>{{ $service[1] }}</h5>        
                </div>
                @endfor
            </div>
        </div>
    </div>
	
</section>
<!--    END OFFER DETAILS SECTION      -->

<!--    START BLOG SECTION      -->
<section id="about" class="about-section fullwidth background-properties" data-section-name="about-panel" style="background-image: url('../../images/promotions/exit5.jpg')">
    <div class="overlay"></div>
    <div class="hero-holder space-y" style="background: rgba(0,0,0,0.5);">
        <div class="hero-inner">
            <div class="container">
                <div class="description text-center">
                    <h2 class="text-uppercase"> @lang('promotions.exit.title') </h2>
                    <p></p>
                </div>

                <?php
                $paragraphs = explode( ";", Lang::get('promotions.exit.paragraphs') );
                ?>
                @foreach ($paragraphs as $p)
                        <p>
                        {{ $p }}
                        </p>
                @endforeach

                <p>
                    <a href="http://www.exitfest.org" class="text-center text-uppercase">@lang('promotions.exit.details') exitfest.org</a>
                </p>
            </div>
        </div>
    </div>
</section>
<!--    END BLOG SECTION      -->

@include('inquiry-section')

@include('social-section')

@stop

@section('scripts')

@stop
