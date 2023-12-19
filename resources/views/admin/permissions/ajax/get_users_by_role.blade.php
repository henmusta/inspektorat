<option value="">{{ __('Select User') }}</option>
@forelse($users as $user)
	<option value="{{ $user->id }}">{{ $user->full_name }}</option>
@empty
@endforelse