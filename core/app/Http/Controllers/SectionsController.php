<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionsRequest;
use App\Http\Requests\UpdateSectionsRequest;
use App\Repositories\SectionsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Sections;
use App\Models\SectionDetails;

class SectionsController extends AppBaseController
{
    /** @var  SectionsRepository */
    private $sectionsRepository;

    public function __construct(SectionsRepository $sectionsRepo)
    {
        $this->sectionsRepository = $sectionsRepo;
    }

    /**
     * Display a listing of the Sections.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sectionsRepository->pushCriteria(new RequestCriteria($request));
        $sections = $this->sectionsRepository->all();

        return view('sections.list')
            ->with('sections', $sections);
    }

    public function manage($id) {
        $section = Sections::with('section_details')->find($id);
        if(!$section) {
            return view('errors.404');
        }
        return view('sections.design')->with('section', $section);
    }

    public function manage_list($id) {
        $sections = Sections::find($id);
        $details = SectionDetails::with('localization')->groupBy('gen_id')->where('section_id', $id)->get();
        if(!$sections['type'] == 'loop') {
            return view('errors.404');
        }
        return view('sections.design')->with('details', $details)->with('sections', $sections)->with('list', true);
    }

    public function manage_edit($id, $id_detail) {
        $section = Sections::find($id);
        $detail = SectionDetails::where('gen_id', $id_detail)->get();
        
        return view('sections.design')->with('detail', $detail)->with('section', $section)->with('gen_id', $id_detail)->with('edit', true);
    }

    public function manage_update($id, $id_detail, Request $request) {
        $input = $request->all();

        $input['section_id'] = $id;
        $input['content'] = $input['content'];

        $section = Sections::find($id);
        foreach($input['content'] as $locale => $content) {
            $input['content'] = json_encode($content);
            $detail = SectionDetails::whereGenId($id_detail)->whereLang($locale)->whereSectionId($section->id)->first();
            if(!count($detail)) {
                $input['lang'] = $locale;
                $input['gen_id'] = $id_detail;
                SectionDetails::create($input);
            }else{
                $detail->content = $input['content'];
                $detail->gen_id = $id_detail;
                $detail->save();
            }
        }

        Flash::success('Section '.$section->display_name.' updated successfully.');
        return redirect()->route('sections.manage.list', $section->id);
    }

    public function manage_delete($id, $id_detail) {
        $sections = SectionDetails::where('gen_id', $id_detail);
        if (empty($sections)) {
            Flash::error('Data not found');

            return redirect(route('sections.manage.list', $id));
        }

        $sections->delete();

        Flash::success('Data deleted successfully.');

        return redirect(route('sections.manage.list', $id));
    }

    public function store_design($id, Request $request) {
        $input = $request->all();
        $input['section_id'] = $id;
        $input['content'] = $input['content'];
        $input['gen_id'] = uniqid();

        $section = Sections::find($input['section_id']);
        // dd($input['content']);
        foreach($input['content'] as $locale=>$content) {
            $section_details = SectionDetails::where('section_id',$section->id)->whereLang($locale)->first();
            $input['lang'] = $locale;
            $input['content'] = json_encode($content);

            if($section->type == 'single') {
                if(count($section_details)) {
                    SectionDetails::find($section_details->id)->fill($input)->save();
                }else{
                    SectionDetails::create($input);
                }        
            }elseif($section->type == 'loop') {
                // dd($input);
                SectionDetails::create($input);
            }
        }

        Flash::success('Section '.$section->display_name.' updated successfully.');
        if($section->type == 'single') {        
            return redirect()->route('sections.index');        
        }elseif($section->type == 'loop') {
            return redirect()->route('sections.manage.list', $section->id);
        }
    }

    public function creator(Request $request)
    {
        $this->sectionsRepository->pushCriteria(new RequestCriteria($request));
        $sections = $this->sectionsRepository->all();

        return view('sections.index')
            ->with('sections', $sections);
    }

    /**
     * Show the form for creating a new Sections.
     *
     * @return Response
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created Sections in storage.
     *
     * @param CreateSectionsRequest $request
     *
     * @return Response
     */
    public function store(CreateSectionsRequest $request)
    {
        $input = $request->all();

        $new_content = [];
        for($i=0; $i<=count($input['content']['name'])-1; $i++) {
            $new_content[$i] = [
                "name" => $input['content']['name'][$i],
                "display_name" => $input['content']['display_name'][$i],
                "type" => $input['content']['type'][$i]
            ];
        }
        $input['content'] = json_encode($new_content);

        $sections = $this->sectionsRepository->create($input);

        Flash::success('Sections saved successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Display the specified Sections.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sections = $this->sectionsRepository->findWithoutFail($id);

        if (empty($sections)) {
            Flash::error('Sections not found');

            return redirect(route('sections.index'));
        }

        return view('sections.show')->with('sections', $sections);
    }

    /**
     * Show the form for editing the specified Sections.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sections = Sections::with('section_details')->find($id);

        if (empty($sections)) {
            Flash::error('Sections not found');

            return redirect(route('sections.index'));
        }

        return view('sections.edit')->with('sections', $sections);
    }

    /**
     * Update the specified Sections in storage.
     *
     * @param  int              $id
     * @param UpdateSectionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionsRequest $request)
    {
        $sections = $this->sectionsRepository->findWithoutFail($id);

        if (empty($sections)) {
            Flash::error('Sections not found');

            return redirect(route('sections.index'));
        }

        $input = $request->all();

        $new_content = [];
        for($i=0; $i<=count($input['content']['name'])-1; $i++) {
            $new_content[$i] = [
                "name" => $input['content']['name'][$i],
                "display_name" => $input['content']['display_name'][$i],
                "type" => $input['content']['type'][$i]
            ];
        }
        $input['content'] = json_encode($new_content);

        $sections = $this->sectionsRepository->update($input, $id);

        Flash::success('Sections updated successfully.');

        return redirect(route('sections.creator'));
    }

    /**
     * Remove the specified Sections from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sections = $this->sectionsRepository->findWithoutFail($id);

        if (empty($sections)) {
            Flash::error('Sections not found');

            return redirect(route('sections.index'));
        }

        $this->sectionsRepository->delete($id);

        Flash::success('Sections deleted successfully.');

        return redirect(route('sections.index'));
    }
}
