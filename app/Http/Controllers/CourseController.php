<?php

namespace App\Http\Controllers;

use App\Http\Resources\Course\CourseCollection;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Program $program = null)
    {
        return new CourseCollection(Course::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'programs' => 'required|array',
            'programs.*' => 'exists:programs,id'
        ]);

        $course = Course::create($validated);
        $course->program()->sync($validated['programs']);

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program, Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name'=> 'sometimes|required|max:255|string',
            'programs' => 'sometimes|required|array',
            'programs.*' => 'sometimes|exists:programs,id'
        ]);

        $course->update($validated);
        return new CourseResource($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json(['message' => 'Course deleted!']);
    }
}
