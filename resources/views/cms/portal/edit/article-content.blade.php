<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -
-->

@extends('layouts.cms')

@section('content')
<style>    
    .overlay {
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 999;
        top: 0;
        background: rgba(0,0,0,0.6);
    }
    
    .panel-group {
        cursor: move;
        padding: 20px;
        border: 1px solid #d3e0e9;
        box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.1);
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route("cms.portal") }}">Portal ></a>&nbsp;
                    <a id="articles" href="{{ route("cms.portal.articles", ['category' => $article->category->name_en]) }}">{{ $article->category->name_en }} ></a>&nbsp
                    {{ $article->title_en }} >&nbsp;
                    Reorder Article Content
                </div>
                
                <div class="panel-body">                    
                    <div class='container-fluid'>
                            <?php 
                                $images = $article->images->toArray();
                                $paragraphs = $article->paragraphs->toArray();
                                $i = $j = $k = 0;
                                $n = sizeof($images);
                                $m = sizeof($paragraphs);
                            ?>
                    
                            @for($i = $j = $k = 0; $i < $n || $j < $m; $k++)
                            @if($k % 3 === 0 && $k !== 0)
                            </div>
                            @endif
                            @if($k % 3 === 0 || $k === 0)
                            <div class='row'>
                            @endif
                            <div class='col-sm-4'>
                                <div id="content{{ $k }}" 
                                     class='panel-group' 
                                     draggable="true"
                                     ondragstart="dragStart(event,{{ $k }})"
                                     ondragover="allowDrop(event)"
                                     ondrop="drop(event,{{ $k }})">
                                    <h4 class='text-center'>SECTION {{ $k }}</h4>
                                    
                                    <div id="{{ $k }}" class='content'>
                                        @if($j >= $m)
                                        <img src='{{ asset('storage/images/'.$images[$i]['image']) }}' class='img-responsive'>
                                        <?php $i++; ?>
                                        @elseif($i >= $n)
                                        <p>
                                            {{ $paragraphs[$j]['content_en'] }}
                                        </p>
                                        <?php $j++; ?>
                                        @elseif ($images[$i]['position'] < $paragraphs[$j]['position'])
                                        <img src='{{ asset('storage/images/'.$images[$i]['image']) }}' class='img-responsive'>
                                        <?php $i++; ?>
                                        @elseif ($images[$i]['position'] > $paragraphs[$j]['position'])
                                        <p>
                                            {{ $paragraphs[$j]['content_en'] }}
                                        </p>
                                        <?php $j++; ?>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endfor
                            
                        @if(($k === 1) || ((($k - 1) > 0) && ((($k - 1) % 3) !== 0)))
                        </div>
                        @endif
                    </div> 
                
                    <div class="panel-heading text-center">
                        <div class="form-group ">
                            <h3 class="text-center">WHEN YOU ARE FINISHED</h3>
                            {{ Form::open(['route' => ['cms.portal.articles.reorder', $category->name_en, $article->artID], 'method' => 'post']) }}                           
                            <button id='submit' type="button" class="btn btn-success">
                                SAVE ARTICLE
                            </button>
                            <a id="back" class="btn btn-danger" style="margin-left: 15px" href="{{ route("cms.portal.articles", ['category' => $article->category->name_en]) }}">Cancel</a>                                                
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    
    var i = 0, max = 0;
    var validated = true;
    
    function dragStart(ev, i) {
        ev.dataTransfer.setData("id", i);
    }
    
    function drop(ev, i) {
        ev.preventDefault();
        var droppedOn = i;
        var dragged = parseInt(ev.dataTransfer.getData("id"));
        var tmp, form;
        
        if (dragged === droppedOn)
            return;
        
        tmp = $('#content' + dragged + ' .content').detach();
        if (dragged > droppedOn) {
            for (var k = dragged - 1; k >= droppedOn; k--) {               
                form = $('#content' + k + ' .content').detach();
                $('#content' + (k+1)).append(form);
            }
        } else if (dragged < droppedOn) {
            for (var k = dragged + 1; k <= droppedOn; k++) {               
                form = $('#content' + k + '  .content').detach();
                $('#content' + (k-1)).append(form);
            }
        }
        $('#content' + droppedOn).append(tmp);        
    }
    
    function allowDrop(ev) {
        ev.preventDefault();
    }
    
    // Submit na CREATE article    
    $('#submit').on('click', function(ev) {
        ev.preventDefault();
        $('body').append("<div class='overlay'></div>");

        var array = [];
        var _token = $('input[name=_token]').val();
        var j = 0;
        while (1) {           
            var section = $('#content' + j);
            if (section.length === 0) {
                 break;
            }
            var oldId = section.find('.content').attr("id");
            array[oldId + ""] = j;
            j++;
        }
        if (j === 0) {
            $('.overlay').remove();
            window.location = $('#back').attr('href');
            return;
        }
       
        $.ajax({
            //url: url,
            type: 'POST',
            data: {_token:_token, positions:array}
        }).done(function(data) {   
            $('.overlay').remove();
            window.location = $('#back').attr('href');
        }).fail(function(msg) {
            $('.overlay').remove();
            window.alert("NEPREDVIDJENA GRESKA: " + msg.responseText);
            return;
        });
        
    });

</script>
@stop
