<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

<?php
$locale = LaravelLocalization::getCurrentLocale();
?>

<div class="side-tab text-center">
    <i class="fa contact-calendar"></i>
</div>
<div class="side-carousel">
    <div class="carousel-holder text-center">
        <div class="top-picks-carousel">
            @foreach($events as $event)
            <div class="slide hover-effects hi-icon-effect">
                <div class="events text-uppercase">
                    <div class='date'>
                        <div class="day-of-week">
                            {{ substr($event->getDay(), 0, 3) }}
                        </div>
                        <div class="day">
                            {{ $event->getDate().trans_choice('common.ordinal', $event->getDate()) }}
                        </div>
                        <div class="month">
                            {{ substr($event->getMonth(), 0, 3) }} 
                        </div>                                                                       
                    </div>   
                </div>
                <div class="block" style="background-image: url({{ asset('storage/images/'.$event->article->image) }})">
                    <div class="hover text-uppercase"> 
                        <div class="events">
                            <div class="title">
                                <a href="{{ route("events.reservation", ['placeID' => $event->placeID, 'title' => str_replace(" ", "-", $event->place['title_'.$locale]), 'evID' => $event->evID]) }}">
                                    <h5>{{ $event->article['title_'.$locale] }}</h5>
                                </a>
                                &nbsp;&nbsp;@
                                <a href="{{ route("places.place", [ 'placeID' => $event->place->placeID, 'title' => str_replace(" ", "-", $event->place['title_'.$locale]) ]) }}" >
                                    <h5>{{ $event->place['title_'.$locale] }}</h5>
                                </a>
                                <br/>
                                <a class="link" href="tel:+381644519017" style="margin: 20px 0 0;">
                                    <h6><i class="fa fa-phone" aria-hidden="true"></i>
                                        (+381) 064 4519 017
                                    </h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="hover" style="height: 50px">
                        <a class="btn small" href='{{ route("events.reservation", ['placeID' => $event->placeID, 'title' => str_replace(" ", "-", $event->place['title_'.$locale]), 'evID' => $event->evID]) }}'>
                            @lang('services.reserve') online
                        </a>
                    </div> 
                </div>
            </div>
            @endforeach
        </div>
    </div>                  
</div>