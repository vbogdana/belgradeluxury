
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->

<?php 
    $locale = LaravelLocalization::getCurrentLocale();
    $i = 0;
?>

@foreach($apartments as $apartment)
<div class="col-sm-12 col-md-6 hover-effects hi-icon-effect">
    <figure>
        <div class="img-holder">
            @if ($apartment->image != null)
            <img src="{{ asset('storage/images/'.$apartment->image) }}" alt="">
            @else
            No image
            @endif
        </div>
        <figcaption class="text-center">                               
            <div class="header">
                <h2 class="text-uppercase">{{ $apartment['title_'.$locale] }}</h2>                                                               
            </div>
            <div class="content">
                <a href="#"  class="hi-icon fa-map-marker"></a>
                <p style='padding: 4px 0 0;'>
                    {{ $apartment['address'] }}
                </p> 
                <a href="#" class="hi-icon fa-people"></a>                               
                <h2></h2>
                <a class="btn" style="margin: 0; padding: 5px 10px; font-size: 0.8em;">
                    @lang('common.more')
                </a>
            </div>
        </figcaption>
    </figure>
</div>
@endforeach
{{ $apartments->links() }}