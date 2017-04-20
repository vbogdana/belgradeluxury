<?php

namespace App\Http\Controllers\CMS;

use App\Category;
use App\Article;
use App\ArticleParagraph;
use App\ArticleImage;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Response;
use View;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    } 
    
    protected function checkCategory($category) {
        $c = Category::where('name_en', $category)->get();
        if ($c->isEmpty()) {
            return view('cms.error', ['message' => 'Category not found!']);
        }
        
        return $c->first();
    }
    
    /**
     * Loads a view with a list of articles from the category.
     *
     * @param $category name of the Category
     * @return view
     */    
    public function loadArticles($category) {
        $c = $this->checkCategory($category);
        
        $articles = Article::where('ctgID', $c->ctgID)->orderBy('updated_at', 'desc')->paginate(10);
        return view('/cms/portal/articles', ['articles' => $articles, 'category' => $c]);
    }
    
    /**
     * Loads a view with a form to create a new article.
     *
     * @param $category name of the Category
     * @return view
     */
    function loadCreateArticle($category) { 
        $c = $this->checkCategory($category);
        
        $categories = Category::all(['ctgID', 'name_en'])->sortBy('name_en');
        return view('/cms/portal/create/article', ['categories' => $categories, 'category' => $c]);
    }
    
    /**
     * Loads a view with a form to edit the data of an existing article.
     *
     * @param $category name of the Category
     * @param $artID primary key of Article
     * @return view
     */
    function loadEditArticle($category, $artID) {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        $categories = Category::all(['ctgID', 'name_en']);
        return view('/cms/portal/create/article', ['article' => $article, 'categories' => $categories, 'category' => $c]);
    }
    
    /**
     * Loads a view with a form to edit the data of an existing article.
     *
     * @param $category name of the Category
     * @param $artID primary key of Article
     * @return view
     */
    function loadEditMainImage($category, $artID) {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        return view('/cms/portal/edit/main-image', ['article' => $article, 'category' => $c]);
    }
    
     /**
     * Handle a request for loading a view for creating a content of the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of the Article
     * @return \Illuminate\Http\Response or a View
     */
    function loadCreateContent(Request $request, $category, $artID) { 
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        if (\Request::ajax()) {
            $type = $request->input('typeOfContent');
            if ($type === 'paragraph') {
                return Response::json(View::make('cms.portal.create.paragraph-content', ['article' => $article])->render()); 
            } else if ($type === 'image') {
                return Response::json(View::make('cms.portal.create.image-content', ['article' => $article])->render());
            }         
        } else {
            $maxPar = $maxImg = $max = -1;
            if ($article->paragraphs !== null) {
                $maxPar = $article->paragraphs->max('position');
            }
            if ($article->images !== null) {
                $maxImg = $article->images->max('position');
            }
            if ($maxImg !== -1 || $maxPar !== -1) {
                $max = ($maxPar > $maxImg ? $maxPar : $maxImg) + 1;  
            } else {
                $max = 0;
            }
            return view('/cms/portal/create/article-content', ['article' => $article, 'max' => $max]);
        }
    }
    
    /**
     * Loads a view to reorder content sections of the article.
     *
     * @param $category name of the Category
     * @param $artID primary key of Article
     * @return view
     */
    function loadReorder($category, $artID) {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        return view('/cms/portal/edit/reorder-article-content', ['article' => $article, 'category' => $c]);
    }
    
    /**
     * Loads a view to edit content sections of the article.
     *
     * @param $category name of the Category
     * @param $artID primary key of Article
     * @return view
     */
    function loadEditSections($category, $artID) {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        return view('/cms/portal/edit/article-content', ['article' => $article, 'category' => $c]);
    }
    
    /**
     * Loads a view to edit content sections of the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of Article
     * @return view
     */
    function loadEditSection(Request $request, $category, $artID) {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        $this->validate($request, [
            'type' => 'required',
            'id' => 'required|integer'
        ]);
        
        $data = $request->all();       
        $id = $data['id'];
        $type = $data['type'];     
        
        switch ($type) {
            case "paragraph": 
                $section = ArticleParagraph::find($id);
                break;
            case "image": 
                $section = ArticleImage::find($id);
                break;
        }
        
        if ($section == null) {
            return view('cms.error', ['message' => 'Section not found!']);
        }
               
        return view('/cms/portal/edit/'.$type.'-content', ['article' => $article, 'section' => $section]);
    }
    
    /**
     * Get a validator for an incoming request for creating a new article 
     * or editing an existing one for the application.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [  
            'title_en' => 'required|max:255',
            'title_sr' => 'required|max:255',
            'description_en' => 'required|max:255',
            'description_sr' => 'required|max:255',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png'     
        ]);
    }
    
    /**
     * Handle a request for creating a new article for the application.
     *
     * @param $category name of the Category
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createArticle($category, Request $request)
    {
        $c = $this->checkCategory($category);
        
        $this->validator($request->all())->validate();

        $article = $this->create($request->all());
        
        return redirect('/cms/portal/'.$c->name_en.'/articles');
    }
    
    /**
     * Handle a request for editing an existing article for the application.
     *
     * @param $category name of the Category
     * @param  \Illuminate\Http\Request  $request
     * @param   $artID primary key of Article
     * @return \Illuminate\Http\Response
     */
    public function editArticle($category, Request $request, $artID)
    {
        $c = $this->checkCategory($category);
        
        $this->validator($request->all())->validate();
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }

        $article = $this->edit($request->all(), $article);
        
        return redirect('/cms/portal/'.$c->name_en.'/articles');
    }   
    
    /**
     * Handle an edit image request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param   $artID primary key of Article
     * @return \Illuminate\Http\Response
     */
    public function editMainImage(Request $request, $category, $artID)
    {
        $c = $this->checkCategory($category);        
        
        $this->validate($request, [
                'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png,JPG'
            ]
        );
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }

        $this->editImage($request->all(), $article);
        
        return redirect('/cms/portal/'.$c->name_en.'/articles');
    }
   
    /**
     * Create a new article instance.
     *
     * @param  array  $data
     * @return Article
     */
    protected function create(array $data)
    {
        $user = Auth::user();
        $article = new Article($data);
        $article->userID = $user->userID;
        $article->ctgID = $data['category'];
        $article->save();

        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('articles/'.$article->artID, 'images');
            $article->image = $path;
            $article->save();
        }
                
        return $article;
    }
    
    /**
     * Edit an existing article instance.
     *
     * @param  array  $data
     * @param $article instance of Article
     * @return Article
     */
    protected function edit(array $data, $article)
    {   
        $user = Auth::user();
        
        $article->title_en = $data['title_en'];
        $article->title_sr = $data['title_sr'];
        $article->description_en = $data['description_en'];
        $article->description_sr = $data['description_sr'];
        $article->updated_at = Carbon::now();
        $article->userID = $user->userID;
        $article->ctgID = $data['category'];
        
        $article->save();
                
        return $article;
    }
  
    /**
     * Handle a delete an article request for the application.
     *
     * @param $category name of the Category
     * @param  artID article primary key
     * @return \Illuminate\Http\Response
     */
    public function delete($category, $artID)
    {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        if ($article->event !== null) {
            return redirect('/cms/portal/'.$c->name_en.'/articles?message=fail');
        }
        
        // delete main photo
        if ($article->image != null) {
            Storage::delete('public/images/'.$article->image);
        }
       
        // delete all article content
        // 
        // delete directory
        Storage::deleteDirectory('public/images/articles/'.$artID);

        // delete entry in article table
        Article::destroy($artID);
        
        return redirect('/cms/portal/'.$c->name_en.'/articles');
    }
    
     /**
     * Handle a request for validating form info when creating a new paragraph for the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of the Article
     * @return \Illuminate\Http\Response or a View
     */
    public function validateParagraph(Request $request) {
        $this->validate($request, [
            'content_en' => 'required|max:510',
            'content_sr' => 'required|max:510',            
            'position' => 'integer'
        ]);
    }
    
     /**
     * Handle a request for creating a new paragraph for the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of the Article
     * @return \Illuminate\Http\Response or a View
     */
    public function createParagraph(Request $request, $category, $artID) {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        /*
        $this->validate($request, [
            'content_en' => 'required|max:510',
            'content_sr' => 'required|max:510',            
            'position' => 'integer'
        ]);
         * 
         */
               
        $data = $request->all();
        $paragraph = new ArticleParagraph($data);
        $paragraph->artID = $artID;
        $paragraph->save();
        
        $article->updated_at = Carbon::now();
        $article->save();
        
        return 'success';
        
    }
    
     /**
     * Handle a request for validating form info when creating a new image for the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of the Article
     * @return \Illuminate\Http\Response or a View
     */
    public function validateImage(Request $request) {
        $this->validate($request, [
            'caption_en' => 'max:255',
            'caption_sr' => 'max:255',
            'credit' => 'max:255',
            'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png', 
            'position' => 'integer'
        ]);
    }
    
     /**
     * Handle a request for creating a new image for the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of the Article
     * @return \Illuminate\Http\Response or a View
     */
    public function createImage(Request $request, $category, $artID) {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        /*
        $this->validate($request, [
            'caption_en' => 'max:255',
            'caption_sr' => 'max:255',
            'credit' => 'max:255',
            'image' => 'required|max:15000|mimes:jpeg,jpg,bmp,png', 
            'position' => 'integer'
        ]);
         * 
         */
               
        $data = $request->all();
        $image = new ArticleImage($data);
        $image->artID = $artID;
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('articles/'.$article->artID, 'images');
            $image->image = $path;
        }
        $image->save();
        
        $article->updated_at = Carbon::now();
        $article->save();
        
        return 'success';
        
    }
    
    /**
     * Edits main article image.
     *
     * @param  array  $data
     * @param  $article instance of Article
     */
    protected function editImage(array $data, $article)
    {
        // delete existing main photo
        if ($article->image != null) {
            Storage::delete('public/images/'.$article->image);
        }
        
        if (array_key_exists('image', $data)) {
            $path = $data['image']->store('articles/'.$article->artID, 'images');
            $article->image = $path;
            $article->updated_at = Carbon::now();
            $article->save();
        }
    }
    
     /**
     * Handle a request for creating a new image for the article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of the Article
     * @return \Illuminate\Http\Response
     */
    protected function deleteMainImage($category, $artID)
    {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        // delete existing main photo
        if ($article->image != null) {
            Storage::delete('public/images/'.$article->image);
            $article->image = null;
            $article->updated_at = Carbon::now();
            $article->save(); 
        }
        
        return redirect('/cms/portal/'.$c->name_en.'/articles');      
    }
    
   
    /**
     * Handle a reorder sections of the article post request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param   $artID primary key of Article
     * @return \Illuminate\Http\Response
     */
    public function reorder(Request $request, $category, $artID)
    {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        $data = $request->all();
        $positions = $data['positions'];
        
        foreach($article->paragraphs as $paragraph) {
            $newPos = $positions[$paragraph->position];
            $paragraph->position = $newPos;
            $paragraph->save();
        }
        foreach($article->images as $image) {
            $newPos = $positions[$image->position];
            $image->position = $newPos;
            $image->save();
        }
        
        $article->updated_at = Carbon::now();
        $article->save();
        return;
        /*
        foreach($positions as $key => $value) {
        echo "Key: ".$key." Value: ".$value.", ";
        }
        */
    }
    
    /**
     * Handle a request for editing a paragraph inside an article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of Article
     * @return \Illuminate\Http\Response
     */
    public function editParagraphSection(Request $request, $category, $artID)
    {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        $this->validate($request, [
            'content_en' => 'required|max:510',
            'content_sr' => 'required|max:510'
        ]);
               
        $data = $request->all();
        $parID = $data['parID'];
        $paragraph = ArticleParagraph::find($parID);
        if ($paragraph == null) {
            return view('cms.error', ['message' => 'Paragraph not found!']);
        }
        
        $paragraph->content_en = $data['content_en'];
        $paragraph->content_sr = $data['content_sr'];
        $paragraph->save();
        
        $article->updated_at = Carbon::now();
        $article->save();
        
        // go back to edit sections
        return redirect('/cms/portal/'.$c->name_en.'/articles/'.$article->artID.'/edit/sections');
    }
    
    /**
     * Handle a request for editing an image inside an article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of Article
     * @return \Illuminate\Http\Response
     */
    public function editImageSection(Request $request, $category, $artID)
    {
               
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
  
        $this->validate($request, [
            'caption_en' => 'max:255',
            'caption_sr' => 'max:255',
            'credit' => 'max:255',
            'image' => 'max:15000|mimes:jpeg,jpg,bmp,png'
        ]);
               
        $data = $request->all();
        $imgID = $data['imgID'];
        $image = ArticleImage::find($imgID);
        if ($image == null) {
            return view('cms.error', ['message' => 'Image not found!']);
        }

        $image->caption_en = $data['caption_en'];
        $image->caption_sr = $data['caption_sr'];
        $image->credit = $data['credit'];
        if (array_key_exists('image', $data)) {
            Storage::delete('public/images/'.$image->image);
            $path = $data['image']->store('articles/'.$article->artID, 'images');
            $image->image = $path;
        }
        $image->save();
        
        $article->updated_at = Carbon::now();
        $article->save();
        
        // go back to edit sections
        return redirect('/cms/portal/'.$c->name_en.'/articles/'.$article->artID.'/edit/sections');
    }
    
    /**
     * Handle a request for deleting a section inside an article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $category name of the Category
     * @param $artID primary key of Article
     * @return \Illuminate\Http\Response
     */
    public function deleteSection(Request $request, $category, $artID)
    {
        $c = $this->checkCategory($category);
        
        $article = Article::find($artID);
        if ($article == null) {
            return view('cms.error', ['message' => 'Article not found!']);
        }
        
        $this->validate($request, [
            'type' => 'required',
            'id' => 'required|integer'
        ]);
        
        $data = $request->all();       
        $id = $data['id'];
        $type = $data['type'];     
        
        switch ($type) {
            case "paragraph": 
                $section = ArticleParagraph::find($id);
                break;
            case "image": 
                $section = ArticleImage::find($id);
                break;
        }
        
        if ($section == null) {
            return view('cms.error', ['message' => 'Section not found!']);
        }
        
        $position = $section->position;
        
        // delete the section
        // article paragraph links cascade
        switch ($type) {
            case "paragraph": 
                ArticleParagraph::destroy($id); 
                break;
            case "image": 
                Storage::delete('public/images/'.$section->image);
                ArticleImage::destroy($id);
        }
 
        // update positions
        DB::table('article_paragraphs')->where('position', '>', $position)->decrement('position');
        DB::table('article_images')->where('position', '>', $position)->decrement('position');
        
        $article->updated_at = Carbon::now();
        $article->save();
        
        // go back to edit sections
        return redirect('/cms/portal/'.$c->name_en.'/articles/'.$article->artID.'/edit/sections');
        
     }
}
