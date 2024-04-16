@php use Carbon\Carbon; @endphp
<div>
    <div class="mx-auto max-w-screen-2xl px-4 py-8 lg:px-6 lg:py-10">
        <div class="grid grid-cols-1 gap-4">

            {{--@if(count($eventsAktuell) > 0)

                <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                    <h4 class="text-xl">Heutige Termine</h4>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        @foreach($eventsAktuell as $event)
                                <div class="col-span-2 lg:col-span-1 rounded p-2" style="background-color: {{ $event->event_background_color }}; color: {{ $event->event_text_color }}; border: 1px solid {{ $event->event_border_color }}">
                                    <a href="{{ route('intern.calendar.edit', $event->id) }}" class="text-white dark:text-white">
                                        <div class="flex flex-col">
                                            <span>{{ $event->title }}</span>
                                            <span>{!! $event->eventDate() !!}</span>
                                            <span>Beschreibung: {!! Str::limit($event->description, 255) !!}</span>
                                        </div>
                                    </a>
                                </div>
                        @endforeach
                    </div>

                </div>
            @endif--}}

            <div class="rounded bg-gray-50 p-4 shadow-xl group dark:bg-gray-900 flex flex-col gap-4">
                <div wire:ignore>
                    <div id="calendar"></div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('css')
    @once
        <style>
            .fc .fc-button {
                padding: 0.25rem 0.4rem;
            }
        </style>
    @endonce
@endpush

@push('js')
    @once
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6/index.global.min.js"></script>
        <script src="{{ asset('css/fullCalendar/Locales/de.global.min.js') }}"></script>
    @endonce
@endpush

<!-- FullCalendar -->
@push('scripts')
    @once
        <script type="module">
            let Calendar = null;
            document.addEventListener("DOMContentLoaded", function () {
                Calendar = FullCalendar.Calendar;
                let draggedEl = FullCalendar.draggable;

                let calendarEl = document.getElementById('calendar');
                let checkbox = document.getElementById('drop-remove');
                let containerEl = document.getElementById('external-events');
                let data = @this.
                events;
                @this.
                on(`refreshCalendar`, () => {
                    calendar.refresh();
                });

                function mobileCheck() {
                    return window.innerWidth < 768;
                }

                let calendar = new Calendar(calendarEl, {
                    aspectRatio: 2,
                    contentHeight: 600,
                    forceEventDuration: '18:00',
                    businessHours: [
                        {
                            daysOfWeek: [1, 2, 3, 4, 5],
                            startTime: '08:00',
                            endTime: '18:00',
                        },
                        {
                            daysOfWeek: [0, 6,],
                            startTime: '09:00',
                            endTime: '18:00',
                        }
                    ],
                    slotMinTime: '06:00:00',
                    slotMaxTime: '20:00:00',
                    slotDuration: '00:15:00',
                    slotLabelFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        omitZeroMinute: false,
                        meridiem: 'short'
                    },
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        meridiem: 'short',
                        hour12: false,
                    },
                    dayMaxEvents: true,
                    editable: true,
                    selectable: true,
                    eventDurationEditable: true,
                    displayEventTime: true,
                    displayEventEnd: true,
                    nextDayThreshold: '08:00:00',
                    droppable: true,
                    initialView: mobileCheck() ? 'timeGridDay' : 'timeGridWeek',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    locale: 'de',
                    timeZone: '{{ config('app.timezone') }}',
                    firstDay: '1',
                    weekNumbers: true,
                    nowIndicator: true,
                    events: JSON.parse(data),
                    dateClick(info) {
                        let date = info.dateStr;
                        let eventAdd = {
                            start: date,
                        };
                        @this.
                        addevent(eventAdd);
                    },
                    eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
                    eventResize: info => @this.eventResize(info.event, info.oldEvent),
                    eventClick: info => @this.eventClick(info.event),
                });
                calendar.render();
            });
        </script>
    @endonce
@endpush
