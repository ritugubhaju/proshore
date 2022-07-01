@extends('backend.layouts.admin.admin')

@section('title', 'Event')

@section('content')
    <section>
        <div class="section-body">
            <div class="card">
                <div class="card-head">
                    <header class="text-capitalize">Event</header>
                    <div class="tools">
                        <a class="btn btn-primary ink-reaction" href="{{ route('event.create') }}">
                            <i class="md md-add"></i>
                            Add
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('filter') }}" type="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4 pb-4">
                                <select name="filter" id="" class="form-control" style="position: relative;bottom: 40px;">
                                    <option disabled selected> -- Filter -- </option>
                                    <option value="finish_event" @if (isset($filter) && $filter == 'finish_event') selected @endif>Finished
                                        events</option>
                                    <option value="upcoming_event" @if (isset($filter) && $filter == 'upcoming_event') selected @endif>
                                        Upcoming events</option>
                                    <option value="finished_seven_event" @if (isset($filter) && $filter == 'finished_seven_event') selected @endif>
                                        Finished events of the last 7 days</option>
                                    <option value="upcoming_seven_event" @if (isset($filter) && $filter == 'upcoming_seven_event') selected @endif>
                                        Upcoming events within 7 days</option>
                                </select>
                            </div>
                            <div  class="col-sm-4">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </form>
                    <table id="datatable" class="table table-hover display">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Title</th>
                                <th width="20%" class="text-center">Start Date</th>
                                <th width="20%" class="text-center">End Date</th>
                                <th width="20%" class="text-center">Description</th>
                                <th width="20%" class="text-center">Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @each('backend.event.partials.table', $event, 'event')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@push('styles')
    <style type="text/css">
        #accordion .card-head {
            cursor: n-resize;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('backend/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('backend/js/libs/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({});

            $(document).on('click', '.deleteRecord', function(e) {
                if (!confirm("Do you really want to do this?")) {
                    return false;
                }
                e.preventDefault();
                var id = Number($(this).data('id'));
                var token = $("meta[name='csrf-token']").attr("content");

                $.ajax({
                    url: "event/delete/" + id,
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });

            });
        });
    </script>
    <script></script>
@endpush
