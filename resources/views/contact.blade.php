
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
<!--    START GET IN TOUCH SECTION      -->
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
<!--    END GET IN TOUCH SECTION      -->

<!--    START CONTACT INFO SECTION      -->
<section id="contact-information" class="contact-section panel fullwidth background-properties space-y" data-section-name="contact-information-panel">
    <div class="container hi-icon-effect text-center text-uppercase">
        <div class="row">
            <div class="col col-sm-4">
                <a class="hi-icon contact-client"></a>
                <h2>{{ trans_choice('contact.type', 0) }}</h2>
                <a class="link" href="mailto:inquiry@belgradeluxury.com">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    inquiry@belgradeluxury.com
                </a>
            </div>
            <div class="col col-sm-4">
                <a class="hi-icon contact-partner"></a>
                <h2>{{ trans_choice('contact.type', 1) }}</h2>
                <a class="link" href="mailto:office@belgradeluxury.com">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    office@belgradeluxury.com
                </a>                
            </div>
            <div class="col col-sm-4">
                <a class="hi-icon contact-career"></a>
                <h2>{{ trans_choice('contact.type', 2) }}</h2>
                <a class="link" href="mailto:careers@belgradeluxury.com">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    careers@belgradeluxury.com
                </a>
            </div>
        </div>

        <div style="margin: 50px 0">
            <h5>@lang('contact.general information')</h5>
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
    
    <div class="container-fluid">
        <div class="row">
            <div class="">
                <div id="map-canvas" class="google-map" data-lat="44.8159831" data-long="20.4579811" data-img="{{ url("") }}/images/map-pin.png" ></div>
            </div>
        </div>
    </div>
</section>
<!--    END CONTACT INFO SECTION      -->

<!--    START CONTACT US SECTION      -->
<section id="contact-us" class="contact-section panel widescreen background-properties space-y" data-section-name="contact-us-panel" style="background-image: url(../images/backgrounds/contact1.jpg)">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
            <div>
                {{ Form::open(['route' => 'contact', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) }}
                
                <div class="row">
                    <div class="form-group col-sm-6 {{ $errors->has('subject') ? ' has-error' : '' }}">
                        <label for="subject" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label">Nature of enquiry: </label>

                        <div class="col-xs-5 col-sm-6">
                            <select id="subject" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
                                <option value="client">Client support</option>
                                <option value="business">Business inquiry</option>
                                <option value="careers">Career opportunities</option>
                            </select>
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-6 {{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label">Country: </label>

                        <div class="col-xs-5 col-sm-6">
                            <select id="country" class="form-control" name="country" value="{{ old('country') }}" required>
                                <option value="Srbija">Србија</option>
                                <option value="Crna Gora">Црна Гора</option>
                                <option value="Hrvatska">Hrvatska</option>
                                <option value="Makedonija">Македонија</option>
                            </select>
                            @if ($errors->has('country'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-sm-6 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label">First Name: *</label>

                        <div class="col-xs-5 col-sm-6">
                            <input id="first_name" type="text" maxlength="255" class="form-control" name="first_name" value="{{ old('first_name') }}" required>

                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-sm-6 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label">Last Name: *</label>

                        <div class="col-xs-5 col-sm-6">
                            <input id="last_name" type="text" maxlength="255" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-sm-12{{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="message" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-3 control-label">Message: </label>

                        <div class="col-xs-5 col-sm-9">
                            <textarea id="message" maxlength="800" 
                                      rows="5" cols="70" class="form-control" 
                                      name="message">{{ old('message') }}</textarea>

                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            {{ Form::submit('Send message', ['class' => 'btn']) }}
                        </div>
                    </div>
                </div>
                
                {{ Form::close() }}
            </div>
        </div>
    </div>    
</section>
<!--    END CONTACT US SECTION      -->

@stop

@section('scripts')
<script src="{{ url("") }}/js/map.js"></script>
@stop
