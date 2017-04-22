<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->
<?php
$i = 0;
$locale = LaravelLocalization::getCurrentLocale();
?>

@foreach($texts as $text)
    @if($i % 3 === 0 && $i !== 0)
    </div>
    @endif
    @if($i % 3 === 0 || $i === 0)
    <img class="gold-decor" src='<?php echo url("/")?>\images\decor.svg'>
    <div class='row'>
    @endif
    
    <div class="col-sm-4">
        <img class="img-responsive" src="{{ asset('storage/images/'.$text->image) }}">
        <div class='content'>
            <h6 class="text-uppercase animated fadeInDown">{{ $text['subtitle1_'.$locale] }}</h6>
            <h4 class="text-uppercase animated fadeIn">{{ $text['title_'.$locale] }}</h4>
            <h6 class="text-uppercase animated fadeInUp">{{ $text['subtitle2_'.$locale] }}</h6>
            <p class='text-justify'>
                {{ $text['content_'.$locale] }}
            </p>
            <a id="inquiry" class="btn" href="{{ route("contact") }}#contact-us">@lang('common.send an inquiry')</a>                   
        </div>
    </div>
    <?php $i++; ?>
@endforeach

@if(($i === 1) || ((($i - 1) > 0) && ((($i - 1) % 3) !== 0)))
</div>
@endif