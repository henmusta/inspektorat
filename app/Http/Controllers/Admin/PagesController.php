<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageMeta;
use App\Models\PageSeo;
use App\Models\User;
use App\Rules\EditorEmptyCheckRule;
use Yajra\DataTables\Facades\DataTables;
use Storage;
use Auth;

class PagesController extends Controller
{
	public function index($page_slug) {
		$page_title = __('pages index');
		$page = Page::with('page_metas', 'page_seo')->firstWhere('slug', $page_slug);
		return view('front.pages.index', compact('page','page_title'));
	}

	/**
	 * Display a listing of the resource.
	 * @return Renderable
	 *
	 */
	public function admin_index(Request $request)
	{

		$page_title = __('All Pages');


        if ($request->ajax()) {
            $data = Page::query();
            $data->join('users', 'pages.user_id', '=', 'users.id');
            $data->select('pages.*','users.name as user_name');
            $data->where('status', '!=', 3);

            return DataTables::of($data)
              ->addColumn('action', function ($row) {
                $edit = ' <a href="'.route('page.admin.edit', $row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
                $delete = '    <a href="'. route('page.admin.admin_trash_status', $row->id) .'" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>';

              return '
                    '.$edit.'
                    '.$delete.'
                ';
            })

             ->rawColumns(['action'])
            ->make(true);
        }

		return view('admin.pages.index', compact('page_title'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Renderable
	 */
	public function admin_create()
	{
		$page_title = __('Create New Page');
		$pages = Page::get();
		$users = User::get();
		$screenOption = config('page.ScreenOption');
		return view('admin.pages.create', compact('users', 'pages','page_title','screenOption'));
	}

	/**
	 * Store a newly created resource in storage.
	 * @param Request $request
	 * @return Renderable
	 */
	public function admin_store(Request $request)
	{
		$validation = [
			'data.Page.title'       	=> 'required',
			'data.Page.content'     	=> ['required', new EditorEmptyCheckRule],
			'data.Page.publish_on'  	=> 'required',
            'data.PageMeta.0.value'     => 'mimes:jpg,png,jpeg,gif',
		];

		$validationMsg = [
			'data.Page.title.required'      => __('The title field is required.'),
			'data.Page.content.required'    => __('The page content field is required.'),
			'data.Page.publish_on.required' => __('The published on field is required.'),
            'data.PageMeta.0.value.mimes'   => __('The feature image must be a file of type: jpg, png, jpeg, gif.'),
		];

		$this->validate($request, $validation, $validationMsg);

		$pageData = $request->input('data.Page');
		$pageData['user_id'] = Auth::id();
		$page       = Page::create($pageData);
		$page_metas = collect($request->data['PageMeta'])->sortKeys()->all();
		if($page)
		{
			$pageseo    = $page->page_seo()->create($request->input('data.PageSeo'));
			if(!empty($page_metas))
			{
				foreach ($page_metas as $page_meta) {
					if($page_meta['title'] == 'ximage')
					{
						if(!empty($page_meta['value']))
						{
							$OriginalName = $page_meta['value']->getClientOriginalName();
							$fileName = time().'_'.$OriginalName;
							$page_meta['value']->storeAs('public/page-images/', $fileName);
							$pageMetaArr = ['title' => $page_meta['title'], 'value' => $fileName];
							$page_meta['value'] = $fileName;
						}
					} else
					{
						$pageMetaArr = ['title' => $page_meta['title'], 'page_id'=>$page->id, 'value' => $page_meta['value']];
					}

					$page->page_metas()->create($page_meta);

				}
			}
			return redirect()->route('page.admin.index')->with('success', __('Page added successfully.'));
		}
		return redirect()->back()->with('error', __('Sorry, Something went wrong.'));
	}

	/**
	 * Show the specified resource.
	 * @param int $id
	 * @return Renderable
	 */
	public function show($id)
	{
		return view('admin.pages.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * @param int $id
	 * @return Renderable
	 */
	public function admin_edit($id)
	{
		$page_title = __('Page Edit');
		$users = User::get();

		$parentPages = Page::where('id', '!=', $id)->where(function ($query) use($id)
		{
			$query->where('parent_id', '!=', $id);
			$query->orWhereNull('parent_id');
		})->get();

		$page = Page::with('page_metas', 'page_seo', 'feature_img')->findorFail($id);
		$screenOption = config('page.ScreenOption');
		return view('admin.pages.edit', compact('parentPages', 'users', 'page','page_title','screenOption'));
	}

	/**
	 * Update the specified resource in storage.
	 * @param Request $request
	 * @param int $id
	 * @return Renderable
	 */
	public function admin_update(Request $request, $id)
	{
		$validation = [
			'data.Page.title'       => 'required',
			'data.Page.content'     => ['required', new EditorEmptyCheckRule],
			'data.Page.publish_on'  => 'required',
            'data.PageMeta.0.value'     => 'mimes:jpg,png,jpeg,gif',
		];

		$validationMsg = [
			'data.Page.title.required'      => __('The title field is required.'),
			'data.Page.content.required'    => __('The page content field is required.'),
			'data.Page.publish_on.required' => __('The published on field is required.'),
            'data.PageMeta.0.value.mimes'   => __('The feature image must be a file of type: jpg, png, jpeg, gif.'),
		];

		$this->validate($request, $validation, $validationMsg);

		$page       		= Page::with('page_metas', 'page_seo')->findorFail($id);
		$pageArr 			= $request->input('data.Page');
		$pageArr['slug'] 	= $request->input('data.Page.editslug');
		$page->fill($pageArr)->save();
		$page_metas = collect($request->data['PageMeta'])->sortKeys()->all();
		if($page)
		{
			$pageseo	= $page->page_seo()->update($request->input('data.PageSeo'));
			if(!empty($page_metas))
			{
				$pageMetaIds = array_column($page_metas, 'meta_id');
				PageMeta::where('page_id', '=', $id)->whereNotIn('id', $pageMetaIds)->delete();

				foreach ($page_metas as $page_meta) {

					if($page_meta['title'] != 'ximage')
					{
						$page->page_metas()->create($page_meta);
					}
					else
					{
						if(!empty($page_meta['value']))
						{
							$OriginalName = $page_meta['value']->getClientOriginalName();
							$fileName = time().'_'.$OriginalName;
							$page_meta['value']->storeAs('public/page-images/', $fileName);
							if($page_meta['old_value'] && Storage::exists('public/page-images/'.$page_meta['old_value']))
							{
								Storage::delete('public/page-images/'.$page_meta['old_value']);
							}
							$page_meta['value'] = $fileName;
						}
						else
						{
							if($page_meta['old_value'] && Storage::exists('public/page-images/'.$page_meta['old_value']))
							{
								$page_meta['value'] = $page_meta['old_value'];
							}
						}
						$page->page_metas()->create($page_meta);
					}
				}
			}
			return redirect()->route('page.admin.index')->with('success', __('Page updated successfully.'));
		}
		return redirect()->back()->with('error', __('Sorry, Something went wrong.'));
	}

	/**
	 * Remove the specified resource from storage.
	 * @param int $id
	 * @return Renderable
	 */
	public function admin_destroy($id)
	{
		$page           = Page::findOrFail($id);
		$res            = $page->delete();
		if($res)
		{
			return redirect()->back()->with('success', __('Page Deleted successfully.'));
		}
		return redirect()->back()->with('error', __('Something went wrong. Please try again.'));
	}

	public function admin_trash_status($id)
	{
		$page           = Page::findOrFail($id);
		$page->status   = 3;
		$res            = $page->save();

		if($res)
		{
			return redirect()->back()->with('success', __('Page is trashed successfully.'));
		}
		return redirect()->back()->with('error', __('Something went wrong. Please try again.'));
	}

	public function restore_page($id)
	{
		$page           = Page::findOrFail($id);
		$page->status   = 1;
		$res            = $page->save();

		if($res)
		{
			return redirect()->back()->with('success', 'Page is restored successfully.');
		}
		return redirect()->back()->with('error', 'Something went wrong. Please try again.');
	}

	public function trash_list(Request $request)
	{
		$page_title = 'Trashed Pages';


        if ($request->ajax()) {
            $data = Page::query();
            $data->join('users', 'pages.user_id', '=', 'users.id');
            $data->select('pages.*','users.name as user_name');
            $data->where('status', '=', 3);

            return DataTables::of($data)
              ->addColumn('action', function ($row) {
                $edit = ' <a href="'.route('page.admin.edit', $row->id).'" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
                $delete   = '  <a href="#" data-bs-toggle="modal" data-bs-target="#modalDelete"
                                data-bs-id="' . $row->id . '"
                                data-bs-url="' . route('page.admin.destroy', $row->id) .'"
                                class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>';
              return '
                    '.$edit.'
                    '.$delete.'
                ';
            })

             ->rawColumns(['action'])
            ->make(true);
        }

		return view('admin.pages.trashed_pages', compact('page_title'));
	}

	public function remove_feature_image($id)
	{
		$page_meta	= PageMeta::where('title', '=', 'ximage')->where('page_id', '=', $id)->first();
		if(!empty($page_meta->value) && Storage::exists('public/page-images/'.$page_meta->value))
		{
			Storage::delete('public/page-images/'.$page_meta->value);
			return $page_meta->delete();
		}
	}
}
