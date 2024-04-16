<footer class="bg-gray-100 dark:bg-gray-900 border-t border-primary-500 mt-16">
    <div class="mx-auto w-full container">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 px-4 py-6 lg:py-8 lg:grid-cols-4">
            <div>
                <h2 class="mb-6 text-lg text-gray-900 uppercase dark:text-white font-bold">Über uns</h2>
                <div class="text-gray-500 dark:text-gray-400 font-medium mb-4">
                    <p>Dezent getunt oder voll aufgemotzt. … jeder fährt das, was sein Geldbeutel hergibt. Bei uns ist jeder willkommen, der am Tuning oder einfach nur Schrauben Spaß hat.</p>
                </div>
                @hasanyrole('member|super_admin|admin')
                <div class="flex items-center gap-4">
                    <a href="{{ route('intern.pdf.geburtstagsliste') }}" class="bg-primary-500 hover:bg-primary-700 p-2 rounded hover:scale-110 duration-300" target="_blank" aria-label="zur Geburtstagsliste">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cake2 w-6 h-6 text-white" viewBox="0 0 16 16">
                            <path d="m3.494.013-.595.79A.747.747 0 0 0 3 1.814v2.683c-.149.034-.293.07-.432.107-.702.187-1.305.418-1.745.696C.408 5.56 0 5.954 0 6.5v7c0 .546.408.94.823 1.201.44.278 1.043.51 1.745.696C3.978 15.773 5.898 16 8 16c2.102 0 4.022-.227 5.432-.603.701-.187 1.305-.418 1.745-.696.415-.261.823-.655.823-1.201v-7c0-.546-.408-.94-.823-1.201-.44-.278-1.043-.51-1.745-.696A12.418 12.418 0 0 0 13 4.496v-2.69a.747.747 0 0 0 .092-1.004l-.598-.79-.595.792A.747.747 0 0 0 12 1.813V4.3a22.03 22.03 0 0 0-2-.23V1.806a.747.747 0 0 0 .092-1.004l-.598-.79-.595.792A.747.747 0 0 0 9 1.813v2.204a28.708 28.708 0 0 0-2 0V1.806A.747.747 0 0 0 7.092.802l-.598-.79-.595.792A.747.747 0 0 0 6 1.813V4.07c-.71.05-1.383.129-2 .23V1.806A.747.747 0 0 0 4.092.802l-.598-.79Zm-.668 5.556L3 5.524v.967c.311.074.646.141 1 .201V5.315a21.05 21.05 0 0 1 2-.242v1.855c.325.024.659.042 1 .054V5.018a27.685 27.685 0 0 1 2 0v1.964c.341-.012.675-.03 1-.054V5.073c.72.054 1.393.137 2 .242v1.377c.354-.06.689-.127 1-.201v-.967l.175.045c.655.175 1.15.374 1.469.575.344.217.356.35.356.356 0 .006-.012.139-.356.356-.319.2-.814.4-1.47.575C11.87 7.78 10.041 8 8 8c-2.04 0-3.87-.221-5.174-.569-.656-.175-1.151-.374-1.47-.575C1.012 6.639 1 6.506 1 6.5c0-.006.012-.139.356-.356.319-.2.814-.4 1.47-.575ZM15 7.806v1.027l-.68.907a.938.938 0 0 1-1.17.276 1.938 1.938 0 0 0-2.236.363l-.348.348a1 1 0 0 1-1.307.092l-.06-.044a2 2 0 0 0-2.399 0l-.06.044a1 1 0 0 1-1.306-.092l-.35-.35a1.935 1.935 0 0 0-2.233-.362.935.935 0 0 1-1.168-.277L1 8.82V7.806c.42.232.956.428 1.568.591C3.978 8.773 5.898 9 8 9c2.102 0 4.022-.227 5.432-.603.612-.163 1.149-.36 1.568-.591Zm0 2.679V13.5c0 .006-.012.139-.356.355-.319.202-.814.401-1.47.576C11.87 14.78 10.041 15 8 15c-2.04 0-3.87-.221-5.174-.569-.656-.175-1.151-.374-1.47-.575-.344-.217-.356-.35-.356-.356v-3.02a1.935 1.935 0 0 0 2.298.43.935.935 0 0 1 1.08.175l.348.349a2 2 0 0 0 2.615.185l.059-.044a1 1 0 0 1 1.2 0l.06.044a2 2 0 0 0 2.613-.185l.348-.348a.938.938 0 0 1 1.082-.175c.781.39 1.718.208 2.297-.426Z"/>
                        </svg>
                    </a>
                    <a href="{{ route('intern.pdf.telefonliste') }}" class="bg-primary-500 hover:bg-primary-700 p-2 rounded hover:scale-110 duration-300" target="_blank" aria-label="zur Telefonliste">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-telephone-plus w-6 h-6 text-white" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            <path fill-rule="evenodd" d="M12.5 1a.5.5 0 0 1 .5.5V3h1.5a.5.5 0 0 1 0 1H13v1.5a.5.5 0 0 1-1 0V4h-1.5a.5.5 0 0 1 0-1H12V1.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>
                    </a>
                    <a href="{{ route('intern.pdf.satzung') }}" class="bg-primary-500 hover:bg-primary-700 p-2 rounded hover:scale-110 duration-300" target="_blank" aria-label="zur Satzung">
                        <div class="w-6 h-6 text-white text-center text-2xl leading-none">§</div>
                    </a>
                </div>
                @endhasanyrole
            </div>
            <div>
                <h2 class="mb-6 text-lg text-gray-900 uppercase dark:text-white font-bold">Nützliche Links</h2>
                <ul class="text-gray-500 dark:text-gray-400 font-medium">
                    <li class="mb-2">
                        <a href="{{ route('frontend.index') }}" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4" aria-label="zur Startseite">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Startseite
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('frontend.kontakt.index') }}" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4" aria-label="zur Kontaktseite">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Kontakt
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('frontend.impressum') }}" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4" aria-label="zum Impressum">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Impressum / Disclaimer
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('frontend.datenschutz') }}" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4" aria-label="zum Datenschutz">
                            <svg class="w-2.5 h-2.5 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                            Datenschutz-Bestimmungen
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('frontend.cookie') }}" onclick="CCM.openWidget(); return false;" class="hover:underline hover:text-primary-500 hover:scale-105 duration-300 inline-flex items-center gap-4" aria-label="zum Cookie Einstellungen">
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
                        <span class="font-bold">E-Mail: </span><a class="hover:underline hover:text-primary-500" href="mailto:{{ env('TTF_EMAIL') }}" aria-label="Email Adresse {{ env('TTF_EMAIL') }}">{{ env('TTF_EMAIL') }}</a>
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
                    <div>Designed by <a class="hover:underline hover:text-primary-500" href="https://github.com/4l3x83we" target="_blank"{{ env('TTF_EMAIL') }} aria-label="Designed by 4l3x83we">4l3x83we</a> | <a class="hover:underline hover:text-primary-500" href="{{ env('TTF_URL') }}">{{ env('TTF_URL') }}</a></div>
                </div>
                <div class="flex mt-4 space-x-5 sm:justify-center sm:mt-0">
                    <a href="{{ env('TTF_INSTAGRAM') }}" target="_blank" aria-label="Instagram">
                        <svg class="w-5 h-5 text-[#E4405F] hover:text-[#e4407a]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    </a>
                    <a href="{{ env('TTF_FACEBOOK') }}" target="_blank" aria-label="Facebook">
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
