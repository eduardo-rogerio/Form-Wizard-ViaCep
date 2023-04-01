<div>
    <!-- component -->
    <!-- This is an example component -->
    <div class="max-w-2xl mx-auto bg-white p-16">

        <form wire:submit.prevent="submit">
            {{ $this->form }}
            <button type="submit"
                    class=" my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
        </form>

        <p class="mt-5">These input field components is part of a larger, open-source library of Tailwind CSS
            components. Learn
            more by going to the official <a class="text-blue-600 hover:underline"
                                             href="https://flowbite.com/docs/getting-started/introduction/"
                                             target="_blank">Flowbite
                Documentation</a>.
        </p>
    </div>
</div>
