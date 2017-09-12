<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Repositories\PostsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Categories;
use App\Models\Posts;

class PostsController extends AppBaseController
{
    /** @var  PostsRepository */
    private $postsRepository;

    public function __construct(PostsRepository $postsRepo)
    {
        $this->postsRepository = $postsRepo;
    }

    /**
     * Display a listing of the Posts.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->postsRepository->pushCriteria(new RequestCriteria($request));
        $posts = Posts::with('category')->groupBy('gen_id')->get();

        return view('posts.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Posts.
     *
     * @return Response
     */
    public function create()
    {
        $cat = Categories::get();
        $childs = [];
        foreach($cat as $item) {
            $childs[$item->parent_id][] = $item;
        }

        foreach($cat as $item) {
            if(isset($childs[$item->id])) {
                $item->childs = $childs[$item->id];
            }
        }

        $categories_all = [];
        if(@$childs[0]) {
            $categories_all = $childs[0];
        }
        return view('posts.create')->with('categories', $categories_all);
    }

    /**
     * Store a newly created Posts in storage.
     *
     * @param CreatePostsRequest $request
     *
     * @return Response
     */
    public function store(CreatePostsRequest $request)
    {
        $input = $request->all();
        $input['gen_id'] = uniqid();

        foreach($request->content as $locale=>$content) {
            $content = (object) $content;
            $input['title'] = $content->title;
            $input['description'] = $content->description;
            $input['lang'] = $locale;
            $posts = $this->postsRepository->create($input);        
        }


        Flash::success('Posts saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Posts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            Flash::error('Posts not found');

            return redirect(route('posts.index'));
        }

        return view('posts.show')->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified Posts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $posts = Posts::whereGenId($id)->get();

        if (empty($posts)) {
            Flash::error('Posts not found');

            return redirect(route('posts.index'));
        }

        $cat = Categories::get();
        $childs = [];
        foreach($cat as $item) {
            $childs[$item->parent_id][] = $item;
        }

        foreach($cat as $item) {
            if(isset($childs[$item->id])) {
                $item->childs = $childs[$item->id];
            }
        }

        $categories_all = [];
        if(@$childs[0]) {
            $categories_all = $childs[0];
        }

        $values = [];
        foreach($posts as $post) {
            $values[$post->lang] = ['title' => $post->title, 'description' => $post->description];
        }

        $posts = $posts[0];

        return view('posts.edit')->with('posts', $posts)->with('categories', $categories_all)->with('edit', true)->with('values', $values);
    }

    /**
     * Update the specified Posts in storage.
     *
     * @param  int              $id
     * @param UpdatePostsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostsRequest $request)
    {
        $input = $request->all();
        // dd($input);

        // if (empty($posts)) {
        //     Flash::error('Posts not found');

        //     return redirect(route('posts.index'));
        // }

        foreach($request->content as $locale=>$content) {
            $post = Posts::whereGenId($id)->whereLang($locale)->first();
            $content = (object) $content;
            $post->title = $content->title;
            $post->description = $content->description;
            $post->lang = $locale;
            $post->thumbnail = $input['thumbnail'];
            $post->category_id = $input['category_id'];
            $post->status = $input['status'];
            $post->gen_id = $id;
            $post->save();
        }

        Flash::success('Posts updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Posts from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            Flash::error('Posts not found');

            return redirect(route('posts.index'));
        }

        $this->postsRepository->delete($id);

        Flash::success('Posts deleted successfully.');

        return redirect(route('posts.index'));
    }
}
