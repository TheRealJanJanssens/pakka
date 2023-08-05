@if($item->children()->count() > 0)
    <li>
        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-{{ $item->getOriginal('name') }}" data-collapse-toggle="dropdown-{{ $item->getOriginal('name') }}">
            <x-pakka::components.sidebar-icon :icon="$item->icon" />

            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>{{ $item->name }}</span>
            <x-phosphor-caret-down-bold sidebar-toggle-item class="w-4 h-4 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"/>
        </button>
        <ul id="dropdown-{{ $item->getOriginal('name') }}" class="hidden py-2 pl-2 space-y-2">
            @foreach($item->children()->get() as $child)
                @php($child = $child->localize())
                <x-pakka::components.sidebar-item :item="$child" />
            @endforeach
        </ul>
    </li>
@else
    <li>
        <a href="{{ $route }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
            <x-pakka::components.sidebar-icon :icon="$item->icon" />
            <span class="ml-3" sidebar-toggle-item>{{ $item->name }}</span>
        </a>
    </li>
@endif
