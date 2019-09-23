
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

@extends('layouts.master')

<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>

@section('title-meta')
<!-- page titles and meta tags -->
<title>Online @lang('titles.inquiry') - Belgrade Luxury</title>
<meta name="description" content="{{ Lang::get('common.meta.contact') }}" />
<!-- Facebook share meta tags -->
<meta property="og:title" content="Online {{ Lang::get('titles.inquiry') }} - Belgrade Luxury" />
<meta property="og:description" content="{{ Lang::get('common.meta.contact') }}" />
@if (isset($object))
<meta property="og:image" content='{{ url("/") }}/images/services/{{ strtolower($object->name_en) }}.jpg' />   
@else
<meta property="og:image" content='{{ url("/") }}/images/backgrounds/belgradeluxury.jpg' /> 
@endif
@stop

@section('stylesheets')
@stop

@if (isset($object))
@section('language-toolbar')
@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
<li>
    <a rel="alternate" hreflang="{{ $localeCode }}" 
       href="
        <?php 
            $url = LaravelLocalization::getLocalizedURL($localeCode);
            $nameStart = strrpos($url, "/");
            $url = substr($url, 0, $nameStart + 1).str_replace(' ', '-', strtolower($object['name_'.$localeCode]));
            echo $url;
        ?>
       ">
        {{ $properties['native'] }}
    </a>
</li>
@endforeach
@stop
@endif

@section('content')
<!--    START FORM SECTION      -->
@if (isset($object))
<section id="form" class="contact-section panel fullwidth background-properties space-y" data-section-name="form-panel" style="background-image: url({{ url("/") }}/images/services/{{ strtolower($object->name_en) }}-big.jpg)">
@else
<section id="form" class="contact-section panel fullwidth background-properties space-y" data-section-name="form-panel" style="background-image: url({{ url("/") }}/images/backgrounds/belgradeluxury.jpg)">
@endif
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center">
   
            <div>
                
                {{ Form::open(['route' => 'inquiry', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'autocomplete' => 'off']) }}
                
                <input type='hidden' id='service' name='service' value='{{ $type }}' />
                @if (isset($object))
                <input type='hidden' id='object' name='object' value='{{ $object->name_en }}' />
                @endif
                
                <div class="description">                                      
                    <div class="text-uppercase">
                        <i class="hi-icon fa-globe" style="color: #C5B358"></i>
                    </div>
                    
                    <div class="tags" style="margin-bottom: 0">
                        <a class="link" href="tel:+381613180874">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            (+381) 061 3180 874
                        </a>
                        <br/>
                        SMS, WhatsApp & Viber  
                        
                        <br/>
                      
                        <a class="link" href="mailto:inquiry@belgradeluxury.rs" style="text-transform: lowercase">
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            inquiry@belgradeluxury.rs
                        </a>
                        
                    </div>
                </div>
                
                <div class="container-fluid" style="font-family: Aspergit, Raleway, sans-serif">
                    <div class="description text-center">
                        <h2 class="text-uppercase"> Online @lang('services.inquiry')</h2>
                        <p id="status" style="font-size: 1.2em"></p>           
                    </div>    
                </div>
                
                <div class="container-fluid">
                    
                    <div class="row">  
                        <div class="form-group col-sm-6">
                            <label for="phone" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.name'): *</label>

                            <div class="col-xs-8 col-sm-6">
                                <input id="name" type="text" maxlength="255" class="form-control" name="name" required>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="email" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.email'): *</label>

                            <div class="col-xs-8 col-sm-6">
                                <input id="email" type="text" maxlength="255" class="form-control" name="email" required>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>                       
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="date_start" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.date.start'): *</label>

                            <div class="col-xs-8 col-sm-6">
                            
                                <input id="date_start" type="date" name="date_start" required="" class="form-control" placeholder="dd.mm.yyyy">
                                
                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-6">
                            <label for="date_end" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.date.end'): *</label>

                            <div class="col-xs-8 col-sm-6">
                            
                                <input id="date_end" type="date" name="date_end" required="" class="form-control" placeholder="dd.mm.yyyy">
                                
                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="people" class="col-xs-4 col-sm-offset-0 col-sm-3 control-label">@lang('forms.people'): *</label>

                            <div class="col-xs-8 col-sm-9" style="padding-right: 30px">
                                <input id="people" type="number" max="50" min="1" step="1" class="form-control" name="people" required>
                                
                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>   
                    </div>

                    <div class="row">                       
                        <div class="form-group col-sm-6">
                            <label for="reason" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.reason'): *</label>

                            <div class="col-xs-8 col-sm-6">
                                <div class="checkbox-group">
                                    <input id="reason[0]" type="checkbox" maxlength="255" class="form-control" name="reason[0]" value="party">
                                    <label for="reason[0]">@lang('forms.party')</label>
                                </div>
                                <div class="checkbox-group">
                                    <input id="reason[1]" type="checkbox" maxlength="255" class="form-control" name="reason[1]" value="business">
                                    <label for="reason[1]">@lang('forms.business')</label>
                                </div>
                                <div class="checkbox-group">
                                    <input id="reason[2]" type="checkbox" maxlength="255" class="form-control" name="reason[2]" value="sightseeing">
                                    <label for="reason[2]">@lang('forms.sightseeing')</label>
                                </div>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="price" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.price'): *</label>

                            <div class="col-xs-8 col-sm-6">
                                <div class="checkbox-group">
                                    <input id="price[0]" type="radio" maxlength="255" class="form-control" name="price" value="$$$" checked>
                                    <label for="price[0]">$$$</label>
                                </div>
                                <div class="checkbox-group">
                                    <input id="price[1]" type="radio" maxlength="255" class="form-control" name="price" value="$$$$">
                                    <label for="price[1]">$$$$</label>
                                </div>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="message" class="col-xs-4 col-sm-offset-0 col-sm-3 control-label">{{ trans_choice('forms.message', 0) }}:</label>

                            <div class="col-xs-8 col-sm-9" style="padding-right: 30px">
                                <textarea id="message" maxlength="800" 
                                          rows="5" cols="70" class="form-control" 
                                          name="message"></textarea>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::submit(Lang::get('forms.send').' '.trans_choice('forms.inquiry', 1), ['class' => 'btn', 'style' => 'display: inline-block']) }}
                    </div>
                </div>
                
                {{ Form::close() }}
            </div>
        </div>
    </div>    
