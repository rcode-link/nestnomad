<x-app>
    @include("components.menu")
    <div
        id="home"
        class="relative overflow-hidden bg-primary -mt-[75px] pt-[120px] md:pt-[130px] lg:pt-[160px]"
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
                            @lang("public.home.title")
                        </h1>
                        <p
                            class="mx-auto mb-9 max-w-[600px] text-base font-medium text-white sm:text-lg sm:leading-[1.44]"
                        >
                            @lang("public.home.description", ["name" => config("app.name")])
                        </p>
                        <div
                            class="wow fadeInUp relative z-10 mx-auto max-w-[845px]"
                        >
                            <div class="mt-16">
                                <img
                                    class="max-w-full mx-auto rounded-t-xl rounded-tr-xl"
                                                                    src="/images/dashboard.webp"
                                                                    alt="Dashboard preview"
                                                                    loading="lazy"
                                />
                                <div class="absolute -left-9 bottom-0 z-[-1]">
                                                                    <img src="/svg/ellipsis-pattern.svg" alt="Ellipsis pattern" loading="lazy" />
                                </div>
                                <div
                                    class="absolute -right-6 -top-6 z-[-1] flex"
                                >
                                                                    <img src="/svg/ellipsis-pattern.svg" alt="Ellipsis pattern" loading="lazy" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("landing.sections.features")
    @include("landing.sections.pricing")
    @include("landing.sections.contact")
</x-app>
