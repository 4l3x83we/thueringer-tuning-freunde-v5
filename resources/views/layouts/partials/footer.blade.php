<footer class="bg-gray-100 dark:bg-gray-900 border-t border-primary-500 mt-16">
    <div class="mx-auto w-full container">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 px-4 py-6 lg:py-8 lg:grid-cols-4">
            <div>
                <h2 class="mb-6 text-lg text-gray-900 uppercase dark:text-white font-bold">Über uns</h2>
                <div class="text-gray-500 dark:text-gray-400 font-medium mb-4">
                    <p>Dezent getunt oder voll aufgemotzt. … jeder fährt das, was sein Geldbeutel hergibt. Bei uns ist jeder willkommen, der am Tuning oder einfach nur Schrauben Spaß hat.</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ env('TTF_INSTAGRAM') }}" class="bg-primary-500 hover:bg-primary-700 p-2 rounded hover:scale-110 duration-300" target="_blank">
                        <svg class="w-6 h-6 text-white" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    </a>
                    <a href="{{ env('TTF_FACEBOOK') }}" class="bg-primary-500 hover:bg-primary-700 p-2 rounded hover:scale-110 duration-300" target="_blank">
                        <svg class="w-6 h-6 text-white" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    {{--<a href="{{ env('TTF_ANDROID') }}" class="bg-primary-500 hover:bg-primary-700 p-2 rounded hover:scale-110 duration-300" target="_blank">
                        <svg class="w-6 h-6 text-white" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4483-.9993.9993-.9993c.5511 0 .9993.4483.9993.9993.0001.5511-.4482.9997-.9993.9997m-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4483.9993.9993 0 .5511-.4483.9997-.9993.9997m11.4045-6.02l1.9973-3.4592a.416.416 0 00-.1521-.5676.416.416 0 00-.5676.1521l-2.0223 3.503C15.5902 8.2439 13.8533 7.8508 12 7.8508s-3.5902.3931-5.1367 1.0989L4.841 5.4467a.4161.4161 0 00-.5677-.1521.4157.4157 0 00-.1521.5676l1.9973 3.4592C2.6889 11.1867.3432 14.6589 0 18.761h24c-.3435-4.1021-2.6892-7.5743-6.1185-9.4396"/>
                        </svg>
                    </a>--}}
                </div>
            </div>
            <div>
                <h2 class="mb-6 text-lg text-gray-900 uppercase dark:text-white font-bold">Nützliche Links</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <li class="mb-2">
                        <a href="" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Startseite
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Kontakt
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Impressum / Disclaimer
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Datenschutz-Bestimmungen
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" onclick="CCM.openWidget(); return false;" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Cookie Einstellungen
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-lg text-gray-900 uppercase dark:text-white font-bold">Unsere Vorteile</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <li class="mb-2">
                        <div class="inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            <span>Tuning</span>
                        </div>
                    </li>
                    <li class="mb-2">
                        <div class="inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            <span>Eigene Werkstatt</span>
                        </div>
                    </li>
                    <li class="mb-2">
                        <div class="inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            <span>Reifenservice</span>
                        </div>
                    </li>
                    <li class="mb-2">
                        <div class="inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            <span>Clubhaus</span>
                        </div>
                    </li>
                    <li class="mb-2">
                        <div class="inline-flex items-center gap-4">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            <span>Ersatzteile in kurzer Zeit</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-lg text-gray-900 uppercase dark:text-white font-bold">Kontaktiere uns</h2>
                <div class="text-gray-500 dark:text-gray-400 font-medium">
                    <address>
                        {{ env('TTF_NAME') }}<br>
                        {{ env('TTF_STRASSE') }}<br>
                        {{ env('TTF_ORT') }}<br><br>
                        <span class="font-bold">E-Mail: </span><a class="hover:underline hover:text-primary-500" href="mailto:{{ env('TTF_EMAIL') }}">{{ env('TTF_EMAIL') }}</a>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <div class="p-3 bg-gray-200 dark:bg-gray-700 dark:border-gray-600 border-t border-gray-300">
        <div class="mx-auto w-full container">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="flex flex-col items-start">
                    <div>&copy; Copyright <span class="font-bold text-primary-500">{{ env('TTF_NAME') }}</span>. Alle Rechte vorbehalten</div>
                    <div>Designed by <a class="hover:underline hover:text-primary-500" href="https://github.com/4l3x83we" target="_blank">4l3x83we</a> | <a class="hover:underline hover:text-primary-500" href="{{ env('TTF_URL') }}">{{ env('TTF_URL') }}</a></div>
                </div>
                <div class="flex mt-4 space-x-5 sm:justify-center sm:mt-0">
                    <a href="{{ env('TTF_INSTAGRAM') }}" target="_blank">
                        <svg class="w-5 h-5 text-[#E4405F] hover:text-[#e4407a]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    </a>
                    <a href="{{ env('TTF_FACEBOOK') }}" target="_blank">
                        <svg class="w-5 h-5 text-[#1877F2] hover:text-[#189bf2]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    {{--<a href="{{ env('TTF_ANDROID') }}" target="_blank">
                        <svg class="w-5 h-5 text-[#3DDC84] hover:text-[#3ddc6a]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4483-.9993.9993-.9993c.5511 0 .9993.4483.9993.9993.0001.5511-.4482.9997-.9993.9997m-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4483.9993.9993 0 .5511-.4483.9997-.9993.9997m11.4045-6.02l1.9973-3.4592a.416.416 0 00-.1521-.5676.416.416 0 00-.5676.1521l-2.0223 3.503C15.5902 8.2439 13.8533 7.8508 12 7.8508s-3.5902.3931-5.1367 1.0989L4.841 5.4467a.4161.4161 0 00-.5677-.1521.4157.4157 0 00-.1521.5676l1.9973 3.4592C2.6889 11.1867.3432 14.6589 0 18.761h24c-.3435-4.1021-2.6892-7.5743-6.1185-9.4396"/>
                        </svg>
                    </a>--}}
                </div>
            </div>
        </div>
    </div>
</footer>
