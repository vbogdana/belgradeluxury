<!--
  -
  - * © Belgrade Luxury 2017
  - * All rights reserved
  -
  -
-->

@extends('layouts.cms')

@section('content')

@include('cms.instructions.links-paragraphs')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" style="border: 1px solid orange">
                LINKS AND PARAGRAPHS CAN ONLY BE USED IN THE <b>CONTENT FIELDS OF PARAGRAPH SECTIONS</b>!!!
            </div>
        </div>
    </div>
</div>

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
        margin: 60px 40px;
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
                    Create Article Content
                </div>
                
                <div class="panel-body">
                    <div id='mainForm' class="form-horizontal">

                        <div id='content-container'>
                           
                        </div>
                        
                        <div class='panel-heading' style='background: #c5d9e4; padding: 30px 10px'>                   
                            <div class="text-center">
                                <input type="button" id='addParagraph'
                                       class='btn btn-primary'
                                       value='Add paragraph'/>  

                                <input type="button" id='addImage'
                                       class='btn btn-primary' style='margin-left: 15px' 
                                       value='Add image'/> 
                            </div>
                        </div>
       
                        <div class="panel-heading text-center">
                            <div class="form-group ">
                                <h3 class="text-center">WHEN YOU ARE FINISHED</h3>
                                <button id='submit' type="button" class="btn btn-success">
                                    CREATE ARTICLE
                                </button>
                                <a class="btn btn-danger" style="margin-left: 15px" href="{{ route("cms.portal.articles", ['category' => $article->category->name_en]) }}">Cancel</a>                                                
                            </div>
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
    
    var i = <?php echo $max; ?>, 
        max = <?php echo $max; ?>,
        min = <?php echo $max; ?>;
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
        
        tmp = $('#content' + dragged + ' form').detach();
        if (dragged > droppedOn) {
            for (var k = dragged - 1; k >= droppedOn; k--) {               
                form = $('#content' + k + ' form').detach();
                $('#content' + (k+1)).append(form);
            }
        } else if (dragged < droppedOn) {
            for (var k = dragged + 1; k <= droppedOn; k++) {               
                form = $('#content' + k + ' form').detach();
                $('#content' + (k-1)).append(form);
            }
        }
        $('#content' + droppedOn).append(tmp);        
    }
    
    function allowDrop(ev) {
        ev.preventDefault();
    }
    
    $('#addParagraph').on('click', function() {
        $('#content-container').append("<div id='content" + i + "' class='panel-group' style='border-bottom: 1px solid #d3e0e9' draggable='true' ondragstart='dragStart(event," + i + ")' ondrop='drop(event," + i + ")' ondragover='allowDrop(event)'></div>");
        var typeOfContent = "paragraph";
        addContent(typeOfContent);
    });
    
    $('#addImage').on('click', function() {
        $('#content-container').append("<div id='content" + i + "' class='panel-group' style='border-bottom: 1px solid #d3e0e9' draggable='true' ondragstart='dragStart(event," + i + ")' ondrop='drop(event," + i + ")' ondragover='allowDrop(event)'></div>");
        var typeOfContent = "image";
        addContent(typeOfContent);
    });
    
    function addContent(typeOfContent) {
        $('body').append("<div class='overlay'></div>");
        $('#content' + i).append("<div class='row' style='margin-bottom: 30px'></div>");
        $('#content' + i + ' .row').append("<h4 class='col-xs-10 text-center'>SECTION " + i + "</h4>"); 
        $('#content' + i + ' .row').append("<a class='remove-section col-xs-2 btn btn-danger' onclick='removeSection(" + i + ")'>Remove section</a>");
        $.ajax({
            data: {typeOfContent: typeOfContent},
            type: 'GET'
        }).done(function(data) {
            $('#content' + i).append(data);
            $('#content' + i + ' form').append("<input name='position' type='hidden' value='" + i + "'>");
            i++;
            $('.overlay').remove();
        }).fail(function() {
            window.alert('AJAX ERROR: Could not render data.');
            i++;
            $('.overlay').remove();
        });       
    }
    
    function removeSection(s) {
        $('body').append("<div class='overlay'></div>");
        $('#content' + s).remove();
        j = s + 1;
        while(1) {
            var section = $('#content' + j);
            if (section.length === 0) {
                i--;
                $('.overlay').remove();
                return;
            }
            section.attr("id", "content" + (j-1));
            section.attr("ondragstart", "dragStart(event," + (j-1) + ")");
            section.attr("ondrop", "drop(event," + (j-1) + ")");
            section.find("h4").html("SECTION " + (j-1));
            section.find('.remove-section').attr('onclick', "removeSection(" + (j-1) + ")");
            section.find('input[name=position]').attr('value', (j-1));
            j++;
        }
        i--;
        $('.overlay').remove();
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
        validateForm(min);        
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
                    submitForm(min);
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
