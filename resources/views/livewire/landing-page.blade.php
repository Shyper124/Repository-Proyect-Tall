<div>
    <div 
        class="flex flex-col bg-indigo-900 h-screen"
        x-data="{
            showSubcribe: @entangle('showSubscribe'),
            showSuccess: @entangle('showSuccess'),
        }"
        >
        <nav class="pt-5 flex justify-between container mx-auto text-indigo-200">
            <a href="/" class="text-4xl font-bold">
                <x-application-logo class="w-16 h-16 fill-current">        
                </x-application-logo></a> 
            <div class="flex justify-end">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>        
    </nav>
        <div class="flex container mx-auto items-center h-full">
            <div class="flex w-1/3 flex-col items-start">
                <h1 class="font-bold text-white text-5xl leading-tight mb-4">
                Simple generic landing page to suscribe
            </h1>

            <p class="text-indigo-200 text-xl mb-5">
                We are checking the <span class="font-bold underline"> TALL</span> stack. Woul you mind subscribing?
            </p>
            <x-button 
            class="py-3 px-8 bg-blue-700 hover:bg-blue-500" 
            x-on:click="showSubcribe=true">
                Subscribe
            </x-button>
            </div>
        </div>
    <x-modal class="bg-blue-400 border border-gray border-2" trigger="showSubcribe" >
        <p class="text-white font-extrabold text-5xl text-center">
                Let´s Go
            </p>
            <form 
            class="flex flex-col items-center p-20"
            wire:submit.prevent="subscribe"
            >
               <x-input class="px-5 py-3 w-80 border border-blue-400 border-1" 
               type=email 
               name=email 
               placeholder="Email addres"
               wire:model.defer="email"
               ></x-input>
            <span class="text-gray-100 text-xs">
                  {{
                    $errors->has('email')
                    ? $errors->first('email')
                    : 'We will sen you a confirmation email.'
                  }}
            </span>
            <x-button class="px-5 py-3 mt-5 w-80 bg-blue-500 justify-center">
                  <span class="animate-spin" wire:loading wire:target="subscribe">&#9696;</span>
                  <span wire:loading.remove wire:target="subscribe">Get in</span>
            </x-button>
            </form>
    </x-modal>
    <x-modal class="bg-green-500 " trigger="showSuccess" >
        <p class="animate-pulse text-white font-extrabold text-8xl text-center">
                ☺
            </p>
            <p class="text-white font-extrabold text-3xl text-center mt-16">
                Great!
            </p>
            @if (request()->has('verified') && request()->verified == 1)
            <p class="text-white text-3xl text-center">
                Thanks for confirming.
            </p>
        @else
            <p class="text-white text-3xl text-center">
                See you in your inbox.
            </p>
        @endif
    </x-modal>
</div>
