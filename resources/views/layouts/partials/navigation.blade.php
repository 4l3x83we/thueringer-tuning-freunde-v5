<div>
<section class="bg-gray-200 border-b border-gray-300 dark:border-gray-600 dark:bg-gray-900 hidden xl:block">
    <div class="flex flex-wrap justify-between items-center mx-auto py-2 px-4">
        <div class="flex items-center" serv>
            <a href="mailto:{{ env('TTF_EMAIL') }}" class="inline-flex items-center">
                <svg class="w-4 h-4 text-primary-500 hover:text-primary-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 2-8.4 7.05a1 1 0 0 1-1.2 0L1 2m18 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1m18 0v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2"/>
                </svg>
                <span class="ml-2 text-sm hover:text-primary-600">{{ env('TTF_EMAIL') }}</span>
            </a>
        </div>
        <div class="flex items-center">
            <a href="{{ env('TTF_INSTAGRAM') }}" class="mr-4" target="_blank">
                <svg class="w-4 h-4 text-[#E4405F] hover:text-[#e4407a]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                </svg>
            </a>
            <a href="{{ env('TTF_FACEBOOK') }}" class="mr-4" target="_blank">
                <svg class="w-4 h-4 text-[#1877F2] hover:text-[#189bf2]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            {{--<a href="{{ env('TTF_ANDROID') }}" target="_blank">
                <svg class="w-4 h-4 text-[#3DDC84] hover:text-[#3ddc6a]" role="img" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.523 15.3414c-.5511 0-.9993-.4486-.9993-.9997s.4483-.9993.9993-.9993c.5511 0 .9993.4483.9993.9993.0001.5511-.4482.9997-.9993.9997m-11.046 0c-.5511 0-.9993-.4486-.9993-.9997s.4482-.9993.9993-.9993c.5511 0 .9993.4483.9993.9993 0 .5511-.4483.9997-.9993.9997m11.4045-6.02l1.9973-3.4592a.416.416 0 00-.1521-.5676.416.416 0 00-.5676.1521l-2.0223 3.503C15.5902 8.2439 13.8533 7.8508 12 7.8508s-3.5902.3931-5.1367 1.0989L4.841 5.4467a.4161.4161 0 00-.5677-.1521.4157.4157 0 00-.1521.5676l1.9973 3.4592C2.6889 11.1867.3432 14.6589 0 18.761h24c-.3435-4.1021-2.6892-7.5743-6.1185-9.4396"/>
                </svg>
            </a>--}}
        </div>
    </div>
