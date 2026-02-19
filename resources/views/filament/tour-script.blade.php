@auth
<div
    id="tour-data"
    data-tour-completed="{{ auth()->user()->tour_completed ? '1' : '0' }}"
    data-tour-url="{{ url('/app/tour-completed') }}"
    data-csrf-token="{{ csrf_token() }}"
    style="display: none;"
></div>
@vite(['resources/js/tour.js'])
@endauth
