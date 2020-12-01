@if($item)
    <button class="btn btn-success"><i class="fa fa-save"></i> {{ __('Update') }}</button>
@else
    <button class="btn btn-primary"><i class="fa fa-plus"></i> {{ __('Create') }}</button>
@endif
