{{ Form::open(['route' => ['cms.portal.articles.create.paragraph', $article->category->name_en, $article->artID], 
               'method' => 'post', 
               'data-validate' => route("cms.portal.articles.validate.paragraph"),
               'data-type' => 'paragraph']) }}

<div class='form-group'>
    <label for='content_en' class='col-md-4 control-label'>Content (eng)</label>
    
    <div class='col-md-6'>
        <textarea id='content_en' maxlength='510' rows='5' cols='70' class='form-control' name='content_en'></textarea>
        <span class='help-block' style='display: none'></span>
    </div>
</div>

<div class='form-group'>
    <label for='content_sr' class='col-md-4 control-label'>Content (ser)</label>
    
    <div class='col-md-6'>
        <textarea id='content_sr' maxlength='510' rows='5' cols='70' class='form-control' name='content_sr'></textarea>
        <span class='help-block' style='display: none'></span>
    </div>
</div>

{{ Form::close() }}
