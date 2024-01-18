@foreach ($shopLogs as $log)
<tr>
    <td>{{ $log->created_at }}</td>
    <td>{{ $log->type }}</td>
    <td>{{ ucfirst($log->message) }}</td>
    <td>{{ $log->user->fullName }} ({{$log->user->email}})</td>
</tr>
@endforeach
