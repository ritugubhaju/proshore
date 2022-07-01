<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($event->title, 47) }}</td>
    <td class="text-center">{{ ($event->start_date)->format('Y-m-d') }}</td>
    <td class="text-center">{{ ($event->end_date)->format('Y-m-d') }}</td>
    <td class="text-center">{!! ($event->description) !!}</td>

    <td class="text-center">
        @if($event->start_date->format('Y-m-d') > date('Y-m-d'))
            <span class="badge" style="background-color: #419645">Upcoming</span>
        @elseif($event->end_date->format('Y-m-d') < date('Y-m-d'))
            <span class="badge" style="background-color: #f44336">Finished</span>
        @else
        <span class="badge" style="background-color: #eaee14">Live</span>

        @endif    </td>
    <td class="text-right">
        <a href="{{route('event.edit', $event->slug)}}" class="btn btn-flat btn-primary btn-xs" title="edit">
            <i class="glyphicon glyphicon-edit"></i>
        </a>

        <button type="button"  data-id="{{ $event->id }}"

            class="btn btn-flat btn-danger btn-xs item-delete deleteRecord" title="delete">
            <i class="glyphicon glyphicon-trash"></i>
        </button>
    </td>
</tr>

