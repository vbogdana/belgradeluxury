<!-- /*
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  - */
-->

@extends('layouts.master')

@section('content')
<section class='fullwidth interstition space-y'>
    <div class="container-fluid">
        <div class="description text-center">
            <h2 class="text-uppercase"> @lang('common.error') </h2>
            <p>
                <?php
                    $var = trans_choice('common.'.$var, 0);
                    echo trans_choice('common.notfound', 0, ['var' => $var]);
                ?>
            </p>
        </div>    
    </div>
</section>
@stop
