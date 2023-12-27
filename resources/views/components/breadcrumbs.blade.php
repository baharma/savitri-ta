<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        @foreach ($breadcrumbs as $item)
            @if ($item['status'] != 1)
                 <li class="breadcrumb-item"><a href="#">{{$item['name']}}</a></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{$item['name']}}</li>
            @endif
        @endforeach
       
    </ol>
</nav>
