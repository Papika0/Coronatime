 @props(['name', 'label' => $name, 'placeholder', 'type' => 'text', 'bottom_label' => false])

 <div>
     @php
         $inputClass = 'text-md px-3 py-2 rounded-lg w-full placeholder-gray-450 focus:outline-none border border-gray-150 hover:border-blue-500 hover:shadow-blue-500';
         $inputValue = old($name);
         $hasError = $errors->has($name);
         $hasSuccess = $inputValue && !$hasError;
         if ($hasError) {
             $inputClass .= ' border-red-500';
         } elseif ($hasSuccess) {
             $inputClass .= ' border-green-500';
         }
     @endphp
     <x-form.label name="{{ $label }}" />

     <div class="relative">
         <input class="{{ $inputClass }}" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
             placeholder="{{ __("guest.$placeholder") }}" {{ $attributes(['value' => old($name)]) }}>

         @if ($hasSuccess)
             <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none w-5 h-5"
                 viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                 <path
                     d="M10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20ZM9.003 14L16.073 6.929L14.659 5.515L9.003 11.172L6.174 8.343L4.76 9.757L9.003 14Z"
                     fill="#249E2C" />
             </svg>
         @endif
     </div>
     @if ($bottom_label)
         <label name="{{ $label }}"
             class="text-sm text-gray-450 px-1">{{ __('guest.Username should be unique, min 3 symbols') }}
         </label>
     @endif

     <x-form.error name="{{ $name }}" />
 </div>
