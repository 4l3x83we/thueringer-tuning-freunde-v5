<x-mail-layout>
    {{ metaTags('', '', $mail['subject']) }}
    <p class="mt-2">{!! $mail['name'] ? 'Hallo '. $mail['name'] : 'Hallo' !!},</p>
    <p class="mt-2">{!! $mail['description'] !!}</p>
</x-mail-layout>
