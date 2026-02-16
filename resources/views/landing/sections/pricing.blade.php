<section id="pricing" class="relative z-20 overflow-hidden bg-gray-1 pb-12 pt-20 dark:bg-dark-2 lg:pb-[90px] lg:pt-[120px]">
    <div class="container px-4 mx-auto">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="mx-auto mb-[60px] max-w-[510px] text-center">
                    <span class="block mb-2 text-lg font-semibold text-primary">
                        @lang('public.pricing.title')
                    </span>
                    <h2 class="mb-3 text-3xl font-bold text-dark dark:text-white sm:text-4xl md:text-[40px] md:leading-[1.2]">
                        @lang('public.pricing.heading')
                    </h2>
                    <p class="text-base text-body-color dark:text-dark-6">
                        @lang('public.pricing.description')
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap justify-center -mx-4">
            {{-- Free Plan --}}
            <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                <div class="relative z-10 mb-10 overflow-hidden rounded-xl bg-white px-8 py-10 shadow-pricing dark:bg-dark-2 sm:p-12 lg:px-6 lg:py-10 xl:p-14">
                    <span class="block mb-5 text-lg font-medium text-body-color dark:text-dark-6">
                        @lang('public.pricing.free.name')
                    </span>
                    <h2 class="mb-[10px] text-4xl font-bold text-dark dark:text-white">
                        <span>&euro;0</span>
                        <span class="text-base font-medium text-body-color dark:text-dark-6">
                            / @lang('public.pricing.per_month')
                        </span>
                    </h2>
                    <p class="mb-8 border-b border-stroke pb-8 text-base text-body-color dark:border-dark-3 dark:text-dark-6">
                        @lang('public.pricing.free.description')
                    </p>
                    <ul class="mb-10">
                        <li class="mb-4 flex items-center text-base text-body-color dark:text-dark-6">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.free.features.properties')
                        </li>
                        <li class="mb-4 flex items-center text-base text-body-color dark:text-dark-6">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.free.features.leases')
                        </li>
                        <li class="mb-4 flex items-center text-base text-body-color dark:text-dark-6">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.free.features.expenses')
                        </li>
                        <li class="mb-4 flex items-center text-base text-body-color dark:text-dark-6">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.free.features.issues')
                        </li>
                    </ul>
                    <a href="/app/register"
                       class="inline-block w-full rounded-md border border-stroke bg-transparent px-7 py-3 text-center text-base font-medium text-primary transition hover:border-primary hover:bg-primary hover:text-white dark:border-dark-3">
                        @lang('public.pricing.free.cta')
                    </a>
                </div>
            </div>

            {{-- Standard Plan --}}
            <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                <div class="relative z-10 mb-10 overflow-hidden rounded-xl bg-primary px-8 py-10 shadow-pricing sm:p-12 lg:px-6 lg:py-10 xl:p-14">
                    <span class="block mb-5 text-lg font-medium text-white/80">
                        @lang('public.pricing.standard.name')
                    </span>
                    <h2 class="mb-[10px] text-4xl font-bold text-white">
                        <span>&euro;12</span>
                        <span class="text-base font-medium text-white/80">
                            / @lang('public.pricing.per_month')
                        </span>
                    </h2>
                    <p class="mb-8 border-b border-white/20 pb-8 text-base text-white/80">
                        @lang('public.pricing.standard.description')
                    </p>
                    <ul class="mb-10">
                        <li class="mb-4 flex items-center text-base text-white">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-white/10 text-white">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.standard.features.properties')
                        </li>
                        <li class="mb-4 flex items-center text-base text-white">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-white/10 text-white">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.standard.features.extra')
                        </li>
                        <li class="mb-4 flex items-center text-base text-white">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-white/10 text-white">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.standard.features.leases')
                        </li>
                        <li class="mb-4 flex items-center text-base text-white">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-white/10 text-white">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.standard.features.all_features')
                        </li>
                    </ul>
                    <a href="/app/register"
                       class="inline-block w-full rounded-md border border-white bg-white px-7 py-3 text-center text-base font-medium text-primary transition hover:bg-transparent hover:text-white">
                        @lang('public.pricing.standard.cta')
                    </a>
                </div>
            </div>

            {{-- Pro Plan --}}
            <div class="w-full px-4 md:w-1/2 lg:w-1/3">
                <div class="relative z-10 mb-10 overflow-hidden rounded-xl bg-white px-8 py-10 shadow-pricing dark:bg-dark-2 sm:p-12 lg:px-6 lg:py-10 xl:p-14">
                    <span class="block mb-5 text-lg font-medium text-body-color dark:text-dark-6">
                        @lang('public.pricing.pro.name')
                    </span>
                    <h2 class="mb-[10px] text-4xl font-bold text-dark dark:text-white">
                        <span>&euro;39</span>
                        <span class="text-base font-medium text-body-color dark:text-dark-6">
                            / @lang('public.pricing.per_month')
                        </span>
                    </h2>
                    <p class="mb-8 border-b border-stroke pb-8 text-base text-body-color dark:border-dark-3 dark:text-dark-6">
                        @lang('public.pricing.pro.description')
                    </p>
                    <ul class="mb-10">
                        <li class="mb-4 flex items-center text-base text-body-color dark:text-dark-6">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.pro.features.properties')
                        </li>
                        <li class="mb-4 flex items-center text-base text-body-color dark:text-dark-6">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.pro.features.leases')
                        </li>
                        <li class="mb-4 flex items-center text-base text-body-color dark:text-dark-6">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.pro.features.all_features')
                        </li>
                        <li class="mb-4 flex items-center text-base text-body-color dark:text-dark-6">
                            <span class="mr-2.5 flex h-[26px] w-full max-w-[26px] items-center justify-center rounded-full bg-primary/10 text-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.8125 3.5L5.25 10.0625L2.1875 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            @lang('public.pricing.pro.features.priority')
                        </li>
                    </ul>
                    <a href="/app/register"
                       class="inline-block w-full rounded-md border border-stroke bg-transparent px-7 py-3 text-center text-base font-medium text-primary transition hover:border-primary hover:bg-primary hover:text-white dark:border-dark-3">
                        @lang('public.pricing.pro.cta')
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
