<?php $page = 'calendar'; ?>
@extends('layout.mainlayout')
@section('content')
    <div class="page-wrapper">
        <div class="content">
            {{-- <div class="page-header">
                <div class="add-item d-flex">
                    <div class="page-title">
                        <h4>Calendar</h4>
                        <h6>Manage Your calendar</h6>
                    </div>
                </div>
                <ul class="table-top-head">
                    <li class="me-2">
                        <div class="input-icon-end position-relative">
                            <input type="text" class="date-range bookingrange fs-14 form-control py-1 ps-2 pe-4 fs-14"
                                placeholder="dd/mm/yyyy - dd/mm/yyyy">
                            <span class="input-icon-addon">
                                <i class="ti ti-chevron-down ms-1"></i>
                            </span>
                        </div>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                src="{{ URL::asset('build/img/icons/pdf.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                src="{{ URL::asset('build/img/icons/excel.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
                                class="ti ti-refresh"></i></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                                class="ti ti-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="page-btn">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_event"><i
                            class="ti ti-circle-plus me-1"></i>Create</a>
                </div>
            </div> --}}

            <div class="row">

                <!-- Calendar Sidebar -->
                <div class="col-xxl-3 col-xl-4">
                    <div class="card">
                        <div class="card-body p-3">
                            {{-- <div class="border-bottom pb-2 mb-4">
                                <div class="datepic"></div>
                            </div> --}}

                            <!-- Event -->
                            {{-- <div class="border-bottom pb-4 mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h5>Event </h5>
                                    <a href="#" class="text-secondary" data-bs-toggle="modal"
                                        data-bs-target="#add_event"><i
                                            class="ti ti-square-rounded-plus-filled fs-16"></i></a>
                                </div>
                                <p class="fs-12 mb-2">Drag and drop your event or click in the calendar</p>
                                <div id='external-events'>
                                    <div class="fc-event bg-success-transparent mb-1"
                                        data-event='{ "title": "Team Events" }'
                                        data-event-classname="bg-transparent-success">
                                        <i class="ti ti-square-rounded text-success me-2"></i>Team Events
                                    </div>
                                    <div class="fc-event bg-warning-transparent mb-1"
                                        data-event='{ "title": "Team Events" }'
                                        data-event-classname="bg-transparent-warning">
                                        <i class="ti ti-square-rounded text-warning me-2"></i>Work
                                    </div>
                                    <div class="fc-event bg-danger-transparent mb-1" data-event='{ "title": "External" }'
                                        data-event-classname="bg-transparent-danger">
                                        <i class="ti ti-square-rounded text-danger me-2"></i>External
                                    </div>
                                    <div class="fc-event bg-cyan-transparent mb-1" data-event='{ "title": "Projects" }'
                                        data-event-classname="bg-transparent-skyblue">
                                        <i class="ti ti-square-rounded text-cyan me-2"></i>Projects
                                    </div>
                                    <div class="fc-event bg-pink-transparent mb-1" data-event='{ "title": "Applications" }'
                                        data-event-classname="bg-transparent-purple">
                                        <i class="ti ti-square-rounded text-pink me-2"></i>Applications
                                    </div>
                                    <div class="fc-event bg-info-transparent mb-0" data-event='{ "title": "Desgin" }'
                                        data-event-classname="bg-transparent-info">
                                        <i class="ti ti-square-rounded text-info me-2"></i>Desgin
                                    </div>
                                </div>
                            </div> --}}
                            <!-- /Event -->

                            <!-- Upcoming Event -->
                            <div class="border-bottom pb-2 mb-4">
                                <h5 class="mb-2">Upcoming Events<span
                                        class="badge badge-success rounded-pill ms-2">15</span>
                                </h5>
                                <div class="border-start border-purple border-3 mb-3">
                                    <div class="ps-3">
                                        <h6 class="fw-medium mb-1">Meeting with Team Dev</h6>
                                        <p class="fs-12"><i class="ti ti-calendar-check text-info me-2"></i>15 Mar 2025</p>
                                    </div>
                                </div>
                                <div class="border-start border-pink border-3 mb-3">
                                    <div class="ps-3">
                                        <h6 class="fw-medium mb-1">Design System With Client</h6>
                                        <p class="fs-12"><i class="ti ti-calendar-check text-info me-2"></i>24 Mar 2025</p>
                                    </div>
                                </div>
                                <div class="border-start border-success border-3 mb-3">
                                    <div class="ps-3">
                                        <h6 class="fw-medium mb-1">UI/UX Team Call</h6>
                                        <p class="fs-12"><i class="ti ti-calendar-check text-info me-2"></i>28 Mar 2025</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /Upcoming Event -->

                        </div>
                    </div>

                </div>
                <!-- /Calendar Sidebar -->

                <div class="col-xxl-9 col-xl-8 theiaStickySidebar">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar-1"></div>
                        </div>
                    </div>
                </div>


                <!-- Event Modal -->
                <div class="modal fade" id="event_modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header modal-bg">
                                <div class="modal-title text-gray-9"><span id="eventTitle"></span></div>
                                <button type="button" class="btn-close p-0 custom-btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="ti ti-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="d-flex align-items-center fw-medium text-black mb-3"><i
                                        class="ti ti-calendar-check text-default me-2"></i><span id="eventDate">26
                                        Jul,2024 to 31 Jul,2024</span></p>
                                <p class="d-flex align-items-center fw-medium text-black mb-3"><i
                                        class="ti ti-clock text-default me-2"></i><span id="eventTime">11:00 AM to 12:15
                                        PM</span></p>
                                <p class="d-flex align-items-center fw-medium text-black mb-3"><i
                                        class="ti ti-map-pin-bolt text-default me-2"></i><span id="eventLocation">Las
                                        Vegas, US</span></p>
                                <p class="d-flex align-items-center fw-medium text-black mb-0"><i
                                        class="ti ti-note text-default me-2"></i><span id="eventDescription">A recurring
                                        or repeating event is simply any event that you will occur more than once on your
                                        calendar.</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Event Modal -->

            </div>
        </div>
        <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
            <p class="mb-0">2014 - 2025 &copy; DreamsPOS. All Right Reserved</p>
            <p>Designed &amp; Developed by <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ($('#calendar-1').length > 0) {
                var todayDate = moment().startOf('day');
                var YM = todayDate.format('YYYY-MM');
                var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                var TODAY = todayDate.format('YYYY-MM-DD');
                var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                var calendarEl = document.getElementById('calendar-1');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    initialView: 'dayGridMonth',



                    // events: [{
                    //         title: 'Meeting with Team Dev',
                    //         className: 'badge badge-pink-transparent',
                    //         backgroundColor: '#FFEDF6',
                    //         textColor: "#FD3995",
                    //         start: new Date($.now() - 168000000).toJSON().slice(0, 10),
                    //         end: new Date($.now() - 168000000).toJSON().slice(0, 10),
                    //     },
                    //     {
                    //         title: 'UI/UX Team...',
                    //         className: 'badge badge-secondary-transparent',
                    //         backgroundColor: '#EDF2F4',
                    //         textColor: "#0C4B5E",
                    //         start: new Date($.now() + 338000000).toJSON().slice(0, 10)
                    //     },
                    //     {
                    //         title: 'Data Update...',
                    //         className: 'badge badge-purple-transparent',
                    //         backgroundColor: '#F7EEF9',
                    //         textColor: "#AB47BC",
                    //         start: new Date($.now() - 338000000).toJSON().slice(0, 10)
                    //     },
                    //     {
                    //         title: 'Meeting with Team Dev',
                    //         className: 'badge badge-dark-transparent',
                    //         backgroundColor: '#E8E9EA',
                    //         textColor: "#212529",
                    //         start: new Date($.now() + 68000000).toJSON().slice(0, 10)
                    //     },
                    //     {
                    //         title: 'Design System',
                    //         className: 'badge badge-danger-transparent',
                    //         backgroundColor: '#FAE7E7',
                    //         textColor: "#E70D0D",
                    //         start: new Date($.now() + 88000000).toJSON().slice(0, 10)
                    //     },
                    // ],
                    headerToolbar: {
                        start: 'today prev,next',
                        end: 'dayGridMonth,dayGridWeek,dayGridDay',
                        center: 'title'
                    },

                    events: {
                        url: '{{ route('calendar.orders') }}',
                        method: 'GET',
                        failure: function() {
                            alert('There was an error while fetching orders!');
                        }

                    },

                    eventClick: function(info) {

                        showOrderDetails(info.event);
                        // Open modal
                        // $('#event_modal').modal('show');

                        // // Populate modal with event details
                        // document.getElementById('eventTitle').innerText = info.event.title;
                    },
                    editable: true,
                    droppable: true, // Enable drag and drop
                    drop: function(info) {
                        // If the event is dropped, do something here (optional)
                        console.log('Event dropped');
                    },
                    eventReceive: function(info) {
                        // When event is dropped on calendar
                        console.log('Event added', info.event.title);
                    }
                });

                calendar.render();
            }

            function showOrderDetails(event) {
                // Populate modal with event details
                document.getElementById('eventTitle').innerText = event.title;
                document.getElementById('eventDate').innerText = event.start.toLocaleDateString() + (event.end ?
                    ' to ' + event.end.toLocaleDateString() : '');
                document.getElementById('eventTime').innerText = event.start.toLocaleTimeString() + (event.end ?
                    ' to ' + event.end.toLocaleTimeString() : '');
                document.getElementById('eventLocation').innerText = event.extendedProps.location || 'N/A';
                document.getElementById('eventDescription').innerText = event.extendedProps.description ||
                    'No description available.';

                // Open modal
                $('#event_modal').modal('show');
            }
        });
    </script>
@endsection
