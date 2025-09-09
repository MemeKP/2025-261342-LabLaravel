<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LinkEntry;

class LinkEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     * (READ)
     */
   public function index()
{
    $linkEntries = Auth::user()->linkEntries()->get(); 
    return view('link.index', compact('linkEntries'));
}


    /**
     * Show the form for creating a new resource.
     * (CREATE FORM)
     */
    public function create()
    {
        return view('link.create');
    }

    /**
     * Store a newly created resource in storage.
     * (CREATE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        Auth::user()->linkEntries()->create([
            'platform' => $request->platform,
            'url' => $request->url,
        ]);

        return redirect()->route('link.index')->with('success', 'Link added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     * (EDIT FORM)
     */
    public function edit($id)
    {
        $linkEntry = LinkEntry::where('user_id', Auth::id())->findOrFail($id);
        return view('link.edit', compact('linkEntry'));
    }
    // public function edit(string $id)
    // {
    //     $diaryEntry = Auth::user()->linkEntries()->findOrFail($id);
    //     return view('link.edit', compact('linkEntry'));
    // }

    /**
     * Update the specified resource in storage.
     * (UPDATE)
     */
    public function update(Request $request, $id)
    {
        $linkEntry = Auth::user()->linkEntries()->findOrFail($id);
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        // $linkEntry->update([
        //     'platform' => $request->platform,
        //     'url' => $request->url,
        // ]);
        $linkEntry->update($validated);
        return redirect()->route('link.index')->with('status', 'Link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * (DELETE)
     */
    public function destroy($id)
    {
        $linkEntry = LinkEntry::where('user_id', Auth::id())->findOrFail($id);
        $linkEntry->delete();

        return redirect()->route('link.index')->with('success', 'Link deleted successfully.');
    }
}
