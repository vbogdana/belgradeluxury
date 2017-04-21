<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -
-->

@extends('layouts.cms')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="alert alert-success text-center text-uppercase">
                    <h3>Successfully {{ $method }}!</h3>
                    @if (isset($parameter))
                    <a href='{{ route($route, ['service' => $parameter]) }}' class='btn btn-success'>
                        GO BACK TO VIEW ALL
                    </a>
                    @else
                    <a href='{{ route($route) }}' class='btn btn-success'>
                        GO BACK TO VIEW ALL
                    </a>
                    @endif
                </div>

                <div class="panel-body">
                    @foreach($object->toArray() as $key => $value)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        @if(!is_array($value))
                        <div class="col-xs-6">
                            {{ $key }}
                        </div>
                        
                        <div class="col-xs-6">
                            @if ($key === 'image' || $key === 'cardFront' || $key === 'cardBack' || $key === 'symbol')
                            @if($value !== null)
                            <img class="img-responsive" src="{{ asset('storage/images/'.$value) }}">
                            @else
                            No image
                            @endif
                            @else
                            <strong>{{ $value }}</strong>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                    
                    <?php 
                    $subobject = null;
                    if(method_exists($object, 'apartment')) {
                        $subobject = $object->apartment();
                    } else if(method_exists($object, 'hotel')) {
                        $subobject = $object->hotel();
                    }                       
                    ?>
                    
                    @if($subobject !== null)
                    @foreach($subobject->toArray() as $key => $value)
                    <div class="row text-center" style="padding-bottom: 15px; border-bottom: 1px solid rgba(37, 81, 119, 0.2); margin-bottom: 15px;">
                        <div class="col-xs-6">
                            {{ $key }}
                        </div>
                        <div class="col-xs-6">
                            <strong>{{ $value }}</strong>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                
                <div class='panel-heading text-center'>
                    @if (isset($parameter))
                    <a href='{{ route($route, ['service' => $parameter]) }}' class='btn btn-success'>
                        GO BACK TO VIEW ALL
                    </a>
                    @else
                    <a href='{{ route($route) }}' class='btn btn-success'>
                        GO BACK TO VIEW ALL
                    </a>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

