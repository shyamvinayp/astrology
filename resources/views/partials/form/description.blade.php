    @php
    $field = ($field) ? $field: 'description';
    $text = ($text) ? $text: 'Description';
    $required = ($required) ? $required : false;
@endphp

<div class="form-group">
    <label for="description" class="col-form-label text-md-right">{{ __($text) }}</label>
    {!! Form::textarea($field , null, [
      'class' => 'form-control',
      'required'                      => $required,
      'data-parsley-trigger'          => 'change focusout',
      ]) !!}
</div>

<style>
    textarea.form-control {
        height: 118px;
    }
</style>