</section>
<!--    END FORM SECTION      -->
@stop

@section('scripts')
<script>   
    var validation = true;
    
    $(window).on('load', function() {
        $('input[type=submit]').on('click', function(ev) {
            ev.preventDefault();
            sendMessage();
        });
    });

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
        /*
        var _token = $('input[name=_token]').val();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var place = $('#place').val();
        var date = $('#date').val();
        var people = $('#people').val();
        var seating = $('#seating').val();
        var message = $('#message').val();
        */
        
        var url = $('form').attr('action');
        $form = $('form');
        var data = new FormData($form[0]);
        
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
            url: url,
            type: 'POST',
            contentType: false,
            processData: false,
            data: data
        }).done(function(data) {          
            $('#status').css('color', '#C5B358');
            $('#status').html(data);            
            // RESET FORM
            $('form').find("input[type=text], input[type=number], input[type=date], textarea").val("");
            $('form').find("input[type=checkbox]").removeAttr('checked');
            $('.request.overlay').remove();
            $('.animsition-loading').remove();
        }).fail(function(msg) {
            
            if (msg.responseText.search("\"name\"") !== -1)
                checkError(msg, "name", 9); 
            if (msg.responseText.search("\"reason\"") !== -1)
                checkError(msg, "reason", 11);
            if (msg.responseText.search("\"price\"") !== -1)
                checkError(msg, "reason", 10);
            if (msg.responseText.search("\"email\"") !== -1)
                checkError(msg, "email", 10);
            if (msg.responseText.search("\"date_start\"") !== -1)
                checkError(msg, "date_start", 15); 
            if (msg.responseText.search("\"date_end\"") !== -1)
                checkError(msg, "date_end", 13);
            if (msg.responseText.search("\"people\"") !== -1)
                checkError(msg, "people", 11);
            if (msg.responseText.search("\"message\"") !== -1)
                checkError(msg, "message", 12);
            
            i = msg.responseText.search("\"error\"");
            if (i !== -1) {                            
                var error = msg.responseText.substring(i + 9);
                var message = error.substring(0, error.indexOf("\""));
                var r = /\\u([\d\w]{4})/gi;
                message = message.replace(r, function (match, grp) {
                    return String.fromCharCode(parseInt(grp, 16)); 
                } );
                message = unescape(message);
                validation = false;
                $('#status').css('color', 'red');
                $('#status').html(message);
            }
            
            if (validation) {
                $('#status').css('color', 'red');
                $('#status').html(msg.responseText);
            }           
            $('.request.overlay').remove();
            $('.animsition-loading').remove();
        });
    }

</script>
@stop
