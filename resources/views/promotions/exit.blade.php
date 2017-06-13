
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
<meta property="og:image" content='{{ url("/") }}/images/promotions/exit.jpg' />   
@stop

@section('stylesheets')
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
                <a class="btn" data-scroll href="#details">@lang('common.details')</a>
            </div>
        </div>
    </div>    
</section>
<!--    END INTRO SECTION      -->

<!--    START BLOG SECTION      -->
<section id="details" class="details-section fullwidth space-y" data-section-name="details-panel">
	<div class="container">
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
</section>
<!--    END BLOG SECTION      -->

@include('inquiry-section')

@include('social-section')

@stop

@section('scripts')

@stop
