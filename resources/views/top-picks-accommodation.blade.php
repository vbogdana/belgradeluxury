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
    <i class="fa contact-apartment"></i>
</div>
<div class="side-carousel">
    <div class="carousel-holder text-center">
        <div class="top-picks-carousel">
            @foreach($accommodation as $acc)
            <div class="slide hover-effects hi-icon-effect">
                <div class="events text-uppercase">
                    <div class='date'>
                        @if($acc->hotel)
                        <div class='stars'>
                        @for($j = 1; $j <= $acc->hotel()->stars; $j++)
                        <i class="fa fa-star"></i>
                        @endfor
                        </div>
                        @else
                        <div class='icons'>
                            <a href="#" target="blank" class="fa fa-people"></a>
                            <p style='padding: 11px 0 0;'>
                                {{ $acc->apartment()->people.' '.trans_choice('common.person',$acc->apartment()->people) }} 
                            </p>
                        </div>
                        @endif
                    </div>   
                </div>
                <div class="block" style="background-image: url({{ asset('storage/images/'.$acc->image) }})">
                    <div class="hover text-uppercase"> 
                        <div class="events">
                            <div class="title">
                                <a href="{{ route("accommodation.single", [ 'accID' => $acc->accID, 'title' => str_replace(" ", "-", $acc['title_'.$locale]) ]) }}">
                                    <h5>{{ $acc['title_'.$locale] }}</h5>
                                </a>
                                &nbsp;&nbsp;@
                                <a href="http://maps.apple.com/?q={{ $acc->geoLat.','.$acc->geoLong }}" >
                                    <h5>{{ $acc['address'] }}</h5>
                                </a>
                                <br/>
                                <a class="link" href="tel:+381600154431" style="margin: 20px 0 0;">
                                    <h6><i class="fa fa-phone" aria-hidden="true"></i>
                                        (+381) 060 0154 431
                                    </h6>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="hover" style="height: 50px">
                        <a class="btn small" href='{{ route("accommodation.inquiry", [ 'accID' => $acc->accID, 'title' => str_replace(" ", "-", $acc['title_'.$locale]) ]) }}'>
                            @lang('common.quick inquiry')
                        </a>
                    </div> 
                </div>
            </div>
            @endforeach
        </div>
    </div>                  
</div>