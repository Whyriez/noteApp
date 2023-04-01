<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function add_note()
    {
        return view('dashboard.addNote');
    }

    public function save_note(Request $request)
    {
        $title = $request->title;
        $note = $request->note;

        $request->validate(
            [
                'title' => 'required',
                'note' => 'required',
            ],
            [
                'title.required' => 'Title Required!',
                'note.required' => 'Note Required',
            ]
        );

        $notes = new Note;
        $notes->username = Auth::user()->username;
        $notes->title = $title;
        $notes->note = $note;
        $notes->save();

        // $request->session()->flash('msg', "Data Berhasil Disimpan");
        return back()->with('success', 'Note Successfully Created');
        return redirect('/addnote');
    }

    public function list_note()
    {
        $data = Note::where('username', Auth::user()->username)->get();

        return view('dashboard.listNote', compact(['data']))->with([
            'user' => Auth::user(),
        ]);
    }

    public function update_note(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        $note = $request->note;

        $notes = Note::find($id);
        $notes->title = $title;
        $notes->note = $note;
        $notes->save();
        return back()->with('success', 'Note Successfully Updated');
        return redirect('/listnote');
    }

    public function delete_note($id)
    {

        $notes = Note::where('id', $id)->delete();
        return back()->with('success', 'Note Successfully Deleted');
        return redirect('/listnote');
    }
}
