<x-mail-layout>
    {{ metaTags('', '', $writeMe['subject']) }}
    <p class="mt-2">Hallo {{ $writeMe['nameRecipient'] }},</p>
    <p class="mt-2">dir wurde eine E-Mail über {{ env('TTF_NAME') }} gesendet.</p>
    <p class="mt-2">Mit folgendem Inhalt:</p>
    <hr class="border-primary-500 my-2">
    <p class="mt-2">Name: {{ $writeMe['nameSender'] }}</p>
    <p class="mt-2">E-Mail Adresse: {{ $writeMe['emailSender'] }}</p>
    <p class="mt-2">Betreff: {{ $writeMe['subject'] }}</p>
    <div class="mt-4">
        {{ $writeMe['message'] }}
    </div>
</x-mail-layout>
