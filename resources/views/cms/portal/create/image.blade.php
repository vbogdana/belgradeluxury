{{ Form::open(['route' => ['cms.portal.articles.create.image', $article->category->name_en, $article->artID], 'method' => 'post', 'enctype' => "multipart/form-data"]) }}

<div class='form-group'>
    <label for='image' class='col-md-4 control-label'>Image</label>
    
    <div class='col-md-6'>
        <input type='file' id='image' class='form-control' name='image'>
        <span class='help-block' style='display: none'></span>
    </div>
</div>

<div class='form-group'>
    <label for='caption_en' class='col-md-4 control-label'>Caption (eng)</label>
    
    <div class='col-md-6'>
        <input type='text' id='caption_en' maxlength='255' class='form-control' name='caption_en'>
        <span class='help-block' style='display: none'></span>
    </div>
</div>

<div class='form-group'>
    <label for='caption_sr' class='col-md-4 control-label'>Caption (ser)</label>
    
    <div class='col-md-6'>
        <input type='text' id='caption_sr' maxlength='255' class='form-control' name='caption_sr'>
        <span class='help-block' style='display: none'></span>
    </div>
</div>

<div class='form-group'>
    <label for='credit' class='col-md-4 control-label'>Credit</label>
    
    <div class='col-md-6'>
        <input type='text' id='credit' maxlength='255' class='form-control' name='credit'>
        <span class='help-block' style='display: none'></span>
    </div>
</div>

{{ Form::close() }}
