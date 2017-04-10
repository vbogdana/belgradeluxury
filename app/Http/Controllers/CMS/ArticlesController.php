<?php

namespace App\Http\Controllers\CMS;

use App\Category;
use App\Article;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
    
   
}
