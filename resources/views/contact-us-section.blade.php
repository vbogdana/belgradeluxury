
<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -->


<!--   START CONTACT US SECTION      -->
<section id="contact-us" class="service-contact-us-section interstitial ribbon fullwidth space-y text-center" data-section-name="contact-us-panel">            
    <img class="img-responsive" src='<?php echo url("/")?>/images/logo/logo-letters.svg' style='max-width: 130px; display: inline-block; margin-bottom: 30px'>
    <!--<img class="img-responsive" src='<?php echo url("/")?>/images/decor.svg'>-->  
    <div class="container">
        <div class="description text-center">
            <h2 class="text-uppercase"> @lang('common.luxury vip services') </h2>
            <p></p>
            <h4 class="text-uppercase">
                {{ trans_choice('common.booking', 0) }}
                @if ($inquiry)
                {{ trans_choice('common.booking', 1) }}           
                @endif
            </h4>            
            <div class='row'>                
                <div class='col-sm-4'>
                </div>
                <div class='col-sm-4'>
                    <img class="img-responsive gold-ornament" style='position: absolute; left:0' src='<?php echo url("/")?>\images\square-down.svg'>                                    
                    @if ($inquiry)
                    <a id="contact" class="btn" data-scroll href='#send-inquiry'> @lang('common.contact us') </a>                    
                    @else
                    <a id="contact" class="btn" href='{{ route("contact") }}#contact-information'> @lang('common.contact us') </a>
                    @endif
                    <img class="img-responsive gold-ornament" style='position: absolute; right:0' src='<?php echo url("/")?>\images\square-down.svg'>            
                </div>
                <div class='col-sm-4'>
                </div>
            </div>
        </div>      
    </div>   
</section>
<!--   END CONTACT US SECTION      -->