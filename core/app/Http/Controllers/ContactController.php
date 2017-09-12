<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Repositories\ContactRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;
use App\Models\Contact;
use File;
use Mail;

class ContactController extends AppBaseController
{
    /** @var  ContactRepository */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
    }

    /**
     * Display a listing of the Contact.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $this->contactRepository->pushCriteria(new RequestCriteria($request));
        // $contacts = $this->contactRepository->all();
        $contacts = Contact::where('type', 'contact')->get();

        return view('contacts.index')
            ->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param CreateContactRequest $request
     *
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $input = $request->all();
        $input['details'] = json_encode(["ip" => $request->ip()]);
        if(isset($input['apply']) && $input['apply'] == true) {
            $allowed = ['doc', 'docx', 'pdf'];
            if(!in_array(strtolower($request->file('file')->getClientOriginalExtension()), $allowed)) {
                return json_encode(['success' => false, 'data' => 'File yang Anda unggah tidak diizinkan']);
            }
            $input['type'] = 'apply';
            $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
            $upload = $request->file->move(storage_path('upload'), $fileName);
            $input['message'] = json_encode(['file' => $fileName, 'position' => $input['position']]);
        }
        $contact = $this->contactRepository->create($input);
        Mail::send('emails.contact', ['contact' => $contact], function ($message) use ($contact) {
            $message->from(setting('email_alias_from'), setting('email_alias_name'));

            $message->to(setting('email_to'))->subject('contact us');
        });

        Mail::send('emails.contact2', ['contact' => $contact], function ($message) use ($contact) {
            $message->from(setting('email_alias_from'), setting('email_alias_name'));

            $message->to($contact->email)->subject('contact us');
        });

        Flash::success('Contact saved successfully.');

        if($input['ajax'] == true) {
            return json_encode(["success" => true]);
        }


        return redirect(route('contacts.index'));
    }

    /**
     * Display the specified Contact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        return view('contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified Contact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        return view('contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified Contact in storage.
     *
     * @param  int              $id
     * @param UpdateContactRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactRequest $request)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        $contact = $this->contactRepository->update($request->all(), $id);

        Flash::success('Contact updated successfully.');

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified Contact from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        $this->contactRepository->delete($id);

        Flash::success('Contact deleted successfully.');

        return redirect(route('contacts.index'));
    }


    public function apply() {
        $apply = Contact::where('type', 'apply')->get();
        return view('apply.index')->with('apply', $apply);
    }

    public function file($fileName) {
        $path = storage_path('upload/'.$fileName);
        if(!File::exists($path)) return view('errors.404');

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
