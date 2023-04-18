 @props(['name', 'label' => $name, 'placeholder', 'type' => 'text', 'bottom_label' => false])

 <div>
     <x-form.label name="{{ $label }}" />

     <input
         class="text-md px-3 py-2 rounded-lg w-full placeholder-gray-450 focus:outline-none border border-gray-150
  hover:border-blue-500 hover:shadow-blue-500"
         type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
         {{ $attributes(['value' => old($name)]) }}>

     @if ($bottom_label)
         <label name="{{ $label }}" class="text-sm text-gray-450 px-1">Username should be unique, min 3 symbols
         </label>
     @endif
     <x-form.error name="{{ $name }}" />
 </div>
