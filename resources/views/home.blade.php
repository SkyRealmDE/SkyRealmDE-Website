<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <img src="{{ asset('assets/banner.png') }}" alt="Banner Image" class="w-full rounded-lg">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="font-sans text-2xl">{{ __("Willkommen auf SkyRealmDE,") }}</h3>
                    <br>
                    <p>dem ultimativen SkyBlock Server für Minecraft Java 1.19.X. Unser Server bietet dir ein einzigartiges SkyBlock Erlebnis mit einem benutzerdefinierten Weltengenerator, innovativer Resourcengewinnung und dem Spielen mit bis zu 13 Freunden gleichzeitig.</p>
                    <br>
                    <p>Erkunde unsere SkyBlock-Welt, die mehrere Dimensionen beinhaltet und entdecke die vielen Möglichkeiten, die sie bietet. Mit unserem eigenen Erzgenerator sparst du dir viel Arbeit und kannst dich ganz auf das Abenteuer konzentrieren.</p>
                    <br>
                    <p>Wir haben auch viele Quality of Life Features, wie zum Beispiel das "Twerken" von Setzlingen und Samen, die das Wachstum verbessern. Unser Server bietet dir ein einzigartiges SkyBlock Erlebnis, das du nicht verpassen solltest. Schau jetzt vorbei auf skyrealm.de und werde Teil unserer Community!</p>
                </div>
            </div>
            <br>
            <br>
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-white">Unsere Partner sprechen für sich!</h2>
                <div class="flow-root mt-8 lg:mt-10">
                    <div class="-mt-4 -ml-8 flex flex-wrap justify-between lg:-ml-4">
                        <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 lg:flex-grow-0 lg:ml-4">
                            <img class="h-8" src="{{ asset('assets/partners/netcup.svg') }}" alt="Netcup">
                        </div>
                        <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 lg:flex-grow-0 lg:ml-4">
                            <img class="h-8" src="{{ asset('assets/partners/epidemicsound.svg') }}" alt="Epidemic Sound">
                        </div>
                        <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 lg:flex-grow-0 lg:ml-4">
                            <img class="h-8" src="{{ asset('assets/partners/tcpshield.svg') }}" alt="TCPShield">
                        </div>
                        <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 lg:flex-grow-0 lg:ml-4">
                            <img class="h-8" src="{{ asset('assets/partners/fiverr.svg') }}" alt="Fiverr">
                        </div>
                        <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 lg:flex-grow-0 lg:ml-4">
                            <img class="h-8" src="{{ asset('assets/partners/cloudflare.svg') }}" alt="Cloudflare">
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <iframe src="https://discord.com/widget?id=752107784866103366&theme=dark" width="100%" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
        </div>
    </div>
</x-app-layout>
