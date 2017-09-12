<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionDetailsRequest;
use App\Http\Requests\UpdateSectionDetailsRequest;
use App\Repositories\SectionDetailsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SectionDetailsController extends AppBaseController
{
    /** @var  SectionDetailsRepository */
    private $sectionDetailsRepository;

    public function __construct(SectionDetailsRepository $sectionDetailsRepo)
    {
        $this->sectionDetailsRepository = $sectionDetailsRepo;
    }

    /**
     * Display a listing of the SectionDetails.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sectionDetailsRepository->pushCriteria(new RequestCriteria($request));
        $sectionDetails = $this->sectionDetailsRepository->all();

        return view('section_details.index')
            ->with('sectionDetails', $sectionDetails);
    }

    /**
     * Show the form for creating a new SectionDetails.
     *
     * @return Response
     */
    public function create()
    {
        return view('section_details.create');
    }

    /**
     * Store a newly created SectionDetails in storage.
     *
     * @param CreateSectionDetailsRequest $request
     *
     * @return Response
     */
    public function store(CreateSectionDetailsRequest $request)
    {
        $input = $request->all();

        $sectionDetails = $this->sectionDetailsRepository->create($input);

        Flash::success('Section Details saved successfully.');

        return redirect(route('sectionDetails.index'));
    }

    /**
     * Display the specified SectionDetails.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sectionDetails = $this->sectionDetailsRepository->findWithoutFail($id);

        if (empty($sectionDetails)) {
            Flash::error('Section Details not found');

            return redirect(route('sectionDetails.index'));
        }

        return view('section_details.show')->with('sectionDetails', $sectionDetails);
    }

    /**
     * Show the form for editing the specified SectionDetails.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sectionDetails = $this->sectionDetailsRepository->findWithoutFail($id);

        if (empty($sectionDetails)) {
            Flash::error('Section Details not found');

            return redirect(route('sectionDetails.index'));
        }

        return view('section_details.edit')->with('sectionDetails', $sectionDetails);
    }

    /**
     * Update the specified SectionDetails in storage.
     *
     * @param  int              $id
     * @param UpdateSectionDetailsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionDetailsRequest $request)
    {
        $sectionDetails = $this->sectionDetailsRepository->findWithoutFail($id);

        if (empty($sectionDetails)) {
            Flash::error('Section Details not found');

            return redirect(route('sectionDetails.index'));
        }

        $sectionDetails = $this->sectionDetailsRepository->update($request->all(), $id);

        Flash::success('Section Details updated successfully.');

        return redirect(route('sectionDetails.index'));
    }

    /**
     * Remove the specified SectionDetails from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sectionDetails = $this->sectionDetailsRepository->findWithoutFail($id);

        if (empty($sectionDetails)) {
            Flash::error('Section Details not found');

            return redirect(route('sectionDetails.index'));
        }

        $this->sectionDetailsRepository->delete($id);

        Flash::success('Section Details deleted successfully.');

        return redirect(route('sectionDetails.index'));
    }
}
