<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team_members = TeamMember::orderBy('id','desc')->paginate(4);
        return view('cms.team_member.index', compact('team_members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.team_member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'name' => 'required|string|max:50',
            'job_title' => 'required|string|max:50',
            'bio' => 'nullable|string|max:1000',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
            ],400);
        }
        else {
            $team_member = new TeamMember();
            $team_member->name = $request->input('name');
            $team_member->job_title = $request->input('job_title');
            $team_member->bio = $request->input('bio');

            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time().'image.'.$image->getClientOriginalExtension();
                $image->move(public_path('storage/images/team_member'), $imageName);
                $team_member->image_path = 'storage/images/team_member/' . $imageName;
            }

            $issaved = $team_member->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Member created successfully'
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $team_member = TeamMember::findOrFail($id);
        return response()->view('cms.team_member.show', compact('team_member'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $team_member = TeamMember::findOrFail($id);
        return response()->view('cms.team_member.edit', compact('team_member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {

        $validator = Validator($request->all(),[
            'name' => 'required|string|max:50',
            'job_title' => 'required|string|max:50',
            'bio' => 'nullable|string|max:1000',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
            ],400);
        }
        else {
            $team_member = TeamMember::findOrFail($id);
            $team_member->name = $request->input('name');
            $team_member->job_title = $request->input('job_title');
            $team_member->bio = $request->input('bio');

            if ($request->hasFile('image_path')) {
                $image = $request->file('image_path');
                $imageName = time().'image.'.$image->getClientOriginalExtension();
                $image->move(public_path('storage/images/team_member'), $imageName);
                $team_member->image_path = 'storage/images/team_member/' . $imageName;
            }

            $isupdated = $team_member->save();

            return response()->json([
                'icon' => 'success',
                'title' => 'Updated successfully',
                'redirect' => route('cms.team_members.index')
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TeamMember::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'Deleted successfully'], 200);
    }

    public function trashed(){
        $team_members = TeamMember::onlyTrashed()->orderBy('deleted_at','desc')->get();
        return response()->view('cms.team_member.trashed', compact('team_members'));
    }

    public function restore($id){
        TeamMember::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','TeamMember Restored Successfully');
    }

    public function force($id){
        TeamMember::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success','TeamMember Deleted Permanently');
    }

    public function forceAll(){
        TeamMember::onlyTrashed()->forceDelete();
        return back()->with('success','All TeamMembers Deleted Permanently');
    }
}
