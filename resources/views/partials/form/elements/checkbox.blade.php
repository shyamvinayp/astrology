@php
    $parsleyRules = isset($parsleyRules) && isset($parsleyRules[$field])?$parsleyRules[$field]:[];
    $attrs = $attrs??[];
    foreach ($parsleyRules as $k => $v) {
        $attrs["data-parsley-".$k] = $v;
    }
    $fieldType = $fieldType??'checkbox';
@endphp
<div class="checkbox {!! $extraCls ??null !!}} {!! $fieldType !!}">
    <label>
        {!! Form::$fieldType($field, (isset($chValue)?$chValue:null), (isset($checked) && $checked === true),
            array_merge(['class' => 'styled', 'disabled' => (isset($disabled) && $disabled === true)?'disabled':null], $attrs)
        ) !!}
        {!! $text??null!!}
    </label>
</div>

