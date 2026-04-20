<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::with('brands')->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.contact_message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        return response()->view('cms.contact_message.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'sender_name' => 'required|string|max:45',
            'sender_email' => 'required|email|max:45',
            'message_text' => 'required|string',
            'brand_ids' => 'required|array|min:1',
            'brand_ids.*' => 'exists:brands,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }

        DB::beginTransaction();
        try {
            $message = ContactMessage::create([
                'sender_name' => $request->sender_name,
                'sender_email' => $request->sender_email,
                'message_text' => $request->message_text,
            ]);

            $message->brands()->attach($request->brand_ids);

            DB::commit();
            return response()->json([
                'icon' => 'success',
                'title' => 'Message sent successfully',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'icon' => 'error',
                'title' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contactMessage = ContactMessage::with('brands')->findOrFail($id);
        return response()->view('cms.contact_message.show', compact('contactMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contactMessage = ContactMessage::with('brands')->findOrFail($id);
        $brands = Brand::all();
        $selectedBrandIds = $contactMessage->brands->pluck('id')->toArray();
        return response()->view('cms.contact_message.edit', compact('contactMessage', 'brands', 'selectedBrandIds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'sender_name' => 'required|string|max:45',
            'sender_email' => 'required|email|max:45',
            'message_text' => 'required|string',
            'brand_ids' => 'required|array|min:1',
            'brand_ids.*' => 'exists:brands,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }

        DB::beginTransaction();
        try {
            $message = ContactMessage::findOrFail($id);
            $message->update([
                'sender_name' => $request->sender_name,
                'sender_email' => $request->sender_email,
                'message_text' => $request->message_text,
            ]);

            $message->brands()->sync($request->brand_ids);

            DB::commit();
            return response()->json([
                'icon' => 'success',
                'title' => 'Message updated successfully',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed to update message'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
       $isDeleted = ContactMessage::destroy($id);
        return response()->json([
            'icon' => $isDeleted ? 'success' : 'error',
            'title' => $isDeleted ? 'Deleted successfully' : 'Delete failed',
        ], $isDeleted ? 200 : 400);
    }
}
