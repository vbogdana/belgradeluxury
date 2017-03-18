<!--   START LIST SECTION      -->
<section id="list" class="list-section pagination-grid panel fullwidth space-y" data-section-name="list-panel">            
    
    <div class="text-center">	
        <ul  class="nav nav-pills text-uppercase hi-icon-effect"> 
            <?php 
                $numOfTypes = sizeOf($types);
                $col = 3;
                
                if ($numOfTypes < 4) {
                    if ($numOfTypes < 3) {
                        if ($numOfTypes < 2) {
                        $col = 12;
                        } else {
                            $col = 6;
                        }
                    } else {
                        $col = 4;
                    }
                }
                $first = "active";
            ?>
            @foreach ($types as $type)
            <li class="{{ $first }} col-xs-12 col-sm-{{ $col }}">
                <a href="#{{ str_replace(" ", "_", $type) }}" data-toggle="tab">
                    <i class="hi-icon"></i>
                    <br/>
                    <span>{{ trans_choice('services.'.strtolower($type), 1) }}</span>
                </a>
            </li>
            <?php $first = "" ?>
            @endforeach
        </ul>
        
        <div class="tab-content clearfix">
            <?php
                $first = "active";
            ?>
            @foreach ($types as $type)
            <div class="tab-pane {{ $first }} text-center" id="{{ str_replace(" ", "_", $type) }}">
                @if ($service === 'nightlife' || $service === 'gastronomy')
                @include('services.list-places', ['places' => $list[$type]])
                @elseif ($service === 'accommodation')
                @include('services.list-accommodation', ['accommodation' => $list[$type]])
                @elseif ($service === 'vehicles')
                @include('services.list-vehicles', ['vehicles' => $list[$type]])
                @endif
            </div>
            <?php $first = "" ?>
            @endforeach
        </div>       
    </div>     
</section>
<!--   END LIST SECTION      -->
