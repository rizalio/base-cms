<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSettingsRequest;
use App\Http\Requests\UpdateSettingsRequest;
use App\Repositories\SettingsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Settings;
use DB;

class SettingsController extends AppBaseController
{
    /** @var  SettingsRepository */
    private $settingsRepository;

    public function __construct(SettingsRepository $settingsRepo)
    {
        $this->settingsRepository = $settingsRepo;
    }

    /**
     * Display a listing of the Settings.
     *
     * @param Request $request
     * @return Response
     */
    public function index() {
        $settings = Settings::all();
        $groups = Settings::groupBy('setting_group')->orderBy('id', 'asc')->get();
        return view('settings.list')->with('settings', $settings)->with('groups', $groups);
    }

    public function creator(Request $request)
    {
        $this->settingsRepository->pushCriteria(new RequestCriteria($request));
        $settings = $this->settingsRepository->all();

        return view('settings.index')
            ->with('settings', $settings);
    }

    public function changes(Request $request) {
        $input = $request->all();
        foreach($input['content'] as $key => $value) {
            $setting = Settings::where('name', $key)->update(['value'=>$value]);
        }

        Flash::success('Settings saved successfully');
        return redirect()->route('settings.index');
    }

    /**
     * Show the form for creating a new Settings.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created Settings in storage.
     *
     * @param CreateSettingsRequest $request
     *
     * @return Response
     */
    public function store(CreateSettingsRequest $request)
    {
        $input = $request->all();
        $input['details'] = json_encode($input['details']);
        $input['setting_group'] = strtolower($input['setting_group']);
        $settings = $this->settingsRepository->create($input);

        Flash::success('Settings saved successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Display the specified Settings.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $settings = $this->settingsRepository->findWithoutFail($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        return view('settings.show')->with('settings', $settings);
    }

    /**
     * Show the form for editing the specified Settings.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $settings = $this->settingsRepository->findWithoutFail($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        return view('settings.edit')->with('settings', $settings);
    }

    /**
     * Update the specified Settings in storage.
     *
     * @param  int              $id
     * @param UpdateSettingsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSettingsRequest $request)
    {
        $settings = $this->settingsRepository->findWithoutFail($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        $settings = $this->settingsRepository->update($request->all(), $id);

        Flash::success('Settings updated successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified Settings from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $settings = $this->settingsRepository->findWithoutFail($id);

        if (empty($settings)) {
            Flash::error('Settings not found');

            return redirect(route('settings.index'));
        }

        $this->settingsRepository->delete($id);

        Flash::success('Settings deleted successfully.');

        return redirect(route('settings.index'));
    }
}
