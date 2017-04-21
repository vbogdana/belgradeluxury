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
<!--
    OVDE IDE SADRZAJ SEKCIJE, TJ OPIS USLUGA
    SAV TEKST SE MORA CITATI POMOCU lang i trans_choice() IZ resources/lang FAJLOVA
    PROCITATI O TOME

<div class="container text-center row-list">
    <div class='description'>
        <h1 class='text-uppercase'>Neki naslov</h1>
        <p>
            Svi Belgrade Luxury hostovi su ljubazni, harizmatični i visoko obučeni vodiči
        </p>               
        <p></p>
    </div>
    <img class="gold-decor" src='<?php echo url("/")?>\images\decor.svg'>
    <div class="row">
        <div class="col-sm-4">
            <img class="img-responsive" src="{{ url("") }}/images/services/wellness-&-spa/test1.jpg">
            <div class='content'>
                <h6 class="text-uppercase animated fadeInDown">PODNASLOV</h6>
                <h4 class="text-uppercase animated fadeIn">NASLOV</h4>
                <h6 class="text-uppercase animated fadeInUp">PODNASLOV</h6>
                <p class='text-justify'>
                    Svi Belgrade Luxury hostovi su ljubazni, harizmatični i visoko obučeni vodiči specijalizovani za različite oblasti. Od šetačkih tura po centru grada do bučnih splavova pored reke, oni će Vas upoznati sa Beogradom iz perspektive naše agencije i to na šest različitih jezika!
                </p>
                <a id="inquiry" class="btn" href="{{ route("contact") }}#contact-us">@lang('common.send an inquiry')</a>                   
            </div>
        </div>
        <div class="col-sm-4">
            <img class="img-responsive" src="{{ url("") }}/images/services/wellness-&-spa/test2.jpg">
            <div class='content'>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <h4 class="text-uppercase">NASLOV</h4>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <p class='text-justify'>
                    Svi Belgrade Luxury hostovi su ljubazni, harizmatični i visoko obučeni vodiči specijalizovani za različite oblasti. Od šetačkih tura po centru grada do bučnih splavova pored reke, oni će Vas upoznati sa Beogradom iz perspektive naše agencije i to na šest različitih jezika!
                </p>
                <a id="inquiry" class="btn" href="{{ route("contact") }}#contact-us">@lang('common.send an inquiry')</a>                   
            </div>
        </div>
        <div class="col-sm-4">
            <img class="img-responsive" src="{{ url("") }}/images/services/wellness-&-spa/test3.jpg">
            <div class='content'>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <h4 class="text-uppercase">NASLOV</h4>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <p class='text-justify'>
                    Svi Belgrade Luxury hostovi su ljubazni, harizmatični i visoko obučeni vodiči specijalizovani za različite oblasti.
                </p>
                <a id="inquiry" class="btn" href="{{ route("contact") }}#contact-us">@lang('common.send an inquiry')</a>                   
            </div>
        </div>
    </div>
    <img class="gold-decor" src='<?php echo url("/")?>\images\decor.svg'>
    <div class="row">
        <div class="col-sm-4">
            <img class="img-responsive" src="{{ url("") }}/images/services/wellness-&-spa/test1.jpg">
            <div class='content'>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <h4 class="text-uppercase">NASLOV</h4>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <p class='text-justify'>
                    Svi Belgrade Luxury hostovi su ljubazni, harizmatični i visoko obučeni vodiči specijalizovani za različite oblasti. Od šetačkih tura po centru grada do bučnih splavova pored reke, oni će Vas upoznati sa Beogradom iz perspektive naše agencije i to na šest različitih jezika!
                </p>
                <a id="inquiry" class="btn" href="{{ route("contact") }}#contact-us">@lang('common.send an inquiry')</a>                   
            </div>
        </div>
        <div class="col-sm-4">
            <img class="img-responsive" src="{{ url("") }}/images/services/wellness-&-spa/test2.jpg">
            <div class='content'>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <h4 class="text-uppercase">NASLOV</h4>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <p class='text-justify'>
                    Svi Belgrade Luxury hostovi su ljubazni, harizmatični i visoko obučeni vodiči specijalizovani za različite oblasti. Od šetačkih tura po centru grada do bučnih splavova pored reke, oni će Vas upoznati sa Beogradom iz perspektive naše agencije i to na šest različitih jezika!
                </p>
                <a id="inquiry" class="btn" href="{{ route("contact") }}#contact-us">@lang('common.send an inquiry')</a>                   
            </div>
        </div>
        <div class="col-sm-4">
            <img class="img-responsive" src="{{ url("") }}/images/services/wellness-&-spa/test3.jpg">
            <div class='content'>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <h4 class="text-uppercase">NASLOV</h4>
                <h6 class="text-uppercase">PODNASLOV</h6>
                <p class='text-justify'>
                    Svi Belgrade Luxury hostovi su ljubazni, harizmatični i visoko obučeni vodiči specijalizovani za različite oblasti.
                </p>
                <a id="inquiry" class="btn" href="{{ route("contact") }}#contact-us">@lang('common.send an inquiry')</a>                   
            </div>
        </div>
    </div>
</div>
 -->
</section>

@include('inquiry-section')

@include('packages-sections', ['packages' => $packages])

@stop

@section('scripts')

@stop