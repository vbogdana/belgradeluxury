
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

@extends('layouts.master')

@section('title-meta')
<!-- page titles and meta tags -->
<title>Belgrade Luxury - Online @lang('titles.reservation') </title>

<meta name="description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta name="keywords" content="belgrade stag, belgrade bachelor, belgrade bachelor party, belgrade nightlife, serbian clubs, serbian nightlife, serbian bachelor, serbian stag, belgrade bars, belgrade restaurants, belgrade vip, party concierge, belgrade accommodation, lounge bars"/>
<meta property="fb:pages" content="belgradeluxury">
<meta property="og:locale" content="en_US">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ route("places.reservation", ['placeID' => $place->placeID]) }}">
<meta property="og:title" content="Belgrade Luxury - Online {{ Lang::get('titles.reservation') }}" />
<meta property="og:description" content="Belgrade Luxury offers services for VIP party travelers without hidden costs in Belgrade, Serbia. Five stars apartments, luxury vehicles, VIP entrance and tables in clubs and restaurants, free premium drinks, etc... Full service from arrival to departure." />
<meta property="og:site_name" content="Belgrade Luxury">        
<meta property="og:image" content='{{ asset('storage/images/'.$place->image) }}' />   
@stop

@section('stylesheets')
@stop

<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>
@section('content')
<!--    START FORM SECTION      -->
<section id="form" class="contact-section panel fullwidth background-properties space-y" data-section-name="form-panel" style="background-image: url({{ asset('storage/images/'.$place->image) }})">
    <div class="overlay"></div>
    <div class="hero-holder">
        <div class="hero-inner text-center hi-icon-effect">
   
            <div>
                {{ Form::open(['route' => 'reservation', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'autocomplete' => 'off']) }}
                
                <div class="container-fluid" style="font-family: Aspergit, Raleway, sans-serif">
                    <div class="description text-center">
                        <h2 class="text-uppercase"> Online @lang('services.reservation')</h2>
                        <p id="status" style="font-size: 1.2em"></p>           
                    </div>    
                </div>
                
                <div class="container-fluid">
                    
                    <div class="row">                       
                        <div class="form-group col-sm-6">
                            <label for="name" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.name'): *</label>

                            <div class="col-xs-8 col-sm-6">
                                <input id="name" type="text" maxlength="255" class="form-control" name="name" required>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="phone" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.phone'): *</label>

                            <div class="col-xs-8 col-sm-6">
                                <input id="phone" type="text" maxlength="255" class="form-control" name="phone" required>

                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="place" class="col-xs-4 col-sm-offset-0 col-sm-3 control-label">@lang('forms.place'):</label>

                            <div class="col-xs-8 col-sm-9" style="padding-right: 30px">
                                <select id="place" class="form-control text-capitalize" name="place">
                                    <!--
                                    @foreach($places as $p)                                    
                                    <option value="$p->placeID"
                                            <?php
                                            /*
                                        if (isset($place)) {
                                            if ($place->placeID === $p->placeID) {
                                                echo "selected";
                                            }
                                        }
                                             * 
                                             */
                                        ?>
                                    >
                                         $p['title_'.$locale] 
                                    </option>
                                    @endforeach
                                    -->
                                    <option value="{{ $place->placeID }}">{{ $place['title_'.$locale] }}</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="date" class="col-xs-4 col-sm-offset-0 col-sm-3 control-label">@lang('forms.date'):</label>

                            <div class="col-xs-8 col-sm-9" style="padding-right: 30px">
                                <select id="date" class="form-control text-capitalize" name="date">
                                    @foreach($place->getEvents() as $event)
                                    
                                    <option value="{{ $event->evID }}"
                                            <?php
                                        if (isset($evID)) {
                                            if ($evID === $event->evID) {
                                                echo "selected";
                                            }
                                        }
                                        ?>
                                    >
                                        {{ $event->getDay().' '.$event->getDate().trans_choice('common.ordinal', $event->getDate()).' '.$event->getMonth().'  -  ' }} {{ $event['title_'.$locale] }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="people" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.people'): *</label>

                            <div class="col-xs-8 col-sm-6">
                                <input id="people" type="number" max="50" min="1" step="1" class="form-control" name="people" required>
                                
                                <span class="help-block" style="display: none"></span>
                            </div>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="seating" class="col-xs-4 col-sm-offset-0 col-sm-6 control-label">@lang('forms.seating'):</label>

                            <div class="col-xs-8 col-sm-6">
                                <select id="seating" class="form-control" name="seating">
                                    @foreach($place->seatings as $seating)
                                    <option value="{{ $seating->seatID }}">{{ $seating->seating['type_'.$locale] }}</option>
                                    @endforeach
                                </select>
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
                            {{ Form::submit(Lang::get('forms.send').' '.trans_choice('forms.reservation', 1), ['class' => 'btn', 'style' => 'display: inline-block']) }}
                        </div>
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
        var phone = $('#phone').val();
        var place = $('#place').val();
        var date = $('#date').val();
        var people = $('#people').val();
        var seating = $('#seating').val();
        var message = $('#message').val();
        
        var url = $('form').attr('action');
        
        
        $('#status').css('background', 'transparent');
        $('#status').html('');
        $('.has-error').removeClass('has-error');
        $('.help-block').html("");
        $('.help-block').css('display', 'none');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: {_token:_token, name:name, phone:phone, place:place, date:date, people:people, seating:seating, message:message}
            
        }).done(function(data) {          
            //$('#status').css('background', 'rgba(0,0,0,0.7)');        
            $('#status').css('color', '#CEAB4D');
            $('#status').html(data);
            
            // RESET FORM
            $('form').find("input[type=text], input[type=number], textarea").val("");
            $('option').removeAttr('selected');
            $('option:first-child').attr('selected', '');
        }).fail(function(msg) {
            if (msg.responseText.search("\"name\"") !== -1)
                checkError(msg, "name", 9); 
            if (msg.responseText.search("\"phone\"") !== -1)
                checkError(msg, "phone", 10); 
            if (msg.responseText.search("\"people\"") !== -1)
                checkError(msg, "people", 11);
            if (msg.responseText.search("\"message\"") !== -1)
                checkError(msg, "message", 12);
            
            if (validation) {
                $('#status').css('color', 'red');
                //$('#status').css('background', 'rgba(0,0,0,0.7)');
                $('#status').html(msg.responseText);
            }
        });
    }

</script>
@stop
