<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    /*
    *  Display dashboard for admin panel
    */
    public function dashboard()
    {   
        $page_title = __('Dashboard');
        $blogscount = Blog::get()->count();
        $pagescount = Page::get()->count();
        $rolescount = Role::get()->count();
        $userscount = User::get()->count();
        $blog_categories = BlogCategory::select('id','title')->withCount('blog')->inRandomOrder()->limit(4)->get();
        $catagory_labels = $blog_categories->pluck('title');
        $catagory_counts = $blog_categories->pluck('blog_count');

        if ($catagory_counts->isNotEmpty()) {
            $multiplyby = 10;
            foreach ($catagory_counts as $key => $value) {
                if ($value > 10) {
                    $multiplyby = 1;
                    break;
                }
            }
            for ($i=0; $i < 4; $i++) { 
                if(isset($catagory_counts[$i])){
                    $catagory_counts[$i] = $catagory_counts[$i] * $multiplyby;   
                }
            }
        }

        $users_query = User::selectRaw('CONCAT_WS("-", MONTHNAME(created_at),YEAR(created_at)) monthyear, count(*) data');
        $users = $users_query->groupBy('monthyear')->orderBy('created_at', 'asc')->get();

        $users_monthyear = $users->pluck('monthyear');
        $users_count = $users->pluck('data');
        $max_user_count = max($users_count->toArray());
        $max_user_count = ($max_user_count <= 1) ? $max_user_count + 3 : $max_user_count + 1 ; 
        
        return view('admin.dashboard',compact('blogscount','pagescount','rolescount','userscount','blog_categories','catagory_counts','catagory_labels','users_monthyear','users_count','max_user_count','page_title'));
    }
}
