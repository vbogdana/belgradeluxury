
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>@lang('titles.contact') - Belgrade Luxury</title>
<meta name="description" content="{{ Lang::get('common.meta.contact') }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="{{ Lang::get('titles.contact') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ Lang::get('common.meta.contact') }}" />     
<meta property="og:image" content='{{ url("/") }}/images/backgrounds/contact.jpg' />   
@stop

@section('stylesheets')
<script src='https://www.google.com/recaptcha/api.js'></script>
@stop

@section('content')
<!--    START GET IN TOUCH SECTION      -->
<section id="get-in-touch" class="contact-section panel widescreen background-properties" data-section-name="get-in-touch-panel">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
            <div class="description">
                <h1 class="text-uppercase" style="padding: 0 15px">@lang('contact.h1')</h1>
                <p>@lang('contact.description')</p>
                <a class="btn" data-scroll href="#contact-information">@lang('common.contact')</a>
            </div>
        </div>
    </div>    
</section>
<!--    END GET IN TOUCH SECTION      -->

<!--    START CONTACT INFO SECTION      -->
<section id="contact-information" class="contact-section panel fullwidth space-y" data-section-name="contact-information-panel">
    <div class="container-fluid hi-icon-effect text-center text-uppercase" style="overflow-x: hidden">
        <div class="row">
            <div class="col col-sm-4">
                <a class="hi-icon contact-client" data-scroll href="#contact-us"></a>
                <h2>{{ trans_choice('contact.type', 0) }}</h2>
                <a class="link" href="mailto:inquiry@belgradeluxury.com">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    inquiry@belgradeluxury.com
                </a>
            </div>
            <div class="col col-sm-4">
                <a class="hi-icon contact-partner" data-scroll href="#contact-us"></a>
                <h2>{{ trans_choice('contact.type', 1) }}</h2>
                <a class="link" href="mailto:office@belgradeluxury.com">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    office@belgradeluxury.com
                </a>                
            </div>
            <div class="col col-sm-4">
                <a class="hi-icon contact-career" data-scroll href="#contact-us"></a>
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
                <a class="link" href="http://maps.apple.com/?q=44.8159831,20.4579811">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    @lang('common.belgrade'), @lang('common.serbia')
                </a>
                <br/>
                <a class="link" href="tel:+381613180874">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    (+381) 061 3180 874
                </a>
                <br/>
                SMS, WhatsApp & Viber                                        
            </p>
        </div>  
        
        <div class="container-fluid">
            <div class="row">
                <div class="">
                    <div id="map-canvas" class="google-map" data-lat="44.8159831" data-long="20.4579811" data-img="{{ url("") }}/images/map-pin.png" ></div>
                </div>
            </div>
        </div>    
    </div>
    
</section>
<!--    END CONTACT INFO SECTION      -->

<!--    START CONTACT US SECTION      -->
<section id="contact-us" class="contact-section panel fullwidth background-properties space-y" data-section-name="contact-us-panel" style="background-image: url(../images/backgrounds/contact1.jpg)">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
   
            <div>
                {{ Form::open(['route' => 'contact', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'autocomplete' => 'off']) }}
                
                <div class="container-fluid" style="font-family: Aspergit, Raleway, sans-serif">
                    <div class="description text-center">
                        <h2 class="text-uppercase"> @lang('contact.form')</h2>
                        <p id="status" style="font-size: 1.2em"></p>           
                    </div>    
                </div>
                
                <div class="container-fluid">
                    
                    <div class="row">                       
                        <div class="form-group col-sm-6">
                            <label for="name" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label">@lang('contact.name'): *</label>

                            <div class="col-xs-5 col-sm-6">
                                <input id="name" type="text" maxlength="255" class="form-control" name="name" required>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="email" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label">@lang('contact.email'): *</label>

                            <div class="col-xs-5 col-sm-6">
                                <input id="email" type="text" maxlength="255" class="form-control" name="email" required>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="subject" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label">@lang('contact.subject'):</label>

                            <div class="col-xs-5 col-sm-6">
                                <select id="subject" class="form-control" name="subject" onchange="enableBusiness()">
                                    <option value="client">{{ trans_choice('contact.type', 0) }}</option>
                                    <option value="business">{{ trans_choice('contact.type', 1) }}</option>
                                    <option value="careers">{{ trans_choice('contact.type', 2) }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="country" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label">@lang('contact.country'):</label>

                            <div class="col-xs-5 col-sm-6">
                                <select id="country" class="form-control" name="country">
                                    <option value="Srbija">Србија</option>
                                    <option value="Crna Gora">Црна Гора</option>
                                    <option value="Hrvatska">Hrvatska</option>
                                    <option value="Makedonija">Македонија</option>
                                    <option value="Slovenija">Slovenija</option>
                                    <option value="Bugarska">България</option>
                                    <option value="Madjarska">Magyarország</option>
                                    <option value="Rumunija">România</option>
                                    <option value="Rusija">Росси́я</option>
                                    <option value="Grcka">Ελλάς</option>
                                    <option value="Turska">Türkiye</option>
                                    <option value="Austrija">Österreich</option>
                                    <option value="USA">USA</option>
                                    <option value="Kanada">Canada</option>
                                    <option value="Nemacka">Deutschland</option>
                                    <option value="Francuska">France</option>
                                    <option value="Spanija">España</option>
                                    <option value="Velika Britanija">UK</option>
                                    <option value="druga zemlja" class="text-uppercase">@lang('contact.other')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="company" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label" disabled>@lang('contact.company name'): *</label>

                            <div class="col-xs-5 col-sm-6">
                                <input id="company" type="text" maxlength="255" class="form-control" name="company" required disabled>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="website" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-6 control-label" disabled>@lang('contact.company website'):</label>

                            <div class="col-xs-5 col-sm-6">
                                <input id="website" type="text" maxlength="255" class="form-control" name="website" disabled>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="message" class="col-xs-offset-1 col-xs-5 col-sm-offset-0 col-sm-3 control-label">{{ trans_choice('contact.message', 0) }}:</label>

                            <div class="col-xs-5 col-sm-9" style="padding-right: 30px">
                                <textarea id="message" maxlength="800" 
                                          rows="5" cols="70" class="form-control" 
                                          name="message"></textarea>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::submit(Lang::get('contact.send').' '.trans_choice('contact.message', 1), ['class' => 'btn g-recaptcha', 'style' => 'display: inline-block', 'data-sitekey' => env('GOOGLE_RECAPTCHA_KEY', 'Did not work'), 'data-callback' => 'sendMessage']) }}
                    </div>
                </div>
                
                {{ Form::close() }}
            </div>
        </div>
    </div>    
