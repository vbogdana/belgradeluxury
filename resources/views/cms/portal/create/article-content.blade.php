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
    
    var i = 0, max = 0;
    
    $('#addParagraph').on('click', function() {
        $('#content-container').append("<div id='content" + i + "' class='panel-group' style='border-bottom: 1px solid #d3e0e9'></div>");
        var typeOfContent = "paragraph";
        addContent(typeOfContent);
    });
    
    $('#addImage').on('click', function() {
        $('#content-container').append("<div id='content" + i + "' class='panel-group' style='border-bottom: 1px solid #d3e0e9'></div>");
        var typeOfContent = "image";
        addContent(typeOfContent);
    });
    
    function addContent(typeOfContent) {
        $('#content' + i).append("<h4 class='text-center'>SECTION " + i + "</h4>");
        $.ajax({
            data: {typeOfContent: typeOfContent},
            type: 'GET'
        }).done(function(data) {
            $('#content' + i).append(data);
            $('#content' + i + ' form').append("<input name='position' type='hidden' value='" + i + "'>");
            i++;
        }).fail(function() {
            window.alert('AJAX ERROR: Could not render data.');
            i++;
        });       
    }
    
    function submitForm(i) {
        $form = $('#mainForm #content' + i + ' form');
        if ($form.length === 0)
            return;
        var url = $form.attr('action');
        var data = new FormData($form[0]);
        $.ajax({
            url: url,
            type: 'POST',           
            contentType: false,
            processData: false,
            data: data
        }).done(function(data) {
            if (i === max)
                window.location = $('#articles').attr('href');
            submitForm(i+1);
        }).fail(function() {
            submitForm(i);
        });
    }
    $('#submit').on('click', function(ev) {
        ev.preventDefault();
        max = i - 1;
        submitForm(0);        
    });

</script>
@stop
