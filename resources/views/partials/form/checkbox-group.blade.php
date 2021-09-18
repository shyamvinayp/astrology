@php $attrs=$attrs??[] @endphp
<div class="input-group {!! $chExtraCls ??null !!}">
    @include('partials.form.elements.checkbox', ['text' => $text, 'field'=> $field, 'chValue' => (isset($chValue)?$chValue:null), 'checked' => ($checked??false), 'attrs' => $attrs])
</div>
