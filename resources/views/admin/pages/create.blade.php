{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')

<div class="container-fluid">
	<div class="card accordion accordion-rounded-stylish accordion-bordered" id="accordion-slug">
	    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-slug" aria-expanded="true">
	        <h4 class="card-title">{{ __('Screen Options') }}</h4>
	        <span class="accordion-header-indicator"></span>
	    </div>
	    <div class="accordion__body p-4 collapse show" id="with-slug" data-bs-parent="#accordion-slug">
	        <div class="row">
	        	@forelse($screenOption as $key => $value)
					<div class="col-md-2 form-group">
						<label class="checkbox-inline">
							<input type="checkbox" id="Allow{{ $key }}" class="me-1 m-0 form-check-input allowField Allow{{ $key }}" rel="{{ $key }}" {{ $value['visibility'] ? 'checked="checked"' : '' }}>
							{{ $key }}
						</label>
					</div>
				@empty
				@endforelse
            </div>
	    </div>
	</div>

	<div class="row page-titles mx-0 ">
        <div class="col-sm-6 p-0">
            <div class="welcome-text">
                <h4>{{ __('Pages') }}</h4>
                <span>{{ __('Add Page') }}</span>
            </div>
        </div>
        <div class="col-sm-6 p-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('page.admin.index') }}">{{ __('Pages') }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Add Page') }}</a></li>
            </ol>
        </div>
    </div>

	<form action="{{ route('page.admin.store') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">{{ __('Add Page') }}</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group col-md-12">
										<label for="ContentTitle">{{ __('Title') }}</label>
										<input type="text" name="data[Page][title]" class="form-control" id="ContentTitle" placeholder="{{ __('Title') }}" value="{{ old('data.Page.title') }}">
										@error('data.Page.title')
						                    <p class="text-danger">
						                        {{ $message }}
						                    </p>
						                @enderror
									</div>
									<div class="form-group col-md-12">
										<textarea name="data[Page][content]" class="form-control W3cmsCkeditor h-auto" id="PageContent" rows="10">{{ old('data.Page.content') }}</textarea>
										@error('data.Page.content')
						                    <p class="text-danger">
						                        {{ $message }}
						                    </p>
						                @enderror
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XExcerpt {{ $screenOption['Excerpt']['visibility'] ? '' : 'd-none' }}" id="accordion-excerpt">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-excerpt" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Excerpt') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-excerpt" data-bs-parent="#accordion-excerpt">
		                        <div class="form-group">
			                        <label for="ContentExcerpt">{{ __('Excerpt') }}</label>
			                        <textarea name="data[Page][excerpt]" class="form-control" id="ContentExcerpt" rows="5">{{ old('data.Page.excerpt') }}</textarea>
			                        <small>{{ __('Excerpts are optional hand-crafted summaries of your content that can be used in your theme.') }}</small>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XCustomFields {{ $screenOption['CustomFields']['visibility'] ? '' : 'd-none' }}" id="accordion-custom-fields">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-custom-fields" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Custom Fields') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-custom-fields" data-bs-parent="#accordion-custom-fields">
		                    	<div id="AppendContainer">
		                    		@php
		                    			$count = 0;
		                    			$custom_fields = old('data.PageMeta');
		                    		@endphp
		                    		@if(!empty($custom_fields))
				                    	<div id="customFieldContainer">
			                    			@foreach($custom_fields as $custom_field)
			                    				@if($custom_field['title'] == 'ximage')
			                    					@continue
			                    				@endif
					                    		@php
					                    			$count++;
					                    		@endphp
				                    			<div class="row xrow">
				                    				<div class="col-md-6 form-group">
				                    					<label for="PageMetaName_{{ $count }}">{{ __('Title') }}</label>
				                    					<input type="text" name="data[PageMeta][{{ $count }}][title]" class="form-control" id="PageMetaName_{{ $count }}" value="{{ $custom_field['title'] }}">
				                    				</div>
				                    				<div class="col-md-6 form-group">
				                    					<label for="PageMetaValue_{{ $count }}">{{ __('Value') }}</label>
				                    					<textarea name="data[PageMeta][{{ $count }}][value]" id="PageMetaValue_{{ $count }}" class="form-control" rows="5">{{ $custom_field['value'] }}</textarea>
				                    				</div>
				                    				<div class="col-md-12 form-group">
				                    					<button class="btn btn-danger CustomFieldRemoveButton" type="button">{{ __('Delete') }}</button>
				                    				</div>
				                    			</div>
			                    			@endforeach
				                    	</div>
		                    		@endif
		                    		<input type="hidden" id="last_cf_num" value="{{ $count }}">
		                    	</div>
		                        <div class="row">
		                        	<div class="col-md-6 form-group">
		                        		<label for="PageMetaName">{{ __('Title') }}</label>
		                        		<input type="text" class="form-control" id="PageMetaName" placeholder="{{ __('Title') }}">
		                        	</div>
		                        	<div class="col-md-6 form-group">
		                        		<label for="PageMetaValue">{{ __('Value') }}</label>
		                        		<textarea class="form-control" id="PageMetaValue" rows="5"></textarea>
		                        	</div>
		                        </div>
			                    <button type="button" class="btn btn-sm btn-primary" id="AddCustomField">{{ __('Add Custom Field') }}</button>
			                    <small class="d-block mt-2">{{ __('Custom fields can be used to extra metadata to a post that you can use in your theme.') }}</small>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XDiscussion {{ $screenOption['Discussion']['visibility'] ? '' : 'd-none' }}" id="accordion-discussion">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-discussion" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Discussion') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-discussion" data-bs-parent="#accordion-discussion">
		                        <div class="form-check mb-2">
		                        	<input type="hidden" name="data[Page][comment]" id="ContentComment_" value="0">
		                            <input type="checkbox" name="data[Page][comment]" class="form-check-input" id="ContentComment" value="1" {{ old('data.Page.comment') == 1 ? 'checked="checked"' : '' }}>
		                            <label class="form-check-label" for="ContentComment">{{ __('Allow comments.') }}</label>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XSlug {{ $screenOption['Slug']['visibility'] ? '' : 'd-none' }}" id="accordion-slug">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-slug" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Slug') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-slug" data-bs-parent="#accordion-slug">
		                        <div class="form-group">
			                        <label for="slug">{{ __('Slug') }}</label>
			                        <input type="text" name="data[Page][slug]" class="form-control slug" id="slug" value="{{ old('data.Page.slug') }}" readonly>
			                        @error('data.Page.slug')
										<p class="text-danger">
											{{ $message }}
										</p>
									@enderror
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XAuthor {{ $screenOption['Author']['visibility'] ? '' : 'd-none' }}" id="accordion-author">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-author" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Author') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-author" data-bs-parent="#accordion-author">
		                        <div class="form-group">
			                        <label for="ContentUserId">{{ __('User') }}</label>
			                        <select name="data[Page][user_id]" class="form-control default-select" id="ContentUserId">
			                        	@forelse($users as $user)
				                        	<option value="{{ $user->id }}" {{ old('data.Page.user_id') == $user->id ? 'selected="selected"' : '' }}>{{ $user->full_name }}</option>
			                        	@empty
			                        	@endforelse
			                        </select>
		                        </div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XSeo {{ $screenOption['Seo']['visibility'] ? '' : 'd-none' }}" id="accordion-seo">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-seo" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Seo') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-seo" data-bs-parent="#accordion-seo">
		                    	<div class="row">
		                        	<div class="col-md-12 form-group">
		                        		<label for="ContentSeoPageTitle">{{ __('Page Title') }}</label>
		                        		<input type="text" name="data[PageSeo][page_title]" class="form-control" id="ContentSeoPageTitle" placeholder="{{ __('Page Title') }}" maxlength="255" value="{{ old('data.PageSeo.page_title') }}">
		                        	</div>
		                        	<div class="col-md-6 form-group">
		                        		<label for="ContentSeoMetaKeywords">{{ __('Keywords') }}</label>
		                        		<input type="text" name="data[PageSeo][meta_keywords]" class="form-control" id="ContentSeoMetaKeywords" placeholder="{{ __('Enter meta keywords') }}" maxlength="255" value="{{ old('data.PageSeo.meta_keywords') }}">
		                        	</div>
		                        	<div class="col-md-6 form-group">
		                        		<label for="ContentSeoMetaDescriptions">{{ __('Descriptions') }}</label>
		                        		<textarea name="data[PageSeo][meta_descriptions]" class="form-control" id="ContentSeoMetaDescriptions" rows="5" placeholder="{{ __('Enter meta descriptions') }}">{{ old('data.PageSeo.meta_descriptions') }}</textarea>
		                        	</div>
		                        </div>
		                    </div>
		                </div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered" id="accordion-publish">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-publish" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Publish') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-publish" data-bs-parent="#accordion-publish">
		                    	<div class="row">
		                    		<div class="col-md-12 form-group">
		                    			<label for="Status"><i class="fa fa-key"></i> {{ __('Status:') }}</label>
		                    			<select name="data[Page][status]" id="Status" class="default-select form-control">
		                    				<option value="1" {{ old('data.Page.status') == 1 ? 'selected="selected"' : '' }}>{{ __('Published') }}</option>
		                    				<option value="2" {{ old('data.Page.status') == 2 ? 'selected="selected"' : '' }}>{{ __('Draft') }}</option>
		                    				<option value="4" {{ old('data.Page.status') == 4 ? 'selected="selected"' : '' }}>{{ __('Private') }}</option>
		                    				<option value="5" {{ old('data.Page.status') == 5 ? 'selected="selected"' : '' }}>{{ __('Pending') }}</option>
		                    			</select>
		                    		</div>
		                    		<div class="col-md-12 form-group">
		                    			<label for="ContentVisibility"><i class="fa fa-eye"></i> {{ __('Visibility:') }}</label>
		                    			<select name="data[Page][visibility]" id="ContentVisibility" class="default-select form-control">
		                    				<option value="Pu" {{ old('data.Page.visibility') == 'Pu' ? 'selected="selected"' : '' }}>{{ __('Public') }}</option>
		                    				{{-- <option value="PP" {{ old('data.Page.visibility') == 'PP' ? 'selected="selected"' : '' }}>{{ __('Password protected') }}</option> --}}
		                    				<option value="Pr" {{ old('data.Page.visibility') == 'Pr' ? 'selected="selected"' : '' }}>{{ __('Private') }}</option>
		                    			</select>
		                    		</div>
		                    		<div class="col-md-12 form-group {{ old('data.Page.visibility') == 'PP' ? '' : 'd-none' }}" id="PublicPasswordTextbox" >
		                    			<label for="ContentPassword">{{ __('Password') }}</label>
		                    			<input type="password" name="data[Page][password]" class="form-control" id="ContentPassword" placeholder="{{ __('Enter Password') }}" value="{{ old('data.Page.password') }}">
		                    		</div>
		                    		<div class="col-md-12 form-group" id="PublicPasswordTextbox">
		                    			<label for="PublishDateTimeTextbox"><i class="fa fa-calendar"></i> {{ __('Published on:') }}</label>
		                    			<input type="text" name="data[Page][publish_on]" class="datetimepicker form-control" id="PublishDateTimeTextbox"  value="{{ old('data.Page.publish_on', date('Y-m-d')) }}">
		                    		</div>
		                    		<div class="col-md-12">
		                    			<button type="submit" class="btn btn-primary">{{ __('Publish') }}</button>
		                    		</div>
		                    	</div>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XPageAttributes {{ $screenOption['PageAttributes']['visibility'] ? '' : 'd-none' }}" id="accordion-page-attributes">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-page-attributes" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Page Attributes') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-page-attributes" data-bs-parent="#accordion-page-attributes">
		                    	<div class="form-group">
			                        <label for="ContentParentId">{{ __('Parent') }}</label>
			                        <select name="data[Page][parent_id]" class="default-select form-control" id="ContentParentId">
			                        	<option value="">({{ __('No parent') }})</option>
			                        	@forelse($pages as $page)
			                        		<option value="{{ $page->id }}" {{ old('data.Page.parent_id') == $page->id ? 'selected="selected"' : '' }}>{{ $page->title }}</option>
			                        	@empty
			                        	@endforelse
			                        </select>
		                    	</div>
		                    </div>
		                </div>
					</div>
		            <div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XPageType {{ $screenOption['PageType']['visibility'] ? '' : 'd-none' }}" id="accordion-page-type">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-page-type" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Page Type') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-page-type" data-bs-parent="#accordion-page-type">
		                    	<div class="form-group">
			                        <label for="ContentContentType">{{ __('Content Type') }}</label>
			                        <select name="data[Page][content_type]" class="default-select form-control" id="ContentContentType">
			                        	<option value="Page" {{ old('data.Page.content_type') == 'Page' ? 'selected="selected"' : '' }}>{{ __('Page') }}</option>
			                        	<option value="Widget" {{ old('data.Page.content_type') == 'Widget' ? 'selected="selected"' : '' }}>{{ __('Widget') }}</option>
			                        </select>
		                    	</div>
		                    </div>
		                </div>
					</div>
		            <div class="col-md-12">
						<div class="card accordion accordion-rounded-stylish accordion-bordered XFeaturedImage {{ $screenOption['FeaturedImage']['visibility'] ? '' : 'd-none' }}" id="accordion-author">
		                    <div class="card-header justify-content-start accordion-header" data-bs-toggle="collapse" data-bs-target="#with-author" aria-expanded="true">
		                        <h4 class="card-title">{{ __('Featured Image') }}</h4>
		                        <span class="accordion-header-indicator"></span>
		                    </div>
		                    <div class="accordion__body p-4 collapse show" id="with-author" data-bs-parent="#accordion-author">
		                        <div class="featured-img-preview img-parent-box">

									<img src="{{ asset('images/noimage.jpg') }}" class="avatar mb-1 img-for-onchange" alt="{{ __('Image') }}" width="100px" height="100px" title="{{ __('Image') }}">

									<input type="hidden" name="data[PageMeta][0][title]" value="ximage" id="ContentMeta0Title">
									<div class="form-file">
										<input type="file" name="data[PageMeta][0][value]" class="ps-2 form-control img-input-onchange" accept=".png, .jpg, .jpeg"  id="PageMeta0Value" >
									</div>
                               </div>
                                @error('data.PageMeta.0.value')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
		                    </div>
		                </div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

@push('inline-scripts')
<script>
	'use strict';
	var screenOptionArray = '<?php echo json_encode($screenOption) ?>';
</script>
@endpush

@endsection

