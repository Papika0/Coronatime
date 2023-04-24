  <select name="language" id="language" class="bg-transparent border-none outline-none rounded-md pl-2"
      onchange="location = this.value;">
      <option value="" selected disabled hidden>
          @if (app()->getLocale() == 'en')
              {{ __('dashboard.english') }}
          @else
              {{ __('dashboard.georgian') }}
          @endif
      </option>
      <option value="{{ route('set.locale', 'en') }}">{{ __('dashboard.english') }}</option>
      <option value="{{ route('set.locale', 'ka') }}">{{ __('dashboard.georgian') }}</option>
  </select>
