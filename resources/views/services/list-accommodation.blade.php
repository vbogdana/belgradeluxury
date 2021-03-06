
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

<?php 
    $locale = LaravelLocalization::getCurrentLocale();
?>

<div class='col-xs-12'>
{{ $accommodation->links() }}
</div>
@foreach($accommodation as $acc)
<div class="col-xs-12 col-md-6 hover-effects hi-icon-effect">
    <figure>
        <div class="img-holder">
            @if ($acc->image != null)
            <img src="{{ asset('storage/images/'.$acc->image) }}" alt="{{ $acc['title_'.$locale] }}">
            @else
            No image
            @endif
        </div>
        <figcaption class="text-center">                               
            <div class="header">
                <h2 class="text-uppercase">{{ $acc['title_'.$locale] }}</h2>                                                               
            </div>
            <div class="content">
                <div class='icons'>
                    <a href="{{ $acc->geoLat.','.$acc->geoLong }}" target="blank" class="hi-icon fa-map-marker"></a>
                    <p style='padding: 4px 0 0;'>
                        {{ $acc['address'] }}
                    </p>
                </div>
                @if($acc->apartment)
                <div class='icons'>
                    <a href="" target="blank" class="hi-icon fa-people"></a>
                    <p style='padding: 4px 0 0;'>
                        {{ $acc->apartment()->people.' '.trans_choice('common.person',$acc->apartment()->people) }} 
                    </p>
                </div>
                @endif
                <br/>
                <a href="{{ route("accommodation.single", [ 'accID' => $acc->accID, 'title' => str_replace(" ", "-", $acc['title_'.$locale]) ]) }}" class="btn small">
                    @lang('common.details')
                </a>
                <a href="{{ route("accommodation.inquiry", [ 'accID' => $acc->accID, 'title' => str_replace(" ", "-", $acc['title_'.$locale]) ]) }}" class="btn small">
                    @lang('common.quick inquiry')
                </a>
            </div>
            <a class="link" href="tel:+381613180874" style="margin: 20px 0 0;">
                <i class="fa fa-phone" aria-hidden="true"></i>
                (+381) 061 3180 874
            </a>
        </figcaption>
    </figure>
</div>
@endforeach
<div class='col-xs-12'>
{{ $accommodation->links() }}
</div>