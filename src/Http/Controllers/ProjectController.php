<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Illuminate\Http\Request; //querybuilder used in sort
use Illuminate\Support\Facades\DB;
use Session;
use TheRealJanJanssens\Pakka\Models\Project;
use TheRealJanJanssens\Pakka\Models\Task;
use TheRealJanJanssens\Pakka\Models\TaskComment;
use TheRealJanJanssens\Pakka\Models\TaskGroup;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();

        Session::put('module_id', 0);
        Session::put('module_name', 'projects');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('pakka::admin.projects.index', compact('projects'));
    }

    public function detail($id)
    {
        $project = Project::findOrFail($id);
        $tasks = Task::getTasks($id);

        return view('pakka::admin.projects.detail', compact('project', 'tasks'));
    }

    public function taskDetail($id)
    {
        $task = Task::getTask($id);

        return view('pakka::admin.projects.taskdetail', compact('task'));
    }

    public function storeTaskGroup(Request $request)
    {
        $post = $request->all();
        $result = TaskGroup::create(['project_id' => $post['project_id'], 'name' => $post['name'], 'color' => $post['color']]);
        $result = json_encode($result);

        return $result;
    }

    public function updateTaskGroup(Request $request)
    {
        $post = $request->all();
        $group = TaskGroup::findOrFail($post['id']);

        foreach ($post as $key => $value) {
            $group->$key = $value;
        }

        $group->save();
    }

    public function orderTaskGroups(Request $request)
    {
        $post = $request->all();
        $post['data'] = json_decode($post['data'], true);

        $query = "";
        foreach ($post['data'] as $data) {
            $query .= "UPDATE task_groups SET position = ".htmlspecialchars($data['position'])." WHERE id =".htmlspecialchars($data['id']).";";
        }

        DB::unprepared($query);

        return $query;
    }

    public function storeTask(Request $request)
    {
        $post = $request->all();
        $result = Task::create(['project_id' => $post['project_id'], 'group_id' => $post['group_id'], 'name' => $post['name'], 'created_by' => $post['created_by']]);
        $result = json_encode($result);

        return $result;
    }

    public function updateTask(Request $request)
    {
        $post = $request->all();
        $task = Task::findOrFail($post['id']);

        foreach ($post as $key => $value) {
            $task->$key = htmlspecialchars($value);
        }

        $task->save();
    }

    public function orderTask(Request $request)
    {
        $post = $request->all();
        $post['data'] = json_decode($post['data'], true);

        $query = "";
        foreach ($post['data'] as $data) {
            $query .= "UPDATE tasks SET position = ".htmlspecialchars($data['position']).", group_id = ".htmlspecialchars($data['group_id']).", updated_at = '".date('Y-m-d H:i:s')."' WHERE id =".htmlspecialchars($data['id']).";";
        }

        DB::unprepared($query); //execute query Unprepared.. only use this in controlpanel

        //return $post['data'];
    }

    public function storeComment(Request $request)
    {
        $post = $request->all();
        $result = TaskComment::create(['task_id' => $post['task_id'], 'user_id' => $post['user_id'], 'text' => $post['text']]);
        $result = json_encode($result);

        return $result;
    }
}
