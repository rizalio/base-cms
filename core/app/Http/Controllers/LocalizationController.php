<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocalizationRequest;
use App\Http\Requests\UpdateLocalizationRequest;
use App\Repositories\LocalizationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class LocalizationController extends AppBaseController
{
    /** @var  LocalizationRepository */
    private $localizationRepository;

    public function __construct(LocalizationRepository $localizationRepo)
    {
        $this->localizationRepository = $localizationRepo;
    }

    /**
     * Display a listing of the Localization.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->localizationRepository->pushCriteria(new RequestCriteria($request));
        $localizations = $this->localizationRepository->all();

        return view('backend.localizations.index')
            ->with('localizations', $localizations);
    }

    /**
     * Show the form for creating a new Localization.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.localizations.create');
    }

    /**
     * Store a newly created Localization in storage.
     *
     * @param CreateLocalizationRequest $request
     *
     * @return Response
     */
    public function store(CreateLocalizationRequest $request)
    {
        $input = $request->all();

        $localization = $this->localizationRepository->create($input);

        Flash::success('Localization saved successfully.');

        return redirect(route('localizations.index'));
    }

    /**
     * Display the specified Localization.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $localization = $this->localizationRepository->findWithoutFail($id);

        if (empty($localization)) {
            Flash::error('Localization not found');

            return redirect(route('localizations.index'));
        }

        return view('backend.localizations.show')->with('localization', $localization);
    }

    /**
     * Show the form for editing the specified Localization.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $localization = $this->localizationRepository->findWithoutFail($id);

        if (empty($localization)) {
            Flash::error('Localization not found');

            return redirect(route('localizations.index'));
        }

        return view('backend.localizations.edit')->with('localization', $localization);
    }

    /**
     * Update the specified Localization in storage.
     *
     * @param  int              $id
     * @param UpdateLocalizationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLocalizationRequest $request)
    {
        $localization = $this->localizationRepository->findWithoutFail($id);

        if (empty($localization)) {
            Flash::error('Localization not found');

            return redirect(route('localizations.index'));
        }

        $localization = $this->localizationRepository->update($request->all(), $id);

        Flash::success('Localization updated successfully.');

        return redirect(route('localizations.index'));
    }

    /**
     * Remove the specified Localization from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $localization = $this->localizationRepository->findWithoutFail($id);

        if (empty($localization)) {
            Flash::error('Localization not found');

            return redirect(route('localizations.index'));
        }

        $this->localizationRepository->delete($id);

        Flash::success('Localization deleted successfully.');

        return redirect(route('localizations.index'));
    }

    public function set_default(Request $request) {
        if(!$request->lang_id) {
            return abort(404);
        }

        $lang_id = $request->lang_id;
        $lang   =  DB::table('lang')->where('deleted_at', NULL)->where('id', $lang_id)->first();
        if($lang) {
            DB::table('lang')->update(['default_lang' => false]);
            DB::table('lang')->where('id', $lang_id)->update(['default_lang' => true]);
            Flash::success('Language successfully set to default!');
            return redirect()->back();
        }

        Flash::error('Localization not found!');
        return redirect()->back();
    }
}
