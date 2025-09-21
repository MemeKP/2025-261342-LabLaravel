<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reminder;
use App\Models\Tag;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     * (READ)
     */
    public function index()
    {
        $reminders = Auth::user()->reminders()->with('tags')->get();
        return view('reminders.index', compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     * (CREATE FORM)
     */
    public function create()
    {
        $tags = Tag::all(); // ให้ user เลือกแท็กที่มีอยู่แล้ว
        return view('reminders.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     * (CREATE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'remind_at' => 'required|date',
            'status'  => 'nullable|string|max:50',
            'tags'    => 'array', // [1,2,3]
        ]);

        $reminder = Auth::user()->reminders()->create([
            'title'     => $request->title,
            'content'   => $request->content,
            'remind_at' => $request->remind_at,
            'status'    => $request->status ?? 'New',
        ]);

        if ($request->has('tags')) {
            $reminder->tags()->sync($request->tags); // attach tags ผ่าน pivot
        }

        return redirect()->route('reminder.index')->with('success', 'Reminder created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     * (EDIT FORM)
     */
    public function edit($id)
    {
        $reminder = Reminder::where('user_id', Auth::id())
            ->with('tags')
            ->findOrFail($id);

        $tags = Tag::all();

        return view('reminders.edit', compact('reminder', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     * (UPDATE)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'remind_at' => 'required|date',
            'status'  => 'nullable|string|max:50',
            'tags'    => 'array',
        ]);

        $reminder = Reminder::where('user_id', Auth::id())->findOrFail($id);

        $reminder->update([
            'title'     => $request->title,
            'content'   => $request->content,
            'remind_at' => $request->remind_at,
            'status'    => $request->status,
        ]);

        if ($request->has('tags')) {
            $reminder->tags()->sync($request->tags);
        }

        return redirect()->route('reminder.index')->with('success', 'Reminder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * (DELETE)
     */
    public function destroy($id)
    {
        $reminder = Reminder::where('user_id', Auth::id())->findOrFail($id);
        $reminder->tags()->detach(); // ลบ pivot ด้วย
        $reminder->delete();

        return redirect()->route('reminder.index')->with('success', 'Reminder deleted successfully.');
    }
}
