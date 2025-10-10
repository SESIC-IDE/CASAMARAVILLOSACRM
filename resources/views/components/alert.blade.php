@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
