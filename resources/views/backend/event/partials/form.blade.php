@csrf
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header>{!! $header !!}</header>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" required
                                       value="{{ old('title', isset($event->title) ? $event->title : '') }}"/>

                                <label for="Name">Name</label>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('title') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group" id="demo-date">
                                    <div class="input-group-content">
                                        <input type="date" name="start_date" class="form-control datetime" min={{date('Y-m-d')}} required
                                               value="{{ old('start_date', isset($event->start_date) ? $event->start_date->format('Y-m-d') : '') }}">
                                        <label for= "Event Date">Start Date</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group" id="demo-date">
                                    <div class="input-group-content">
                                        <input type="date" name="end_date" class="form-control datetime" required min={{date('Y-m-d')}}
                                               value="{{ old('end_date', isset($event->end_date) ? $event->end_date->format('Y-m-d') : '') }}">
                                        <label for= "Event Date">End Date</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <strong>Description</strong>
                                <textarea name="description"
                                          class="ckeditor">{{old('description',isset($event->description)?$event->description : '')}}</textarea>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="" data-spy="affix" data-offset-top="50">
            <div class="panel-group" id="accordion1">
                <div class="card panel expanded">
                    <div class="card-head" data-toggle="collapse" data-parent="#accordion1" data-target="#accordion1-1">
                        <header>Publish</header>
                        <div class="tools">
                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="accordion1-1" class="collapse in">
                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <a class="btn btn-default btn-ink" href="{{ route('event.index') }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-info ink-reaction" value="Save">
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--end .panel-group -->
        </div>
    </div>
</div>
@section('scripts')
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
@endsection
