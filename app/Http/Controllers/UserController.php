<?php

namespace App\Http\Controllers;

use App\Traits\ImageStorage;
use App\User;
use App\ActivitiesOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use ImageStorage;

    /**
     * Construct
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'is_admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $activitiesOuts = ActivitiesOut::where('status', 1)->get();

        if ($request->ajax()) {
            $data = User::query();

            return DataTables::eloquent($data)
                ->addColumn('action', function ($data) {
                    return view('layouts._action', [
                        'model' => $data,
                        'edit_url' => route('user.edit', $data->id),
                        'show_url' => route('user.show', $data->id),
                        'delete_url' => route('user.destroy', $data->id),
                    ]);
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson();
        }

        // $users = User::paginate(5);
        return view('pages.user.index', compact('activitiesOuts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();

        return view('pages.user.create', compact('activitiesOuts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = $request->file('image');

        if ($photo) {
            $request['photo'] = $this->uploadImage($photo, $request->name, 'profile');
        }

        $request['password'] = Hash::make($request->password);
        $request['gender'] = $request->input('gender');
        $request['field'] = $request->input('field');

        User::create($request->all());

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();

        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user', 'activitiesOuts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();
        
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user', 'activitiesOuts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $photo = $request->file('image');

        if ($photo) {
            $request['photo'] = $this->uploadImage($photo, $request->name, 'profile', true, $user->photo);
        }

        if ($request->password) {
            $request['password'] = Hash::make($request->password);
        } else {
            $request['password'] = $user->password;
        }

        $user->update($request->all());

        return redirect()->route('user.edit', $user->id)->with('success', 'Data saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activitiesOuts = ActivitiesOut::where('status', 1)->get();
        
        $user = User::find($id);

        if ($user->photo) {
            $this->deleteImage($user->photo, 'profile');
        }

        $user->delete();

        return redirect()->route('user.index');
    }
}
