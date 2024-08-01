<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetFormRequest;
use App\Models\PetsApi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PetstoreController extends Controller
{
    private $petsApi;

    public function __construct(PetsApi $petsApi)
    {
        $this->petsApi = $petsApi;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = request()->input('status');

        $status = in_array($status, ['available', 'pending', 'sold']) ? $status : 'available';

        $pets = $this->petsApi->findByStatus($status);

        return view('pet.index')->with(compact('pets', 'status'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PetFormRequest $request): RedirectResponse
    {
        $this->petsApi->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $pet = $this->petsApi->findByid($id);

        if (is_null($pet)) {
            return redirect('/')->with('flash', 'zwierze nie istnieje');
        }
        
        return view('pet.show', compact('pet'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $pet = $this->petsApi->findByid($id);

        if (is_null($pet)) {
            return redirect('/')->with('flash', 'zwierze nie istnieje');
        }

        return view('pet.edit')->with(compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PetFormRequest $request, int $id)
    {
        $this->petsApi->update($id);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $pet = $this->petsApi->findByid($id);

        if (is_null($pet)) {
            return redirect('/')->with('flash', 'zwierze nie istnieje');
        }

        $response = $this->petsApi->delete($id);

        if ($response === 'failed') {
            return redirect('/')->with('flash', 'wystąpił błąd');
        }

        return redirect('/')->with('flash', 'zwierzę usunięte z bazy danych');
    }
}