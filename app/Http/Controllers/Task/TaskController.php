<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // جلب المهام مرتبة من الأحدث إلى الأقدم
        $tasks = task::orderBy('created_at', 'desc')->get();
        return view('task.index2', compact('tasks'));
    }
    public function show()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        $days = ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
        return view('task.show', compact('tasks', 'days'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'day' => 'required|in:الأحد,الإثنين,الثلاثاء,الأربعاء,الخميس,الجمعة,السبت',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'title.required' => 'يجب إدخال عنوان المهمة.',
            'start_time.required' => 'يجب إدخال وقت البدء.',
            'end_time.required' => 'يجب إدخال وقت الانتهاء.',
            'end_time.after' => 'يجب أن يكون وقت الانتهاء بعد وقت البدء.',
        ]);

        task::create([
            'title' => $request->title,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return redirect()->back()->with('success', 'تمت إضافة المهمة بنجاح!');
        // return redirect()->route('task.show') // أو أي route تريد التوجيه إليه
        //     ->with('success', 'تمت إضافة المهمة بنجاح!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'title' => 'required|string|max:255',
            // 'day' => 'required|in:الأحد,الإثنين,الثلاثاء,الأربعاء,الخميس,الجمعة,السبت',
            // 'start_time' => 'required|date_format:H:i',
            // 'end_time' => 'required|date_format:H:i|after:start_time',
            // 'status' => 'required|in:غير منجز,منجز',
        ]);

        $task = task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
        ]);
        return back()->with('success', 'تم تحديث المهمة بنجاح');
        // return redirect()->route('task.show')->with('success', 'تم تحديث المهمة بنجاح');
    }



    public function delete($id)
    {
        $task = task::findOrFail($id);
        $task->delete();

        return redirect()->route('task.show')->with('success', 'تم حذف المهمة بنجاح');
    }
    public function toggleStatus($id)
    {
        $task = Task::findOrFail($id);
        $newStatus = $task->status == 'غير منجز' ? 'منجز' : 'غير منجز';
        $task->update(['status' => $newStatus]);

        return response()->json([
            'success' => true,
            'new_status' => $newStatus,
            'status_text' => $newStatus == 'منجز' ? 'تم الإنجاز' : 'غير منجز',
            'btn_class' => $newStatus == 'منجز' ? 'btn-success' : 'btn-warning'
        ]);
    }
}
