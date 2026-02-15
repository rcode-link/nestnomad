<x-app>
    @include("components.menu")
    <div
        id="home"
        class="relative overflow-hidden bg-primary -mt-[75px] pt-[120px] pb-[60px] md:pt-[130px] lg:pt-[160px]"
    >
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-full px-4">
                    <div
                        class="hero-content wow fadeInUp mx-auto max-w-[780px] text-center"
                    >
                        <h1
                            class="mb-6 text-3xl font-bold leading-snug text-white sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-[1.2]"
                        >
                            @lang("public.properties.title")
                        </h1>
                        <p
                            class="mx-auto mb-4 max-w-[600px] text-base font-medium text-white sm:text-lg sm:leading-[1.44]"
                        >
                            @lang("public.properties.description")
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pb-8 pt-20 dark:bg-dark lg:pb-[70px] lg:pt-[120px]">
        <div class="container px-4 mx-auto">
            <livewire:property-search />
        </div>
    </section>
</x-app>
