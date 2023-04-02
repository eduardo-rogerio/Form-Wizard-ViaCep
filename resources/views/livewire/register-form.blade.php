<div>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
    </form>

    <p class="mt-5 dark:text-white">These input field components is part of a larger, open-source library of Tailwind
        CSS
        components. Learn
        more by going to the official <a class="text-blue-600 hover:underline"
                                         href="https://flowbite.com/docs/getting-started/introduction/"
                                         target="_blank">Flowbite
            Documentation</a>.
    </p>

    @if($data)
        <div class="mt-5 dark:text-white">
            <h2 class="text-lg font-bold">Submitted Data</h2>
            <pre class="mt-2 p-4 bg-gray-100 dark:bg-gray-800 rounded-md">
                {{ var_export($data) }}
            </pre>
        </div>
    @endif

</div>
