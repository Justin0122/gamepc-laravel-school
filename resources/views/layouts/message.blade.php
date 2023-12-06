<div class="alert alert-{{$type}} alert-dismissible fade show session_info" role="alert">
    <strong>{{$status}}</strong>
    <span class="session_message">{{session('added') ?? session('removed')}} {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>