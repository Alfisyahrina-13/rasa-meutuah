<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CrudController extends Controller
{
    private function cfg(string $resource): array
    {
        $c = config("admin.resources.$resource");
        abort_unless($c, 404);

        return $c;
    }

    public function index(Request $request, string $resource)
    {
        $c = $this->cfg($resource);

        if (! empty($c['tunggal'])) {
            return redirect()->route('admin.crud.edit', [$resource, $c['model']::ambil()->id]);
        }

        $items = $c['model']::query()
            ->when($request->q, fn ($q, $v) => $q->where('nama', 'like', "%{$v}%"))
            ->orderBy($c['urut'])
            ->paginate(15)
            ->withQueryString();

        return view('admin.crud.index', compact('c', 'resource', 'items'));
    }

    public function create(string $resource)
    {
        $c = $this->cfg($resource);
        abort_if(! empty($c['tunggal']), 404);

        return view('admin.crud.form', ['c' => $c, 'resource' => $resource, 'item' => new $c['model']]);
    }

    public function store(Request $request, string $resource)
    {
        $c = $this->cfg($resource);
        abort_if(! empty($c['tunggal']), 404);
        $data = $this->validated($request, $c);
        $data['slug'] = $this->slugUnik($c['model'], $data['nama']);
        $this->urusFoto($request, $data, null);

        $c['model']::create($data);

        return redirect()->route('admin.crud.index', $resource)->with('ok', $c['label'].' berhasil ditambahkan.');
    }

    public function edit(string $resource, int $id)
    {
        $c = $this->cfg($resource);

        return view('admin.crud.form', ['c' => $c, 'resource' => $resource, 'item' => $c['model']::findOrFail($id)]);
    }

    public function update(Request $request, string $resource, int $id)
    {
        $c = $this->cfg($resource);
        $item = $c['model']::findOrFail($id);
        $data = $this->validated($request, $c);
        $this->urusFoto($request, $data, $item);

        $item->update($data); // slug sengaja tidak diubah agar tautan dan nama foto tetap

        if (! empty($c['tunggal'])) {
            return redirect()->route('admin.crud.edit', [$resource, $item->id])->with('ok', 'Perubahan disimpan.');
        }

        return redirect()->route('admin.crud.index', $resource)->with('ok', 'Perubahan disimpan.');
    }

    public function destroy(string $resource, int $id)
    {
        $c = $this->cfg($resource);
        abort_if(! empty($c['tunggal']), 404);
        $item = $c['model']::findOrFail($id);
        $this->hapusFile($item->gambar);
        $item->delete();

        return redirect()->route('admin.crud.index', $resource)->with('ok', 'Data dihapus.');
    }

    /* ---------- bantu ---------- */

    private function validated(Request $request, array $c): array
    {
        $rules = [];

        foreach ($c['fields'] as $f) {
            $n = $f['name'];

            if ($f['type'] === 'checkbox') {
                $rules[$n] = ['nullable', 'boolean'];
            } elseif ($f['type'] === 'image') {
                $rules[$n] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];
            } else {
                $r = [! empty($f['required']) ? 'required' : 'nullable'];
                if ($f['type'] === 'number') {
                    array_push($r, 'integer', 'min:0');
                } elseif ($f['type'] === 'select') {
                    $r[] = Rule::in($f['options']);
                } else {
                    array_push($r, 'string', 'max:'.($f['max'] ?? ($f['type'] === 'textarea' ? 5000 : 255)));
                }
                $rules[$n] = $r;
            }
        }

        $valid = $request->validate($rules, [
            'required' => ':attribute wajib diisi.',
            'image'    => 'Berkas harus berupa gambar.',
            'mimes'    => 'Format foto harus JPG, PNG, atau WEBP.',
            'max'      => 'Isian :attribute terlalu panjang atau berkas terlalu besar (foto maksimal 5 MB).',
            'integer'  => ':attribute harus berupa angka.',
        ], collect($c['fields'])->pluck('label', 'name')->all());

        $data = [];
        foreach ($c['fields'] as $f) {
            $n = $f['name'];
            if ($f['type'] === 'image') {
                continue;
            }
            $data[$n] = $f['type'] === 'checkbox'
                ? $request->boolean($n)
                : ($valid[$n] ?? ($f['default'] ?? null));
        }

        return $data;
    }

    private function slugUnik(string $model, string $nama): string
    {
        $dasar = Str::slug($nama) ?: 'item';
        $slug = $dasar;
        $i = 2;
        while ($model::where('slug', $slug)->exists()) {
            $slug = $dasar.'-'.$i++;
        }

        return $slug;
    }

    private function urusFoto(Request $request, array &$data, ?Model $item): void
    {
        if ($item && $request->boolean('hapus_gambar')) {
            $this->hapusFile($item->gambar);
            $data['gambar'] = null;
        }

        if ($request->hasFile('gambar')) {
            if ($item) {
                $this->hapusFile($item->gambar);
            }
            $file = $request->file('gambar');
            $nama = Str::random(14).'.'.$file->extension();
            $file->move(public_path('images/uploads'), $nama);
            $data['gambar'] = 'uploads/'.$nama;
        }
    }

    private function hapusFile(?string $gambar): void
    {
        if ($gambar && str_starts_with($gambar, 'uploads/')) {
            @unlink(public_path('images/'.$gambar));
        }
    }
}
