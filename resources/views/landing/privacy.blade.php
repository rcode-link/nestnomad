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
                            @lang('public.privacy.title')
                        </h1>
                        <p
                            class="mx-auto mb-4 max-w-[600px] text-base font-medium text-white sm:text-lg sm:leading-[1.44]"
                        >
                            @lang('public.privacy.last_updated', ['date' => '2026-02-16'])
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pb-8 pt-20 dark:bg-dark lg:pb-[70px] lg:pt-[120px]">
        <div class="container px-4 mx-auto max-w-[800px]">
            <div class="text-body-color dark:text-dark-6 [&_h2]:text-dark [&_h2]:dark:text-white [&_h2]:text-xl [&_h2]:font-bold [&_h2]:mt-8 [&_h2]:mb-4 [&_p]:mb-4 [&_ul]:mb-4 [&_ul]:list-disc [&_ul]:pl-6 [&_li]:mb-2">
                <h2>1. @lang('public.privacy.sections.intro.title')</h2>
                <p>@lang('public.privacy.sections.intro.body', ['name' => config('app.name')])</p>

                <h2>2. @lang('public.privacy.sections.collected.title')</h2>
                <p>@lang('public.privacy.sections.collected.body')</p>
                <ul>
                    <li>@lang('public.privacy.sections.collected.items.account')</li>
                    <li>@lang('public.privacy.sections.collected.items.property')</li>
                    <li>@lang('public.privacy.sections.collected.items.payment')</li>
                    <li>@lang('public.privacy.sections.collected.items.communication')</li>
                </ul>

                <h2>3. @lang('public.privacy.sections.analytics.title')</h2>
                <p>@lang('public.privacy.sections.analytics.body', ['name' => config('app.name')])</p>
                <ul>
                    <li>@lang('public.privacy.sections.analytics.items.no_cookies')</li>
                    <li>@lang('public.privacy.sections.analytics.items.no_personal')</li>
                    <li>@lang('public.privacy.sections.analytics.items.no_tracking')</li>
                    <li>@lang('public.privacy.sections.analytics.items.gdpr')</li>
                </ul>

                <h2>4. @lang('public.privacy.sections.usage.title')</h2>
                <p>@lang('public.privacy.sections.usage.body')</p>
                <ul>
                    <li>@lang('public.privacy.sections.usage.items.service')</li>
                    <li>@lang('public.privacy.sections.usage.items.communication')</li>
                    <li>@lang('public.privacy.sections.usage.items.security')</li>
                    <li>@lang('public.privacy.sections.usage.items.legal')</li>
                </ul>

                <h2>5. @lang('public.privacy.sections.sharing.title')</h2>
                <p>@lang('public.privacy.sections.sharing.body', ['name' => config('app.name')])</p>

                <h2>6. @lang('public.privacy.sections.retention.title')</h2>
                <p>@lang('public.privacy.sections.retention.body')</p>

                <h2>7. @lang('public.privacy.sections.rights.title')</h2>
                <p>@lang('public.privacy.sections.rights.body')</p>
                <ul>
                    <li>@lang('public.privacy.sections.rights.items.access')</li>
                    <li>@lang('public.privacy.sections.rights.items.rectification')</li>
                    <li>@lang('public.privacy.sections.rights.items.deletion')</li>
                    <li>@lang('public.privacy.sections.rights.items.export')</li>
                </ul>

                <h2>8. @lang('public.privacy.sections.security.title')</h2>
                <p>@lang('public.privacy.sections.security.body')</p>

                <h2>9. @lang('public.privacy.sections.changes.title')</h2>
                <p>@lang('public.privacy.sections.changes.body')</p>

                <h2>10. @lang('public.privacy.sections.contact.title')</h2>
                <p>@lang('public.privacy.sections.contact.body', ['email' => config('app.contact_email', 'your-email@example.com')])</p>
            </div>
        </div>
    </section>
</x-app>
