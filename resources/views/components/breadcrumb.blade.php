@props(['items'])

<nav class="text-sm mb-6 text-gray-500 dark:text-gray-400">
    <ol class="flex items-center space-x-2 space-x-reverse">

        @foreach($items as $item)

            @if(!$loop->last)
                <li>
                    <a href="{{ $item['url'] }}"
                       class="hover:text-brand transition">
                        {{ $item['title'] }}
                    </a>
                </li>
                <li>/</li>
            @else
                <li class="text-gray-700 dark:text-gray-200 font-medium">
                    {{ $item['title'] }}
                </li>
            @endif

        @endforeach

    </ol>
</nav>