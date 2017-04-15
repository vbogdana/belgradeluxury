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
        max = i - 1;
        
        // reset errors
        $('.has-error').removeClass('has-error');
        $('.help-block').html("");
        $('.help-block').css('display', 'none');
        
        validated = true;
        $('body').append("<div class='overlay'></div>");
        validateForm(0);        
    });
    
    function validateForm(i) {
        $form = $('#mainForm #content' + i + ' form');
        if ($form.length === 0) {
            $('.overlay').remove();
            return;
        }
        var url = $form.attr('data-validate');
        var data = new FormData($form[0]);
        $.ajax({
            url: url,
            type: 'POST',           
            contentType: false,
            processData: false,
            data: data
        }).done(function() {            
            if (i === max) {                
                if (validated)
                    submitForm(0);
                $('.overlay').remove();
                return;
            }           
            validateForm(i+1);            
        }).fail(function(msg) {           
            validated = false;           
            if ($form.attr('data-type') === 'paragraph') {
                if (msg.responseText.search("\"content_en\"") !== -1)
                    checkError($form, msg, "content_en", 15); 
                if (msg.responseText.search("\"content_sr\"") !== -1)
                    checkError($form, msg, "content_sr", 15); 
            } else if ($form.attr('data-type') === 'image') {
                if (msg.responseText.search("\"caption_en\"") !== -1)
                    checkError($form, msg, "caption_en", 15); 
                if (msg.responseText.search("\"caption_sr\"") !== -1)
                    checkError($form, msg, "caption_sr", 15); 
                if (msg.responseText.search("\"credit\"") !== -1)
                    checkError($form, msg, "credit", 11);
                if (msg.responseText.search("\"image\"") !== -1)
                    checkError($form, msg, "image", 10);
            }     
            if (i === max) {
                $('.overlay').remove();
                return;  
            }
            validateForm(i+1);            
        });
    }
    
    function checkError(form, msg, field, offset) {
        var i = msg.responseText.search("\"" + field + "\"");            
        var error = msg.responseText.substring(i + offset);
        var message = error.substring(0, error.indexOf("\""));
        var r = /\\u([\d\w]{4})/gi;
        message = message.replace(r, function (match, grp) {
            return String.fromCharCode(parseInt(grp, 16)); 
        } );
        message = unescape(message);
        div = form.find('#' + field).parent().parent();
        div.addClass('has-error');
        block = div.find('.help-block');
        block.css('display', 'block');
        block.html("<strong>" + message + "</strong>");
    }
    
    function submitForm(i) {
        $form = $('#mainForm #content' + i + ' form');
        if ($form.length === 0) {
            $('.overlay').remove();
            return;
        }
        var url = $form.attr('action');
        var data = new FormData($form[0]);
        $.ajax({
            url: url,
            type: 'POST',           
            contentType: false,
            processData: false,
            data: data
        }).done(function(data) {
            if (i === max) {
                window.location = $('#articles').attr('href');
                $('.overlay').remove();
                return;
            }
            submitForm(i+1);
        }).fail(function(msg) {
            $('.overlay').remove();
            window.alert("NEPREDVIDJENA GRESKA: " + msg.responseText);
            return;
        });
    }

</script>
@stop
