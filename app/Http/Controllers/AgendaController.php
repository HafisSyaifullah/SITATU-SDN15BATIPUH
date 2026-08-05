<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaRequest;
use App\Models\Agenda;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Agenda::with('user')->select('agenda.*');

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('user', fn($item) => $item->user->name ?? '-')
                ->addColumn('tanggal_format', fn($item) => $item->tanggal->format('d-m-Y'))
                ->addColumn('action', function ($item) {
                    return view('agenda.action', compact('item'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('agenda.index');
    }

    public function create(): View
    {
        return view('agenda.create');
    }

    public function store(AgendaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $agenda = Agenda::create($data);

        ActivityLogService::catat("Menambahkan agenda: {$agenda->judul}", 'Agenda Sekolah');

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda): View
    {
        return view('agenda.edit', compact('agenda'));
    }

    public function update(AgendaRequest $request, Agenda $agenda): RedirectResponse
    {
        $agenda->update($request->validated());

        ActivityLogService::catat("Memperbarui agenda: {$agenda->judul}", 'Agenda Sekolah');

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda): RedirectResponse
    {
        ActivityLogService::catat("Menghapus agenda: {$agenda->judul}", 'Agenda Sekolah');
        $agenda->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
