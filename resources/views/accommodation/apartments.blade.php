
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
<div class="col-sm-12 col-md-6 hover-effects hi-icon-effect">
    <figure>
        <div class="img-holder">
            @if ($acc->image != null)
            <img src="{{ asset('storage/images/'.$acc->image) }}" alt="">
            @else
            No image
            @endif
        </div>
        <figcaption class="text-center">                               
            <div class="header">
                <h2 class="text-uppercase">{{ $acc['title_'.$locale] }}</h2>                                                               
            </div>
            <div class="content">
                <a href="#"  class="hi-icon fa-map-marker"></a>
                <p style='padding: 4px 0 0;'>
                    {{ $acc['address'] }}
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
<div class='col-xs-12'>
{{ $accommodation->links() }}
</div>