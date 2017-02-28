
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>Belgrade Luxury - @lang('titles.contact') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade accommodation, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ LaravelLocalization::getLocalizedURL() }}">
<meta property="og:title" content="Belgrade Luxury - {{ Lang::get('titles.contact') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ route("/") }}/images/backgrounds/contact.jpg' />   
@stop

@section('stylesheets')
<link href="{{ url("") }}/css/contact.css" rel="stylesheet" type="text/css">
@stop

@section('content')
<section id="contact-panel" class="contact-section panel widescreen background-properties">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
            <div class="description">
                <h1 class="text-uppercase">@lang('contact.h1')</h1>
                <p>@lang('contact.description')</p>
                <a data-scroll href="#contact-us" class="btn">@lang('common.contact')</a>
            </div>
        </div>
    </div>    
</section>

<section id="contact-us" class="contact-section panel widescreen background-properties space-y">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
            <div class="col-sm-4">
                <a class="hi-icon contact-client">
                    <h2>{{ trans_choice('contact.type', 0) }}</h2>
                </a>
            </div>
            <div class="col-sm-4">
                <a class="hi-icon contact-partner"></a>
                <h2>{{ trans_choice('contact.type', 1) }}</h2>
            </div>
            <div class="col-sm-4">
                <a class="hi-icon contact-career"></a>
                <h2>{{ trans_choice('contact.type', 2) }}</h2>
            </div>
        </div>
    </div>    
</section>

@stop

@section('scripts')
@stop
