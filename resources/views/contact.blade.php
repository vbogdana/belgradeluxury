
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
<section id="get-in-touch" class="contact-section panel widescreen background-properties" data-section-name="get-in-touch-panel">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
            <div class="description">
                <h1 class="text-uppercase">@lang('contact.h1')</h1>
                <p>@lang('contact.description')</p>
                <a class="btn" data-scroll href="#contact-information">@lang('common.contact')</a>
            </div>
        </div>
    </div>    
</section>

<section id="contact-information" class="contact-section panel fullwidth background-properties space-y" data-section-name="contact-information-panel">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner hi-icon-effect text-center text-uppercase">
            <div class="col">
                <a class="hi-icon contact-client"></a>
                <h2>{{ trans_choice('contact.type', 0) }}</h2>
                <a class="link" href="mailto:inquiry@belgradeluxury.com">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    inquiry@belgradeluxury.com
                </a>
            </div>
            <div class="col">
                <a class="hi-icon contact-partner"></a>
                <h2>{{ trans_choice('contact.type', 1) }}</h2>
                <a class="link" href="mailto:office@belgradeluxury.com">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    office@belgradeluxury.com
                </a>                
            </div>
            <div class="col">
                <a class="hi-icon contact-career"></a>
                <h2>{{ trans_choice('contact.type', 2) }}</h2>
                <a class="link" href="mailto:careers@belgradeluxury.com">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    careers@belgradeluxury.com
                </a>
            </div>
            <div>
                <p>
                    <a class="link" href="#">
                        <i class="fa fa-globe" aria-hidden="true"></i>
                        @lang('common.belgrade'), @lang('common.serbia')
                    </a>
                    <br/>
                    <a class="link" href="tel:+381644519017">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        (+381) 064 4519 017
                    </a>
                    <br/>
                    SMS, WhatsApp & Viber                                        
                </p>
            </div>
        </div>
    </div>    
</section>

<section id="contact-us" class="contact-section panel widescreen background-properties space-y" data-section-name="contact-us-panel" style="background-image: url(../images/backgrounds/contact1.jpg)">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
            
        </div>
    </div>    
</section>

@stop

@section('scripts')
@stop
