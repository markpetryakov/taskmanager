<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tasklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class Tasklistcontroller extends Controller
{
    function createList() {
        $tasklists = Tasklist::all();
        $owner = 0;
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
        
        return view('createList', compact('tasklists', 'owner'));
    }
    function createListPost (Request $request) {
        $request->validate([
            'owner' => 'required',
            'title' => 'required',
        ]);
        
        if ($request) {
            $tasklist = new Tasklist();
        $tasklist->owner = $request->owner;
        $tasklist->title = $request->title;
        $tasklist->save();
        
            return redirect()->intended(route('lists'));
        } 
        return redirect(route('create'))->with('error', 'Please fill out all fields.');
    }
    public function lists () {
        $owner = 0;
        $tasks = Task::all();
        $tasklists = Tasklist::orderBy('created_at')->get();
        
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
        
        if (request('search')) {
            $tasklists = Tasklist::where('title', 'like', "%" .request('search') . "%")->get();
        }
        return view('lists', compact('tasklists', 'owner', 'tasks'));
    }

    public function editList ($id) {
        $tasklists = Tasklist::all();
        $tasklist = Tasklist::find($id);
        $owner = 0;
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
            return view('editList', compact('owner', 'tasklist', 'tasklists'));
    } 
    function editListPost(Request $request, $id) {
        $tasklist = TaskList::findOrFail($id);
        $request->validate([
            'owner' => 'required',
            'title' => 'required',
            
        ]);
               
        if ($request) {
        $tasklist->owner = $request->owner;
        $tasklist->title = $request->title;
        $tasklist->save();
        
            return redirect()->intended(route('lists'));
        } 
        return redirect(route('editList'))->with('error', 'Please fill out all fields.');
    }
    public function destroyList($id) {
        $tasklists = Tasklist::all();
        $tasklist = TaskList::find($id);
        $owner = 0;
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
        $listId = $tasklist->id;
        $task = Task::where('listId', $listId)->first();
        
        return view('deleteList', compact('task', 'listId', 'tasklists', 'owner', 'tasklist'));
    }
    public function destroyListpost($id) {
        $tasklists = Tasklist::all();
        $owner = 0;
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
        $tasklist = TaskList::find($id);
        $listId = $tasklist->id;
        $task = Task::where('listId', $listId)->first();
        if ($task != null) {
            
            return redirect(route('destroyList', compact('id','task', 'listId', 'tasklists', 'owner', 'tasklist')))->with('error', 'List is not empty');    
                   
        }else {
            $tasklist->delete();
            $task = null; 
        }
        return redirect(route('lists'));
    }

}
