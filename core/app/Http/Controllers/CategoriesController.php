<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Repositories\CategoriesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Categories;
use Auth;

class CategoriesController extends AppBaseController
{
    /** @var  CategoriesRepository */
    private $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepo)
    {
        $this->middleware('auth');
        $this->categoriesRepository = $categoriesRepo;
    }

    /**
     * Display a listing of the Categories.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->categoriesRepository->pushCriteria(new RequestCriteria($request));
        $categories = $this->categoriesRepository->all();

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

        return view('categories.index')
            ->with('categories', $categories)
            ->with('parent_cat', $categories_all);
    }

    /**
     * Show the form for creating a new Categories.
     *
     * @return Response
     */
    public function create()
    {

        return view('categories.create');
    }

    /**
     * Store a newly created Categories in storage.
     *
     * @param CreateCategoriesRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoriesRequest $request)
    {
        $input = $request->all();

        $categories = $this->categoriesRepository->create($input);

        Flash::success('Categories saved successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Categories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categories = $this->categoriesRepository->findWithoutFail($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified Categories.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $categories = $this->categoriesRepository->findWithoutFail($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
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

        return view('categories.index')->with('categories_edit', $categories)->with('parent_cat', $childs[0]);
    }

    /**
     * Update the specified Categories in storage.
     *
     * @param  int              $id
     * @param UpdateCategoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoriesRequest $request)
    {
        $categories = $this->categoriesRepository->findWithoutFail($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        $categories = $this->categoriesRepository->update($request->all(), $id);

        Flash::success('Categories updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Categories from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {

        $categories = $this->categoriesRepository->findWithoutFail($id);

        if (empty($categories)) {
            Flash::error('Categories not found');

            return redirect(route('categories.index'));
        }

        $this->categoriesRepository->delete($id);

        Flash::success('Categories deleted successfully.');

        return redirect(route('categories.index'));
    }
}
