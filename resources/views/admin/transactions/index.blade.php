<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Product Transactions') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($transactions as $transaction)
                    <div
                        class="item-card flex flex-row justify-between items-center bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105">
                        @if ($transaction->is_paid)
                            <svg width="100" height="100" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 496 496" xml:space="preserve" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path id="SVGCleanerId_0" style="fill:#12DB55;"
                                        d="M496,379.6c0,9.6-7.2,16.8-16.8,16.8H16.8c-9.6,0-16.8-7.2-16.8-16.8v-264 c0-9.6,7.2-16.8,16.8-16.8h462.4c9.6,0,16.8,7.2,16.8,16.8L496,379.6L496,379.6z">
                                    </path>
                                    <g>
                                        <path id="SVGCleanerId_0_1_" style="fill:#12DB55;"
                                            d="M496,379.6c0,9.6-7.2,16.8-16.8,16.8H16.8c-9.6,0-16.8-7.2-16.8-16.8v-264 c0-9.6,7.2-16.8,16.8-16.8h462.4c9.6,0,16.8,7.2,16.8,16.8L496,379.6L496,379.6z">
                                        </path>
                                    </g>
                                    <path style="fill:#0AC945;"
                                        d="M0,115.6c0-9.6,7.2-16.8,16.8-16.8h462.4c9.6,0,16.8,7.2,16.8,16.8v264.8c0,9.6-7.2,16.8-16.8,16.8">
                                    </path>
                                    <rect y="118.8" style="fill:#334449;" width="496" height="96.8"></rect>
                                    <polygon points="170.4,215.6 496,215.6 496,118.8 5.6,118.8 "></polygon>
                                    <path style="fill:#0CC69A;"
                                        d="M496,379.6c0,9.6-7.2,16.8-16.8,16.8H16.8c-9.6,0-16.8-7.2-16.8-16.8"></path>
                                    <path style="fill:#0BAF84;"
                                        d="M479.2,396.4c9.6,0,16.8-7.2,16.8-16.8h-44.8L479.2,396.4z">
                                    </path>
                                    <g>
                                        <path style="fill:#D4F9ED;"
                                            d="M177.6,264.4c0,3.2-2.4,5.6-5.6,5.6H52.8c-3.2,0-5.6-2.4-5.6-5.6l0,0c0-3.2,2.4-5.6,5.6-5.6H172 C175.2,258.8,177.6,261.2,177.6,264.4L177.6,264.4z">
                                        </path>
                                        <path style="fill:#D4F9ED;"
                                            d="M177.6,293.2c0,3.2-2.4,5.6-5.6,5.6H52.8c-3.2,0-5.6-2.4-5.6-5.6l0,0c0.8-3.2,3.2-5.6,5.6-5.6H172 C175.2,287.6,177.6,290,177.6,293.2L177.6,293.2z">
                                        </path>
                                        <path style="fill:#D4F9ED;"
                                            d="M154.4,322c0,3.2-2.4,5.6-5.6,5.6h-96c-2.4,0-4.8-2.4-4.8-5.6l0,0c0-3.2,2.4-5.6,5.6-5.6h96 C152,317.2,154.4,319.6,154.4,322L154.4,322z">
                                        </path>
                                    </g>
                                    <circle style="fill:#FFBC00;" cx="360" cy="300.4" r="60"></circle>
                                    <path style="fill:#FFAA00;"
                                        d="M360,240.4c-30.4,0-55.2,22.4-60,51.2l96.8,56.8c14.4-11.2,23.2-28,23.2-48 C420.8,266.8,393.6,240.4,360,240.4z">
                                    </path>
                                    <path style="fill:#F7B208;" d="M360,240.4c33.6,0,60,27.2,60,60s-27.2,60-60,60">
                                    </path>
                                    <g>
                                        <circle style="fill:#de1746;" cx="408" cy="300.4" r="60"></circle>
                                        <circle style="fill:#de1746;" cx="408" cy="300.4" r="60"></circle>
                                    </g>
                                    <path style="fill:#E00040;" d="M408,361.2c-33.6,0-60-27.2-60-60s27.2-60,60-60">
                                    </path>
                                    <path style="fill:#F97803;"
                                        d="M384,245.2c-21.6,9.6-36,30.4-36,55.2s15.2,46.4,36,55.2c21.6-9.6,36-30.4,36-55.2 S405.6,254,384,245.2z">
                                    </path>
                                    <path style="fill:#F76806;"
                                        d="M384,355.6c21.6-9.6,36-30.4,36-55.2s-15.2-46.4-36-55.2">
                                    </path>
                                </g>
                            </svg>
                        @else
                            <svg width="100" height="100" fill="#000000" height="200px" width="200px"
                                version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g>
                                            <g>
                                                <path
                                                    d="M502,92.5H10c-5.522,0-10,4.478-10,10v307c0,5.522,4.478,10,10,10h492c5.522,0,10-4.478,10-10v-307 C512,96.978,507.522,92.5,502,92.5z M492,399.5H20v-287h472V399.5z">
                                                </path>
                                                <path
                                                    d="M298.667,315.5c0,30.327,24.673,55,55,55c8.966,0,17.664-2.156,25.5-6.271c7.836,4.115,16.534,6.271,25.5,6.271 c30.327,0,55-24.673,55-55c0-30.327-24.673-55-55-55c-8.966,0-17.664,2.156-25.5,6.271c-7.836-4.115-16.534-6.271-25.5-6.271 C323.34,260.5,298.667,285.173,298.667,315.5z M404.819,295.32c-1.957-4.989-4.674-9.74-8.018-13.932 c2.559-0.589,5.193-0.889,7.866-0.889c19.299,0,35,15.701,35,35s-15.701,35.001-35,35.001c-2.673,0-5.308-0.3-7.866-0.889 C408.917,334.426,411.887,313.346,404.819,295.32z M379.167,291.562c6.033,6.428,9.5,14.956,9.5,23.938s-3.467,17.51-9.5,23.938 c-6.033-6.429-9.5-14.957-9.5-23.938C369.667,306.519,373.134,297.99,379.167,291.562z M352.659,333.349 c2.009,5.848,5.014,11.424,8.874,16.263c-2.558,0.588-5.193,0.888-7.866,0.888c-19.299,0-35-15.701-35-35s15.701-35,35-35 c2.673,0,5.308,0.3,7.866,0.889c-0.132,0.166-0.254,0.339-0.384,0.506C349.943,296.403,346.702,316.01,352.659,333.349z">
                                                </path>
                                                <path
                                                    d="M244.667,339.5h-178c-5.522,0-10,4.478-10,10c0,5.522,4.478,10,10,10h178c5.522,0,10-4.478,10-10 C254.667,343.978,250.189,339.5,244.667,339.5z">
                                                </path>
                                                <path
                                                    d="M244.667,282.5h-45c-5.522,0-10,4.478-10,10c0,5.522,4.478,10,10,10h45c5.522,0,10-4.478,10-10 C254.667,286.978,250.189,282.5,244.667,282.5z">
                                                </path>
                                                <path
                                                    d="M53.667,228.5c0,5.522,4.478,10,10,10h304c5.522,0,10-4.478,10-10c0-5.522-4.478-10-10-10h-304 C58.145,218.5,53.667,222.978,53.667,228.5z">
                                                </path>
                                                <path
                                                    d="M405.667,238.5h40c5.522,0,10-4.478,10-10c0-5.522-4.478-10-10-10h-40c-5.522,0-10,4.478-10,10 C395.667,234.022,400.145,238.5,405.667,238.5z">
                                                </path>
                                                <path
                                                    d="M60.667,197.5h61c5.522,0,10-4.478,10-10v-42c0-5.522-4.478-10-10-10h-61c-5.522,0-10,4.478-10,10v42 C50.667,193.022,55.145,197.5,60.667,197.5z M70.667,155.5h41v22h-41V155.5z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        @endif

                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Total Amount</p>
                            <h3 class="text-indigo-950 dark:text-indigo-200 text-xl font-bold">
                                {{ $transaction->total_amount }}</h3>
                        </div>
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Date</p>
                            <h3 class="text-indigo-950 dark:text-indigo-200 text-xl font-bold">
                                {{ $transaction->created_at }}</h3>
                        </div>
                        <div>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-2">Status</p>
                            @if ($transaction->is_paid)
                                <span
                                    class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-green-500 text-yellow-50">
                                    ACTIVE
                                </span>
                            @else
                                <span
                                    class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-orange-500 text-yellow-50">
                                    PENDING
                                </span>
                            @endif
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Student</p>
                            <h3 class="text-indigo-950 dark:text-indigo-200 text-xl font-bold">
                                {{ $transaction->user->name }}</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            {{-- $transaction masih ruang lingkup di forelse --}}
                            <a href="{{ route('admin.subscribe_transaction.show', $transaction) }}"
                                class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full transition-colors duration-300 hover:bg-indigo-600">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p>
                        Not yet Transaction
                    </p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
