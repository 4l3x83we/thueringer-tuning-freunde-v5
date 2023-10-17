<x-mail-layout>
    {{ metaTags('', '', 'Neuer Gästebucheintrag', '') }}
    <h2 class="mt-6 text-xl text-gray-700 dark:text-gray-200">Hallo Heiko und Alex</h2>
    <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
        Zum Gästebucheintrag:
        <x-custom.links.button-link class="ml-2" href="{{ route('frontend.gaestebuch.index') }}" target="_blank">hier klicken</x-custom.links.button-link>
    </p>
    <table class="w-full border-0 my-4">
        <tr class="align-top">
            <th class="py-1 text-left w-1/3">Name:</th>
            <td class="py-1 w-2/3">{!! $gaestebuch->name !!}</td>
        </tr>
        <tr class="align-top">
            <th class="py-1 text-left w-1/3">E-Mail Adresse:</th>
            <td class="py-1 w-2/3">{!! $gaestebuch->email !!}</td>
        </tr>
        @if($gaestebuch->webseite)
        <tr class="align-top">
            <th class="py-1 text-left w-1/3">Webseite:</th>
            <td class="py-1 w-2/3"><x-custom.links.a-blank href="{!! $gaestebuch->webseite !!}" target="_blank" color="primary">{{ $gaestebuch->webseite }}</x-custom.links.a-blank></td>
        </tr>
        @endif
        @if($gaestebuch->facebook or $gaestebuch->tiktok or $gaestebuch->instagram)
        <tr class="align-top">
            <th class="py-1 text-left w-1/3">Social Media:</th>
            <td class="py-1 w-2/3">
                <div class="flex flex-wrap items-center gap-4">
                @if($gaestebuch->facebook)
                    <x-custom.links.a-blank href="{!! $gaestebuch->facebook !!}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                        </svg>
                    </x-custom.links.a-blank>
                @endif
                @if($gaestebuch->tiktok)
                    <x-custom.links.a-blank href="{!! $gaestebuch->tiktok !!}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                            <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
                        </svg>
                    </x-custom.links.a-blank>
                @endif
                @if($gaestebuch->instagram)
                    <x-custom.links.a-blank href="{!! $gaestebuch->instagram !!}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                        </svg>
                    </x-custom.links.a-blank>
                @endif
                </div>
            </td>
        </tr>
        @endif
        <tr class="align-top">
            <th class="py-1 text-left" colspan="2">Eintrag:</th>
        </tr>
        <tr class="align-top">
            <td class="py-1" colspan="2">
                {!! $gaestebuch->message !!}
            </td>
        </tr>
        <tr class="align-top"><td class="py-4" colspan="2"></td></tr>
        @if($gaestebuch->ip_adresse)
            @php
                $currentUserInfo = Stevebauman\Location\Facades\Location::get($gaestebuch->ip_adresse);
            @endphp
            @if($currentUserInfo)
                <tr class="align-top">
                    <th class="py-1 text-left w-1/3">IP Adresse:</th>
                    <td class="py-1 w-2/3">{{ $currentUserInfo->ip }}</td>
                </tr>
                <tr class="align-top">
                    <th class="py-1 text-left w-1/3">Land:</th>
                    <td class="py-1 w-2/3"><img src="https://flagsapi.com/{{ $currentUserInfo->countryCode }}/shiny/24.png" alt="{{ $currentUserInfo->countryCode }}"></td>
                </tr>
                <tr class="align-top">
                    <th class="py-1 text-left w-1/3">Bundesland:</th>
                    <td class="py-1 w-2/3">{{ $currentUserInfo->regionName }}</td>
                </tr>
                <tr class="align-top">
                    <th class="py-1 text-left w-1/3">Ort:</th>
                    <td class="py-1 w-2/3">{{ $currentUserInfo->zipCode.' '.$currentUserInfo->cityName }}</td>
                </tr>
                <tr class="align-top">
                    <td colspan="2">
                        <iframe class="mt-2" width="100%" height="150px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?hl=de&amp;q='.{{ $currentUserInfo->latitude.', '.$currentUserInfo->longitude }}.'&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </td>
                </tr>
            @endif
        @endif
    </table>

</x-mail-layout>
