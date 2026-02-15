<section class="bg-gray-1 dark:bg-dark-2 pb-8 pt-20 lg:pb-[70px] lg:pt-[120px]">
    <div class="container px-4 mx-auto">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="mx-auto mb-12 max-w-[510px] text-center lg:mb-[70px]">
                    <span class="block mb-2 text-lg font-semibold text-primary">
                        @lang("public.how_it_works.label")
                    </span>
                    <h2 class="mb-3 text-3xl font-bold text-dark dark:text-white sm:text-4xl md:text-[40px] md:leading-[1.2]">
                        @lang("public.how_it_works.title")
                    </h2>
                    <p class="text-base text-body-color dark:text-dark-6">
                        @lang("public.how_it_works.description", ["name" => config("app.name")])
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4 md:w-1/3">
                <div class="mb-12 wow fadeInUp text-center" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s">
                    <div class="mx-auto mb-6 flex h-[70px] w-[70px] items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="text-2xl font-bold">1</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-dark dark:text-white">
                        @lang("public.how_it_works.step1.title")
                    </h3>
                    <p class="text-body-color dark:text-dark-6">
                        @lang("public.how_it_works.step1.description")
                    </p>
                </div>
            </div>
            <div class="w-full px-4 md:w-1/3">
                <div class="mb-12 wow fadeInUp text-center" data-wow-delay=".15s" style="visibility: visible; animation-delay: 0.15s">
                    <div class="mx-auto mb-6 flex h-[70px] w-[70px] items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="text-2xl font-bold">2</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-dark dark:text-white">
                        @lang("public.how_it_works.step2.title")
                    </h3>
                    <p class="text-body-color dark:text-dark-6">
                        @lang("public.how_it_works.step2.description")
                    </p>
                </div>
            </div>
            <div class="w-full px-4 md:w-1/3">
                <div class="mb-12 wow fadeInUp text-center" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s">
                    <div class="mx-auto mb-6 flex h-[70px] w-[70px] items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="text-2xl font-bold">3</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-dark dark:text-white">
                        @lang("public.how_it_works.step3.title")
                    </h3>
                    <p class="text-body-color dark:text-dark-6">
                        @lang("public.how_it_works.step3.description")
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
