<section
    id="features"
    class="pb-8 pt-20 dark:bg-dark lg:pb-[70px] lg:pt-[120px]"
>
    <div class="container px-4 mx-auto">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div
                    class="mx-auto mb-12 max-w-[485px] text-center lg:mb-[70px]"
                >
                    <span class="block mb-2 text-lg font-semibold text-primary">
                        Features
                    </span>
                    <h2
                        class="mb-3 text-3xl font-bold text-dark dark:text-white sm:text-4xl md:text-[40px] md:leading-[1.2]"
                    >
                        @lang("public.features.title", ["name" => config("app.name")])
                    </h2>
                    <p class="text-base text-body-color dark:text-dark-6">
                        @lang("public.features.description", ["name" => config("app.name")])
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4 md:w-1/2 lg:w-1/4">
                <div
                    class="mb-12 wow fadeInUp group"
                    data-wow-delay=".1s"
                    style="visibility: visible; animation-delay: 0.1s"
                >
                    <div
                        class="relative z-10 mb-10 flex h-[70px] w-[70px] items-center justify-center rounded-[14px] bg-primary"
                    >
                        <span
                            class="absolute left-0 top-0 -z-1 mb-8 flex h-[70px] w-[70px] rotate-[25deg] items-center justify-center rounded-[14px] bg-primary/20 duration-300 group-hover:rotate-45"
                        ></span>
                        <x-filament::icon
                            icon="heroicon-o-home-modern"
                            class="w-10 text-white"
                        />
                    </div>
                    <h4
                        class="mb-3 text-xl font-bold text-dark dark:text-white"
                    >
                        @lang("public.features.property.title")
                    </h4>
                    <p class="mb-8 text-body-color dark:text-dark-6 lg:mb-9">
                        @lang("public.features.property.description")
                    </p>
                </div>
            </div>

            <div class="w-full px-4 md:w-1/2 lg:w-1/4">
                <div
                    class="mb-12 wow fadeInUp group"
                    data-wow-delay=".1s"
                    style="visibility: visible; animation-delay: 0.1s"
                >
                    <div
                        class="relative z-10 mb-10 flex h-[70px] w-[70px] items-center justify-center rounded-[14px] bg-primary"
                    >
                        <span
                            class="absolute left-0 top-0 -z-1 mb-8 flex h-[70px] w-[70px] rotate-[25deg] items-center justify-center rounded-[14px] bg-primary/20 duration-300 group-hover:rotate-45"
                        ></span>
                        <x-filament::icon
                            icon="heroicon-o-clipboard-document-list"
                            class="w-10 text-white"
                        />
                    </div>
                    <h4
                        class="mb-3 text-xl font-bold text-dark dark:text-white"
                    >
                        @lang("public.features.lease.title")
                    </h4>
                    <p class="mb-8 text-body-color dark:text-dark-6 lg:mb-9">
                        @lang("public.features.lease.description")
                    </p>
                </div>
            </div>
            <div class="w-full px-4 md:w-1/2 lg:w-1/4">
                <div
                    class="mb-12 wow fadeInUp group"
                    data-wow-delay=".1s"
                    style="visibility: visible; animation-delay: 0.1s"
                >
                    <div
                        class="relative z-10 mb-10 flex h-[70px] w-[70px] items-center justify-center rounded-[14px] bg-primary"
                    >
                        <span
                            class="absolute left-0 top-0 -z-1 mb-8 flex h-[70px] w-[70px] rotate-[25deg] items-center justify-center rounded-[14px] bg-primary/20 duration-300 group-hover:rotate-45"
                        ></span>
                        <x-filament::icon
                            icon="heroicon-o-bug-ant"
                            class="w-10 text-white"
                        />
                    </div>
                    <h4
                        class="mb-3 text-xl font-bold text-dark dark:text-white"
                    >
                        @lang("public.features.issues.title")
                    </h4>
                    <p class="mb-8 text-body-color dark:text-dark-6 lg:mb-9">
                        @lang("public.features.issues.description")
                    </p>
                </div>
            </div>
            <div class="w-full px-4 md:w-1/2 lg:w-1/4">
                <div
                    class="mb-12 wow fadeInUp group"
                    data-wow-delay=".1s"
                    style="visibility: visible; animation-delay: 0.1s"
                >
                    <div
                        class="relative z-10 mb-10 flex h-[70px] w-[70px] items-center justify-center rounded-[14px] bg-primary"
                    >
                        <span
                            class="absolute left-0 top-0 -z-1 mb-8 flex h-[70px] w-[70px] rotate-[25deg] items-center justify-center rounded-[14px] bg-primary/20 duration-300 group-hover:rotate-45"
                        ></span>
                        <x-filament::icon
                            icon="heroicon-o-banknotes"
                            class="w-10 text-white"
                        />
                    </div>
                    <h4
                        class="mb-3 text-xl font-bold text-dark dark:text-white"
                    >
                        @lang("public.features.charges.title")
                    </h4>
                    <p class="mb-8 text-body-color dark:text-dark-6 lg:mb-9">
                        @lang("public.features.charges.description")
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
