<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\User;
use App\Traits\ResponseStatus;
use File;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Rules\EditorEmptyCheckRule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    use ResponseStatus;
    public function admin_index(Request $request)
    {
        $page_title = 'Galeri';

        if ($request->ajax()) {
            $data = Galeri::query();

        //     @can('Controllers > BlogsController > admin_edit')
        //     <a href="{{ route('blog.admin.edit', $page->id) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
        // @endcan
        // @can('Controllers > BlogsController > admin_destroy')
        //     <a href="{{ route('blog.admin.admin_trash_status', $page->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
        // @endcan

            return DataTables::of($data)
              ->addColumn('action', function ($row) {
                $edit = ' <a href="'.route('galeri.admin.edit', $row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
              //  $delete = '    <a href="'. route('galeri.admin.delete', $row->id) .'" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>';
              $delete = '  <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete"
              data-bs-id="' . $row->id . '"
              data-bs-url="' . route('galeri.admin.delete', $row->id) .'"
              class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>';
              return '
                    '.$edit.'
                    '.$delete.'
                ';
            })
            ->editColumn('image', function (Galeri $galeri) {
                 $data = asset('images/noimage.jpg');
               if(isset($galeri->value)){
                 $data =  asset("storage/galeri-images/$galeri->value");
               }
               return '<img class="rounded-circle" src="'.$data.'"alt="photo" style="width:75px; height: 75px;">';
             })
             ->rawColumns(['image', 'action'])
            ->make(true);
          }

        return view('admin.galeri.index', compact('page_title'));
    }

    public function admin_create()
    {
        $page_title = 'Tambah Galeri';
        return view('admin.galeri.create', compact('page_title'));
    }
    public function admin_store(Request $request)
    {
        $validation = [
            'data.Galeri.title'     => 'required',
            'data.GaleriImage.value'     => 'mimes:jpg,png,jpeg,gif',
        ];

        $validationMsg = [
            'data.Galeri.title.required'      => __('The title field is required.'),
            'data.GaleriImage.value.mimes'   => __('The feature image must be a file of type: jpg, png, jpeg, gif.'),
        ];

        $this->validate($request, $validation, $validationMsg);
        DB::beginTransaction();
        try {
            $galeriData   = $request->input('data.Galeri');
            $galeriData['user_id'] = Auth::id();
            $galeri       = Galeri::create($galeriData);
            if($galeri)
            {
            if(!empty(request()->file('data.GaleriImage')))
                {
                    $image_file = request()->file('data.GaleriImage.value');
                    // dd($image_file);
                    $OriginalName =  $image_file->getClientOriginalName();
                    $fileName = time().'_'.$OriginalName;
                    $image_file->storeAs('public/galeri-images/', $fileName);
                    $galeri->update([
                        'value' => $fileName,
                    ]);
                }
                DB::commit();
                return redirect()->route('galeri.admin.index')->with('success', __('Galeri Berhasil Di Tambahkan.'));

            }
            return redirect()->back()->with('error', __('Something went wrong. Please try again.'));

        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }



    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeri $galeri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $galeri = Galeri::findorFail($id);
            if ($galeri->delete()) {
                $imagePath = public_path('storage/galeri-images/'.$galeri->value);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
                    // dd('/storage/galeri-images/' . $galeri->value);
                    //Storage::disk('public')->delete(['/storage/galeri-images/' . $galeri->value]);
              }
        DB::commit();
        $response = response()->json($this->responseDelete(true));
        return redirect()->route('galeri.admin.index')->with('success', __('Galeri Berhasil Di Hapus.'));
      } catch (Throwable $throw) {
        dd($throw);
        DB::rollBack();
        $response = response()->json($this->responseStore(false));
      }

      return $response;

    }
}
