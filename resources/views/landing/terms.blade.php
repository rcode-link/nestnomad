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
                            @lang('public.terms.title')
                        </h1>
                        <p
                            class="mx-auto mb-4 max-w-[600px] text-base font-medium text-white sm:text-lg sm:leading-[1.44]"
                        >
                            @lang('public.terms.last_updated', ['date' => '2026-02-16'])
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pb-8 pt-20 dark:bg-dark lg:pb-[70px] lg:pt-[120px]">
        <div class="container px-4 mx-auto max-w-[800px]">
            <div class="text-body-color dark:text-dark-6 [&_h2]:text-dark [&_h2]:dark:text-white [&_h2]:text-xl [&_h2]:font-bold [&_h2]:mt-8 [&_h2]:mb-4 [&_p]:mb-4 [&_ul]:mb-4 [&_ul]:list-disc [&_ul]:pl-6 [&_li]:mb-2">
                <h2>1. @lang('public.terms.sections.acceptance.title')</h2>
                <p>@lang('public.terms.sections.acceptance.body', ['name' => config('app.name')])</p>

                <h2>2. @lang('public.terms.sections.description.title')</h2>
                <p>@lang('public.terms.sections.description.body', ['name' => config('app.name')])</p>

                <h2>3. @lang('public.terms.sections.accounts.title')</h2>
                <p>@lang('public.terms.sections.accounts.body')</p>

                <h2>4. @lang('public.terms.sections.plans.title')</h2>
                <p>@lang('public.terms.sections.plans.body', ['name' => config('app.name')])</p>
                <ul>
                    <li>@lang('public.terms.sections.plans.free')</li>
                    <li>@lang('public.terms.sections.plans.standard')</li>
                    <li>@lang('public.terms.sections.plans.pro')</li>
                </ul>
                <p>@lang('public.terms.sections.plans.changes')</p>

                <h2>5. @lang('public.terms.sections.payments.title')</h2>
                <p>@lang('public.terms.sections.payments.body')</p>

                <h2>6. @lang('public.terms.sections.use.title')</h2>
                <p>@lang('public.terms.sections.use.body')</p>

                <h2>7. @lang('public.terms.sections.data.title')</h2>
                <p>@lang('public.terms.sections.data.body', ['name' => config('app.name')])</p>

                <h2>8. @lang('public.terms.sections.termination.title')</h2>
                <p>@lang('public.terms.sections.termination.body')</p>

                <h2>9. @lang('public.terms.sections.liability.title')</h2>
                <p>@lang('public.terms.sections.liability.body', ['name' => config('app.name')])</p>

                <h2>10. @lang('public.terms.sections.changes.title')</h2>
                <p>@lang('public.terms.sections.changes.body')</p>

                <h2>11. @lang('public.terms.sections.contact.title')</h2>
                <p>@lang('public.terms.sections.contact.body', ['email' => config('app.contact_email', 'your-email@example.com')])</p>
            </div>
        </div>
    </section>
</x-app>
