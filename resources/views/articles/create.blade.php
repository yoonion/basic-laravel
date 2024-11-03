<!doctype html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <div class="container p-5">
        <h1 class="text-2xl">글쓰기</h1>
        <form action="/articles" method="post" class="mt-5">
            @csrf
            <input type="text" class="block w-full mb-2 rounded" name="text" value="{{ old('text') }}">
            @error('text')
                <p class="text-xs text-red-500 my-3">{{ $message }}</p>
            @enderror
            <button class="py-1 px-3 bg-black text-white rounded text-xs">저장하기</button>
        </form>

    </div>
</body>
</html>
