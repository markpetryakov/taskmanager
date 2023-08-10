<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tasklist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class TaskController extends Controller
{
    function create($id) {
        $tasklists = Tasklist::all();
        $tasklist = Tasklist::find($id);
        $owner = 0;
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
        
        $statuses = [
            [
                'label' => 'ToDo',
                'value' => 'ToDo'
            ],
            [
                'label' => 'Done',
                'value' => 'Done'
            ]
            ];
            $priorities = [
                [
                    'label' => 'High',
                    'value' => 'High'
                ],
                [
                    'label' => 'Medium',
                    'value' => 'Medium'
                ],
                [
                    'label' => 'Low',
                    'value' => 'Low'
                ]
                ];
        return view('create', compact('statuses', 'priorities', 'tasklist', 'tasklists', 'owner'));
    }
    function createPost(Request $request) {
        $request->validate([
            'owner' => 'required',
            'listId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'dueDate' => 'required'
        ]);
        
        
        if ($request) {
            $task = new Task();
        $task->owner = $request->owner;
        $task->listId = $request->listId;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->dueDate = $request->dueDate;
        $task->save();
        
            return redirect()->intended(route('list', $task->listId));
        } 
        return redirect(route('create'))->with('error', 'Please fill out all fields.');
    }
    public function edit (int $id) {
        $tasklists = Tasklist::all();
        $task = Task::findOrFail($id);
        $tasklist = Tasklist::find($task->listId);
        $owner = 0;
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
        $statuses = [
            [
                'label' => 'ToDo',
                'value' => 'ToDo'
            ],
            [
                'label' => 'Done',
                'value' => 'Done'
            ]
            ];
        $priorities = [
            [
                'label' => 'High',
                'value' => 'High'
            ],
            [
                'label' => 'Medium',
                'value' => 'Medium'
            ],
            [
                'label' => 'Low',
                'value' => 'Low'
            ]
            ];
        return view('edit', compact('task', 'statuses', 'priorities', 'tasklist', 'tasklists', 'owner'));
    }

    function editPost(Request $request, $id) {
        $task = Task::findOrFail($id);
        $request->validate([
            'owner' => 'required',
            'listId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'dueDate' => 'required'
        ]);
        
        
        if ($request) {
            
        $task->owner = $request->owner;
        $task->listId = $request->listId;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->dueDate = $request->dueDate;
        $task->save();
        
            return redirect()->intended(route('list', $task->listId));
        } 
        return redirect(route('edit'))->with('error', 'Please fill out all fields.');
    }
    public function home ($id) {
        $tasklists = Tasklist::all();
        $tasklist = Tasklist::find($id);
        $owner = 0;
        $today = Carbon::now()->addDays(-1)->format('Y-m-d');
        $statuses = [
            [
                'label' => 'ToDo',
                'value' => 'ToDo'
            ],
            [
                'label' => 'Done',
                'value' => 'Done'
            ]
            ];
            $priorities = [
                [
                    'label' => 'High',
                    'value' => 'High'
                ],
                [
                    'label' => 'Medium',
                    'value' => 'Medium'
                ],
                [
                    'label' => 'Low',
                    'value' => 'Low'
                ]
                ];
        $tasks = Task::orderBy('dueDate')->get();
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
        
        if (request('search')) {
            $tasks = Task::where('title', 'like', "%" .request('search') . "%")->get();
        }
        return view('home', compact('tasks', 'owner', 'today', 'tasklist', 'tasklists', 'statuses', 'priorities'));
    }
    public function homeSort (Request $request) {
        $id = $request->id;
        $sort = $request->sort;
        $tasklists = Tasklist::all();
        $tasklist = Tasklist::find($id);

        $owner = 0;
        $today = Carbon::now()->addDays(-1)->format('Y-m-d');
        if ($sort == 'ToDo') {
            $tasks = Task::where('status', 'like', "ToDo")->get();
        }elseif($sort == 'Done') {
            $tasks = Task::where('status', 'like', "Done")->get();
        }elseif($sort == 'High') {
            $tasks = Task::where('priority', 'like', "High")->get();
        }elseif($sort == 'Medium') {
            $tasks = Task::where('priority', 'like', "Medium")->get();
        }elseif($sort == 'Low') {
            $tasks = Task::where('priority', 'like', "Low")->get();
        }

        if ($sort == 'status') {
        $tasks = Task::orderBy('status')->get();
        } elseif ($sort == 'date') {
            $tasks = Task::orderBy('dueDate')->get();
        } elseif ($sort == 'priority') {
            $tasks = Task::orderBy('priority')->get();
            }
        if (Auth::user()) {
            $owner = Auth::user()->id;
            }
        
        if (request('search')) {
            $tasks = Task::where('title', 'like', "%" .request('search') . "%")->get();
        }
        $statuses = [
            [
                'label' => 'ToDo',
                'value' => 'ToDo'
            ],
            [
                'label' => 'Done',
                'value' => 'Done'
            ]
            ];
        $priorities = [
            [
                'label' => 'High',
                'value' => 'High'
            ],
            [
                'label' => 'Medium',
                'value' => 'Medium'
            ],
            [
                'label' => 'Low',
                'value' => 'Low'
            ]
            ];
        return view('home', compact('tasks', 'owner', 'today', 'tasklist', 'tasklists', 'statuses', 'priorities'));
    }
    
    public function destroy($id) {
        $task = Task::find($id);
        $task->delete();

        return redirect(route('list', $task->listId));
    }





}
