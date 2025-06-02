<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // جلب المهام مرتبة من الأحدث إلى الأقدم
        $tasks = home::orderBy('created_at', 'desc')->get();
        return view('home.index', compact('tasks'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'day' => 'required|in:الأحد,الإثنين,الثلاثاء,الأربعاء,الخميس,الجمعة,السبت',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        home::create([
            'title' => $request->title,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('home.index')->with('success', 'تم إضافة المهمة بنجاح');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'day' => 'required|in:الأحد,الإثنين,الثلاثاء,الأربعاء,الخميس,الجمعة,السبت',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $task = home::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('home.index')->with('success', 'تم تعديل المهمة بنجاح');
    }
    public function delete($id)
    {
        $task = home::findOrFail($id);
        $task->delete();

        return redirect()->route('home.index')->with('success', 'تم حذف المهمة بنجاح');
    }
}
