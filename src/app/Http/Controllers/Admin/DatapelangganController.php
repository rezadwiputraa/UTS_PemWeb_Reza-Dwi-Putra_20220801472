<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDatapelangganRequest;
use App\Http\Requests\StoreDatapelangganRequest;
use App\Http\Requests\UpdateDatapelangganRequest;
use App\Models\Datapelanggan;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DatapelangganController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('datapelanggan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $datapelanggans = Datapelanggan::with(['media'])->get();

        return view('admin.datapelanggans.index', compact('datapelanggans'));
    }

    public function create()
    {
        abort_if(Gate::denies('datapelanggan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datapelanggans.create');
    }

    public function store(StoreDatapelangganRequest $request)
    {
        $datapelanggan = Datapelanggan::create($request->all());

        if ($request->input('image', false)) {
            $datapelanggan->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $datapelanggan->id]);
        }

        return redirect()->route('admin.datapelanggans.index');
    }

    public function edit(Datapelanggan $datapelanggan)
    {
        abort_if(Gate::denies('datapelanggan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datapelanggans.edit', compact('datapelanggan'));
    }

    public function update(UpdateDatapelangganRequest $request, Datapelanggan $datapelanggan)
    {
        $datapelanggan->update($request->all());

        if ($request->input('image', false)) {
            if (! $datapelanggan->image || $request->input('image') !== $datapelanggan->image->file_name) {
                if ($datapelanggan->image) {
                    $datapelanggan->image->delete();
                }
                $datapelanggan->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($datapelanggan->image) {
            $datapelanggan->image->delete();
        }

        return redirect()->route('admin.datapelanggans.index');
    }

    public function show(Datapelanggan $datapelanggan)
    {
        abort_if(Gate::denies('datapelanggan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datapelanggans.show', compact('datapelanggan'));
    }

    public function destroy(Datapelanggan $datapelanggan)
    {
        abort_if(Gate::denies('datapelanggan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $datapelanggan->delete();

        return back();
    }

    public function massDestroy(MassDestroyDatapelangganRequest $request)
    {
        $datapelanggans = Datapelanggan::find(request('ids'));

        foreach ($datapelanggans as $datapelanggan) {
            $datapelanggan->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('datapelanggan_create') && Gate::denies('datapelanggan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Datapelanggan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
