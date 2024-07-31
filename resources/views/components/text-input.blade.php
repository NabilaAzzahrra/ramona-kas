@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-slate-200 focus:border-[#0C4B54] focus:ring-[#287d8a]  rounded-xl shadow-sm']) !!}>
