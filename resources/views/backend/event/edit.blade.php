@extends('backend.layouts.admin.admin')

@section('title', 'Event')

@section('content')
<section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('event.update', $event->slug )}}"
                  method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('backend.event.partials.form', ['header' => 'Edit event <span class="text-primary">('.($event->title).')</span>'])
            </form>
        </div>
</section>
@stop

