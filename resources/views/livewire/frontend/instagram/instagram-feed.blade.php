@php use Carbon\Carbon; @endphp
<div>
    @isset($instagram_feed)
        <div class="flex items-center justify-center py-4 flex-wrap gap-4" id="instagram">
            <h1 class="text-4xl">Die letzten 12 Instagram Feeds</h1>
        </div>
        <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($instagram_feed as $item)
                @if($item->type === 'image')
                    <div class="relative h-[426px] overflow-hidden galerie-item">
                        <a href="{{ $item->permalink }}" target="_blank">
                            <div class="galerie-wrap shadow-xl rounded group">
                                <div class="bg-gray-100/60 dark:bg-gray-900/60 overflow-hidden relative h-[306px] rounded-t m-0">
                                    <div class="absolute w-full h-full z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ), url('{{ $item->url }}') center no-repeat; background-size: auto, cover;"></div>
                                    <div class="filter-none z-20 relative w-[306px] h-[274px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $item->url }}') center no-repeat; background-size: 306px, 306px;"></div>
                                </div>
                                <div class="bg-gray-100/60 dark:bg-gray-900/60 overflow-hidden h-[90px] rounded-b-lg p-4 text-center">
                                    <h4 class="text-xl leading-none font-bold pb-0 h-11 group-hover:text-primary-500" data-tooltip-target="{{ $item->id }}">{!! strip_tags(Str::limit($item->caption, 30)) !!}</h4>
                                    <p class="p-0 m-0 text-gray-500/75 dark:text-white/75 font-medium text-sm">Instagram Feed vom: {!! Carbon::parse($item->timestamp)->format('d.m.Y H:i') !!}</p>
                                </div>
                            </div>
                            <div id="{{ $item->id }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {!! $item->caption !!}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                @elseif($item->type === 'carousel')
                    <div class="relative h-[426px] overflow-hidden galerie-item">
                        <a href="{{ $item->permalink }}" target="_blank">
                            <div class="galerie-wrap shadow-xl rounded group">
                                <div class="bg-gray-100/60 dark:bg-gray-900/60 overflow-hidden relative h-[306px] rounded-t m-0">
                                    <div class="swiper instagramSlide">
                                        <div class="swiper-wrapper">
                                            @foreach($item->children as $key => $child)
                                                <div class="swiper-slide">
                                                    <img src="{{ $child['url'] }}" alt="{{ $item->caption }}" class="w-full h-full">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-100/60 dark:bg-gray-900/60 overflow-hidden h-[90px] rounded-b-lg p-4 text-center">
                                    <h4 class="text-xl leading-none font-bold pb-0 h-11 group-hover:text-primary-500" data-tooltip-target="{{ $item->id }}">{!! strip_tags(Str::limit($item->caption, 30)) !!}</h4>
                                    <p class="p-0 m-0 text-gray-500/75 dark:text-white/75 font-medium text-sm">Instagram Feed vom: {!! Carbon::parse($item->timestamp)->format('d.m.Y H:i') !!}</p>
                                </div>
                            </div>
                            <div id="{{ $item->id }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {!! $item->caption !!}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                @elseif($item->type === 'video')
                    <div class="relative h-[426px] overflow-hidden galerie-item">
                        <a href="{{ $item->permalink }}" target="_blank">
                            <div class="galerie-wrap shadow-xl rounded group">
                                <div class="bg-gray-100/60 dark:bg-gray-900/60 overflow-hidden relative h-[306px] rounded-t m-0">
                                    <div class="absolute w-full h-full z-10 blur-sm" style="background: linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3) ), url('{{ $item->thumbnail_url }}') center no-repeat; background-size: auto, cover;"></div>
                                    <div class="filter-none z-20 relative w-[306px] h-[274px] my-4 mx-auto group-hover:scale-110" style="background: url('{{ $item->thumbnail_url }}') center no-repeat; background-size: 306px, 306px;"></div>
                                </div>
                                <div class="bg-gray-100/60 dark:bg-gray-900/60 overflow-hidden h-[90px] rounded-b-lg p-4 text-center">
                                    <h4 class="text-xl leading-none font-bold pb-0 h-11 group-hover:text-primary-500" data-tooltip-target="{{ $item->id }}">{!! strip_tags(Str::limit($item->caption, 30)) !!}</h4>
                                    <p class="p-0 m-0 text-gray-500/75 dark:text-white/75 font-medium text-sm">Instagram Feed vom: {!! Carbon::parse($item->timestamp)->format('d.m.Y H:i') !!}</p>
                                </div>
                            </div>
                            <div id="{{ $item->id }}" role="tooltip" class="absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {!! $item->caption !!}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @endisset
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

        <script type="module">

            let swiper = new Swiper(".instagramSlide", {
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: {
                    delay: 2500,
                    disabledOnInteraction: false
                },
                loop: true,
            })
        </script>
    @endpush
</div>