</section>
<!--    END CONTACT US SECTION      -->

@include('social-section')

@stop

@section('scripts')
<script>   
    var validation = true;
    
    /*$(window).on('load', function() {
        $('input[type=submit]').on('click', function(ev) {
            ev.preventDefault();
            sendMessage();
        });
    });*/
    
    function enableBusiness() {
        val = $('#subject').val();
        if (val === "business") {
            $("label[for=company]").removeAttr('disabled');
            $("#company").removeAttr('disabled');
            $("label[for=website]").removeAttr('disabled');
            $("#website").removeAttr('disabled');
        } else {
            $("label[for=company]").attr('disabled', '');
            $("#company").attr('disabled', '');
            $("label[for=website]").attr('disabled', '');
            $("#website").attr('disabled', '');           
        }
    }

    function checkError(msg, field, offset) {
        i = msg.responseText.search("\"" + field + "\"");            
        var error = msg.responseText.substring(i + offset);
        var message = error.substring(0, error.indexOf("\""));
        var r = /\\u([\d\w]{4})/gi;
        message = message.replace(r, function (match, grp) {
            return String.fromCharCode(parseInt(grp, 16)); 
        } );
        message = unescape(message);
        div = $('#' + field).parent().parent();
        div.addClass('has-error');
        block = div.find('.help-block');
        block.css('display', 'block');
        block.html("<strong>" + message + "</strong>");
        validation = false;
    }
    
    function sendMessage() {
        var _token = $('input[name=_token]').val();
        var name = $('#name').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var country = $('#country').val();
        var company = $('#company').val();
        var website = $('#website').val();
        var message = $('#message').val();
        var recaptcha = $('#g-recaptcha-response').val();
        
        
        $('#status').css('background', 'transparent');
        $('#status').html('');
        $('.has-error').removeClass('has-error');
        $('.help-block').html("");
        $('.help-block').css('display', 'none');
        
        $('.animsition').prepend("<div class='request overlay'></div>");
        $('.animsition').prepend("<div class='animsition-loading'></div>");
        $('.request.overlay').css('z-index', '100');
        $('.animsition-loading').css('z-index', '110');
        
        $.ajax({
            //url: window.location,
            type: 'POST',
            data: {_token:_token, name:name, email:email, subject:subject, country:country, company:company, website:website, message:message, recaptcha:recaptcha}
            
        }).done(function(data) {          
            //$('#status').css('background', 'rgba(0,0,0,0.7)');        
            $('#status').css('color', '#C5B358');
            $('#status').html(data);
            
            // RESET FORM
            $('form').find("input[type=text], textarea").val("");
            $('option').removeAttr('selected');
            $('option[value=client]').attr('selected', '');
            $('option[value=Srbija]').attr('selected', '');            
            $("label[for=company]").attr('disabled', '');
            $("#company").attr('disabled', '');
            $("label[for=website]").attr('disabled', '');
            $("#website").attr('disabled', '');
            
            $('.request.overlay').remove();
            $('.animsition-loading').remove();
        }).fail(function(msg) {
            if (msg.responseText.search("\"name\"") !== -1)
                checkError(msg, "name", 9); 
            if (msg.responseText.search("\"email\"") !== -1)
                checkError(msg, "email", 10); 
            if (msg.responseText.search("\"company\"") !== -1)
                checkError(msg, "company", 12);
            if (msg.responseText.search("\"website\"") !== -1)
                checkError(msg, "website", 12);
            if (msg.responseText.search("\"message\"") !== -1)
                checkError(msg, "message", 12);
            
            if (validation) {
                $('#status').css('color', 'red');
                //$('#status').css('background', 'rgba(0,0,0,0.7)');
                $('#status').html(msg.responseText);
            }
            
            $('.request.overlay').remove();
            $('.animsition-loading').remove();
        });
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxAHBuLOHtqOzZxc_xwdeKq0SAbzEaEVw" type="text/javascript"></script>
<script src="https://maps.gstatic.com/maps-api-v3/api/js/18/15a/main.js" type="text/javascript"></script>
<script src="{{ url("/") }}/js/map.js"></script>
@stop
