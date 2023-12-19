<!--**********************************
	Sidebar Fixed
***********************************-->


@php
    $current_user   = auth()->user();
    $user_name      = isset($current_user->full_name) ? $current_user->full_name : '';
    $user_email         = isset($current_user->email) ? $current_user->email : '';
    $userId         = isset($current_user->id) ? $current_user->id : '';
    $userImg        = HelpDesk::user_img($current_user->profile);
@endphp

@php
	$sub_menu_icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><path d="M22,15 L22,19 C22,20.1045695 21.1045695,21 20,21 L8,21 C5.790861,21 4,19.209139 4,17 C4,14.790861 5.790861,13 8,13 L20,13 C21.1045695,13 22,13.8954305 22,15 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z" fill="#000000" opacity="0.3"/><path d="M15.5421357,5.69999981 L18.3705628,8.52842693 C19.1516114,9.30947552 19.1516114,10.5758055 18.3705628,11.3568541 L9.88528147,19.8421354 C8.3231843,21.4042326 5.79052439,21.4042326 4.22842722,19.8421354 C2.66633005,18.2800383 2.66633005,15.7473784 4.22842722,14.1852812 L12.7137086,5.69999981 C13.4947572,4.91895123 14.7610871,4.91895123 15.5421357,5.69999981 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z" fill="#000000" opacity="0.3"/><path d="M5,3 L9,3 C10.1045695,3 11,3.8954305 11,5 L11,17 C11,19.209139 9.209139,21 7,21 C4.790861,21 3,19.209139 3,17 L3,5 C3,3.8954305 3.8954305,3 5,3 Z M7,19 C8.1045695,19 9,18.1045695 9,17 C9,15.8954305 8.1045695,15 7,15 C5.8954305,15 5,15.8954305 5,17 C5,18.1045695 5.8954305,19 7,19 Z" fill="#000000"/></g></svg>';
@endphp

<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <img src="{{ $userImg }}" alt="{{ __('User profile') }}">
                <a href="{!! route('admin.users.profile') !!}"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">{{ __('Hello,') }}</span> {{ $user_name }}</h5>
            <p class="email">{{ $user_email }}</p>
        </div>
        <ul class="metismenu" id="menu">

            @can('Controllers > DashboardController > dashboard')
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-141-home"></i>
                    <span class="nav-text">{{ __('Dashboard') }}</span>
                </a>
                <ul aria-expanded="false">
                    <li class="{{ request()->is('admin') ? 'mm-active' : '' }}">
                        <a href="{!! url('/admin'); !!}">{{ __('Dashboard') }}</a>
                    </li>
                </ul>
            </li>
            @endcan

            <li class="nav-label">{{ __('CMS') }}</li>

             @canany(['Controllers > BlogsController > admin_index', 'Controllers > BlogsController > admin_create'])
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-push-pin"></i>
                    <span class="nav-text">{{ __('Postingan') }}</span>
                </a>
                <ul aria-expanded="false">
                    @can('Controllers > BlogsController > admin_index')
                        <li><a href="{{ route('blog.admin.index') }}">{{ __('List Postingan') }}</a></li>
                    @endcan
                    @can('Controllers > BlogsController > admin_create')
                        <li><a href="{{ route('blog.admin.create') }}">{{ __('Tambah Baru') }}</a></li>
                    @endcan
                    @can('Controllers > BlogCategoriesController > list')
                        <li><a href="{{ route('blog_category.admin.list') }}">{{ __('Kategori') }}</a></li>
                    @endcan
                    @can('Controllers > BlogTagsController > list')
                        <li><a href="{{ route('blog_tag.admin.list') }}">{{ __('Tags') }}</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            @canany(['Controllers > PagesController > admin_index', 'Controllers > PagesController > admin_create'])
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-049-copy"></i>
                    <span class="nav-text">{{ __('Pages') }}</span>
                </a>
                <ul aria-expanded="false">
                    @can('Controllers > PagesController > admin_index')
                        <li><a href="{{ route('page.admin.index') }}">{{ __('List Pages') }}</a></li>
                    @endcan
                    @can('Controllers > PagesController > admin_create')
                        <li><a href="{{ route('page.admin.create') }}">{{ __('Tambah Baru') }}</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-049-copy"></i>
                    <span class="nav-text">Galeri</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('galeri.admin.index') }}">{{ __('List Galeri') }}</a></li>
                    <li><a href="{{ route('galeri.admin.create') }}">{{ __('Tambah Baru') }}</a></li>
                </ul>
            </li>


            <li class="nav-label">{{ __('Admin') }}</li>

            @can('Controllers > UsersController > dashboard')
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-028-user-1"></i>
                    <span class="nav-text">{{ __('Pengguna') }}</span>
                </a>
                <ul aria-expanded="false">
                    @can('Controllers > UsersController > index')
                    <li class="{{ (DzHelper::controller() == 'UsersController' && DzHelper::action() == 'index') ? 'mm-active' : '' }}">

                        <a href="{{ route('admin.users.index') }}">{{ __('List Pengguna') }}</a>
                    </li>
                    @endcan
                    @can('Controllers > UsersController > create')
                    <li class="{{ (DzHelper::controller() == 'UsersController' && DzHelper::action() == 'create') ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.users.create') }}">{{ __('Tambah Baru') }}</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @canany(['Controllers > RolesController > index', 'Controllers > RolesController > create'])
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-153-user"></i>
                    <span class="nav-text">{{ __('Roles') }}</span>
                </a>
                <ul aria-expanded="false">
                    @can('Controllers > RolesController > index')
                    <li><a href="{{ route('admin.roles.index') }}">{{ __('All Roles') }}</a></li>
                    @endcan
                    @can('Controllers > RolesController > create')
                    <li><a href="{{ route('admin.roles.create') }}">{{ __('Add Role') }}</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany






            <li class="nav-label">Configurasi</li>

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-162-edit"></i>
                    <span class="nav-text">Configurasi Menu</span>
                </a>
                <ul aria-expanded="false">
                    @can('Controllers > MenusController > admin_index')
                    <li><a href="{{ route('menu.admin.admin_index') }}">{{ __('Menus') }}</a></li>
                    @endcan
                </ul>
            </li>



            @php
                $configuration_menu = HelpDesk::configuration_menu();
            @endphp

            @if(!empty($configuration_menu))
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-073-settings"></i>
                        <span class="nav-text">Configurasi Website</span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.configurations.admin_prefix', 'Site') }}">Situs</a>
                            <a href="{{ route('admin.configurations.admin_prefix', 'Social') }}">Social Media</a>
                            <a href="{{ route('admin.configurations.admin_prefix', 'Theme') }}">Banner Dan Text</a>
                        </li>
                    </ul>
                </li>
            @endif

            @canany(['Controllers > PermissionsController > index', 'Controllers > PermissionsController > roles_permissions', 'Controllers > PermissionsController > user_permissions', 'Controllers > PermissionsController > temp_permissions'])
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-035-shield"></i>
                    <span class="nav-text">{{ __('Permissions') }}</span>
                </a>
                <ul aria-expanded="false">

                    @can('Controllers > PermissionsController > roles_permissions')
                    <li><a href="{{ route('admin.permissions.roles_permissions') }}">{{ __('Roles Permissions') }}</a></li>
                    @endcan
                    @can('Controllers > PermissionsController > user_permissions')
                    <li><a href="{{ route('admin.permissions.user_permissions') }}">{{ __('Users Permissions') }}</a></li>
                    @endcan
                </ul>
            </li>
            @endcanany


        </ul>
        <div class="copyright">
        </div>
    </div>
</div>

<!--**********************************
	Sidebar End
***********************************