</section>
<header class="sticky top-0 w-full z-50" id="header">
    <nav class="bg-gray-100 dark:bg-gray-700 border-b border-primary-500 drop-shadow-lg py-2.5">
        <div x-data="{showMenu : false}" class="flex flex-wrap items-center justify-between mx-auto">
            <a href="{{ url('/') }}"  class="flex items-center px-4 group">
                <div class="flex flex-col leading-none text-success-500 transition-colors duration-300 group-hover:text-primary-500 racingSans">
                    <div class="text-sm xl:text-lg">Thüringer Tuning Freunde</div>
                    <div class="text-xs xl:text-sm text-right">
                        <span class="text-primary-500 transition-colors duration-300 group-hover:text-success-500">Marken offener </span>Tuningclub
                    </div>
                </div>
            </a>
            <div class="flex items-center xl:order-2 px-4">
                <div class="hidden md:block">
                <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-4 h-4 xl:w-5 xl:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-4 h-4 xl:w-5 xl:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div id="tooltip-toggle" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                    Dark Mode
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                </div>
                <div class="flex items-center mx-1 lg:mx-3">
                    <div class="py-2" x-data="{open: false}" @click="open = !open" @click.outside="open = false" x-cloak>
                        <div class="relative flex items-center space-x-1 cursor-pointer text-sm font-medium">
                            @guest
                                @if(Route::has('login'))
                                <div>
                                    <a href="{{ route('login') }}" class="hover:text-primary-500" data-tooltip-target="login-toggle">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-in-right w-4 xl:w-5 h-4 xl:h-5" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                        </svg>
                                    </a>
                                    <div id="login-toggle" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                        Login
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>
                                @endif
                            @else
                                <div>
                                    @if(auth()->user()->teams->photo_id)
                                        <img src="{{ auth()->user()->teams->profilBild() }}" alt="{{ auth()->user()->teams->vorname }}" class="w-6 xl:w-8 h-6 xl:h-8 object-cover object-center drop-shadow-xl rounded-full">
                                    @else
                                        <div class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden  drop-shadow-xl bg-gray-100 rounded-full dark:bg-gray-800">
                                            <span class="font-medium text-gray-600 dark:text-gray-300">{{ teamInitial(auth()->user()->teams) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="origin-top-right absolute top-12 right-0 rounded shadow-xl bg-gray-100 dark:bg-gray-800" x-show="open" x-cloak>
                                    <div class="px-4 py-3">
                                        <span class="block text-sm text-gray-900 dark:text-white">{{ auth()->user()->teams->fullname() }}</span>
                                        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->teams->email }}</span>
                                    </div>
                                    <ul class="pb-1" role="none">
                                        <li>
                                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('intern.mitglieder.show', auth()->user()->teams->slug) }}" >
                                                {{ __('Profil') }}
                                            </a>
                                        </li>
                                        @hasanyrole('member|admin|super_admin')
                                        <li><a href="{{ route('intern.pdf.geburtstagsliste') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Geburtstagsliste</a></li>
                                        <li><a href="{{ route('intern.pdf.telefonliste') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Telefonliste</a></li>
                                        <li><a href="{{ route('intern.pdf.satzung') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Satzung</a></li>
                                        @endhasanyrole
                                        @hasanyrole('member|admin|super_admin|garage')
                                        <li>
                                            <a href="{{ route('intern.calendar.index') }}" role="menuitem" class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Kalender</a>
                                        </li>
                                        @endhasanyrole
                                        @hasanyrole('super_admin|admin')
                                            <hr class="my-2 border-primary-500">
                                            <h6 class="px-4 py-2 font-bold cursor-default text-gray-900 dark:text-white">Adminmenü</h6>
                                            <li>
                                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('intern.annahme.index') }}" >
                                                    {{ __('Anträge') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('intern.activityLog.index') }}" >
                                                    {{ __('Aktivitätsprotokoll') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('intern.mitglieder.index') }}" >
                                                    {{ __('Mitglieder') }}
                                                </a>
                                            </li>
                                            @hasrole('super_admin')
                                                <li>
                                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('intern.zahlungen.index') }}" >
                                                        {{ __('Zahlungen') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('intern.rollen.index') }}" >
                                                        {{ __('Rollen') }}
                                                    </a>
                                                </li>
                                            @endhasrole
                                            <hr class="my-2 border-primary-500">
                                        @endhasanyrole
                                        <li>
                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
                <button @click="showMenu = !showMenu" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="items-center justify-between w-full xl:flex xl:w-auto xl:order-1 bg-gray-100 dark:bg-gray-700 px-4" :class="{ '' : showMenu, 'hidden' : !showMenu}" x-cloak>
                <ul class="flex flex-col text-base mt-4 xl:flex-row xl:gap-4 xl:mt-0">
                    <li>
                        @if(Request::is('ueber-uns'))
                            <a href="/#ueber-uns" class="block py-2 pl-3 pr-4 text-sm md:text-base text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900" aria-current="page">Über uns</a>
                        @else
                            <a href="/#ueber-uns" class="block py-2 pl-3 pr-4 text-sm md:text-base text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Über uns</a>
                        @endif
                    </li>
                    <li>
                        @if(Request::is('team'))
                            <a href="{{ route('frontend.team.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900" aria-current="page">Team</a>
                        @else
                            <a href="{{ route('frontend.team.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Team</a>
                        @endif
                    </li>
                    <li>
                        @if(Request::is('fahrzeuge'))
                            <a href="{{ route('frontend.fahrzeuge.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900" aria-current="page">Fahrzeuge</a>
                        @else
                            <a href="{{ route('frontend.fahrzeuge.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Fahrzeuge</a>
                        @endif
                    </li>
                    <li>
                        @if(Request::is('galerie'))
                            <a href="{{ route('frontend.galerie.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900" aria-current="page">Galerie</a>
                        @else
                            <a href="{{ route('frontend.galerie.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Galerie</a>
                        @endif
                    </li>
                    <li>
                        @if(Request::is('veranstaltungen'))
                            <a href="{{ route('frontend.veranstaltungen.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900" aria-current="page">Veranstaltungen</a>
                        @else
                            <a href="{{ route('frontend.veranstaltungen.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Veranstaltungen</a>
                        @endif
                    </li>
                    <li>
                        @if(Request::is('kontakt'))
                            <a href="{{ route('frontend.kontakt.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900" aria-current="page">Kontakt</a>
                        @else
                            <a href="{{ route('frontend.kontakt.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Kontakt</a>
                        @endif
                    </li>
                    <li>
                        @if(Request::is('antrag'))
                            <a href="{{ route('frontend.antrag.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900" aria-current="page">Antrag</a>
                        @else
                            <a href="{{ route('frontend.antrag.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Antrag</a>
                        @endif
                    </li>
                    <li>
                        @if(Request::is('gaestebuch'))
                            <a href="{{ route('frontend.gaestebuch.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900" aria-current="page">Gästebuch</a>
                        @else
                            <a href="{{ route('frontend.gaestebuch.index') }}"  class="block py-2 pl-3 pr-4 text-sm md:text-base text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Gästebuch</a>
                        @endif
                    </li>
                    {{--@hasanyrole('member|admin|super_admin')
                        <li>
                            <div x-data="{ dropdownMenu: false }" class="relative whitespace-nowrap">
                            @if(Request::is('intern*'))
                                <button @click="dropdownMenu = !dropdownMenu" class="flex items-center justify-between text-sm md:text-base py-2 pl-3 pr-4 text-white bg-primary-700 rounded xl:bg-transparent xl:text-primary-700 xl:p-0 xl:dark:text-primary-500 font-bold dark:hover:text-white hover:text-gray-900">Mitglieder Bereich
                                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                            @else
                                <button @click="dropdownMenu = !dropdownMenu" class="flex items-center justify-between text-sm md:text-base py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 xl:hover:bg-transparent xl:hover:text-primary-700 xl:p-0 dark:text-white xl:dark:hover:text-primary-500 dark:hover:bg-gray-700 dark:hover:text-white xl:dark:hover:bg-transparent dark:border-gray-700">Mitglieder Bereich
                                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg>
                                </button>
                            @endif
                            <!-- Dropdown menu -->
                            <div x-show="dropdownMenu" @click.outside="dropdownMenu = false" x-cloak class="z-10 absolute font-normal bg-gray-100 divide-y divide-gray-200 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400">
                                    --}}{{--<li>
                                        <a href="{{ route('frontend.fahrzeuge.create') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Neues Fahrzeug anlegen</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.galerie.album.create') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Neues Album anlegen</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.veranstaltungen.create') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Neue Veranstaltung anlegen</a>
                                    </li>--}}{{--
                                    <h6 class="px-4 py-2 font-bold  text-gray-900 dark:text-white">Interner Bereich</h6>
                                    <li><a href="{{ route('intern.pdf.geburtstagsliste') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Geburtstagsliste</a></li>
                                    <li><a href="{{ route('intern.pdf.telefonliste') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Telefonliste</a></li>
                                    --}}{{--                                    <li><a href="{{ route('intern.calendar.index') }}" class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Kalender</a></li>--}}{{--
                                    <li><a href="{{ route('intern.pdf.satzung') }}"  class="block px-4 py-2 text-gray-900 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white">Satzung</a></li>
                                </ul>
                            </div>
                            </div>
                        </li>
                    @endhasanyrole--}}
                </ul>
            </div>
        </div>
    </nav>
</header>
</div>
