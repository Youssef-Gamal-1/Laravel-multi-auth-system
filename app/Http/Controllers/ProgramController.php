<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Http\Resources\Program\ProgramCollection;
use App\Http\Resources\Program\ProgramResource;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny');
        return new ProgramCollection(Program::paginate());
    }

    public function store(StoreProgramRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        $program = Program::create($validated);

        return new ProgramResource($program);
    }

    public function show(Program $program)
    {
        $this->authorize('view',$program);
        return new ProgramResource($program);
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $this->authorize('update',$program);
        $validated = $request->validated();
        $program->update($validated);

        return new ProgramResource($program);
    }

    public function destroy(Program $program)
    {
        $this->authorize('delete');
        $program->delete();

        return response()->json([
            'message' => 'Program deleted!'
        ]);
    }


}
