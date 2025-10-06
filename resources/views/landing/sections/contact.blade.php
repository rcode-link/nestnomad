<section id="contact" class="relative py-20 md:py-[120px]">
    <div class="absolute top-0 left-0 w-full h-full -z-1 dark:bg-dark"></div>
    <div
        class="absolute left-0 top-0 -z-1 h-1/2 w-full bg-[#E9F9FF] dark:bg-dark-700 lg:h-[45%] xl:h-1/2"
    ></div>
    <div class="container px-4 mx-auto">
        <div class="flex flex-wrap items-center -mx-4">
            <div class="w-full px-4 lg:w-7/12 xl:w-8/12">
                <div class="ud-contact-content-wrapper">
                    <div class="ud-contact-title mb-12 lg:mb-[150px]">
                        <span
                            class="block mb-6 text-base font-medium text-dark dark:text-white"
                        >
                            @lang('public.contact.title')
                        </span>
                        <h2
                            class="max-w-[260px] text-[35px] font-semibold leading-[1.14] text-dark dark:text-white"
                        >
                            @lang('public.contact.heading')
                        </h2>
                    </div>
                    <div class="flex flex-wrap justify-between mb-12 lg:mb-0">
                        <div class="mb-8 flex w-[330px] max-w-full">
                            <div class="mr-6 text-[32px] text-primary">

                            </div>
                            <div>

                            </div>
                        </div>
                        <div class="mb-8 flex w-[330px] max-w-full">
                            <div class="mr-6 text-[32px] text-primary">

                            </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-4 lg:w-5/12 xl:w-4/12">
                <div
                    class="wow fadeInUp rounded-lg bg-white px-8 py-10 shadow-testimonial dark:bg-dark-2 dark:shadow-none sm:px-10 sm:py-12 md:p-[60px] lg:p-10 lg:px-10 lg:py-12 2xl:p-[60px]"
                    data-wow-delay=".2s
              "
                    style="visibility: visible; animation-delay: 0.2s"
                >
                    <h3
                        class="mb-8 text-2xl font-semibold text-dark dark:text-white md:text-[28px] md:leading-[1.42]"
                    >
                        @lang('public.contact.form.title')
                    </h3>
                    <form>
                        <div class="mb-[22px]">
                            <label
                                for="fullName"
                                class="block mb-4 text-sm text-body-color dark:text-dark-6"
                            >
                                @lang('public.contact.form.full_name')*
                            </label>
                            <input
                                type="text"
                                name="fullName"
                                placeholder="@lang('public.contact.form.placeholder.full_name')"
                                class="w-full border-0 border-b border-[#f1f1f1] bg-transparent pb-3 text-body-color placeholder:text-body-color/60 focus:border-primary focus:outline-hidden dark:border-dark-3 dark:text-dark-6"
                            />
                        </div>
                        <div class="mb-[22px]">
                            <label
                                for="email"
                                class="block mb-4 text-sm text-body-color dark:text-dark-6"
                            >
                                @lang('public.contact.form.email')*
                            </label>
                            <input
                                type="email"
                                name="email"
                                placeholder="@lang('public.contact.form.placeholder.email')"
                                class="w-full border-0 border-b border-[#f1f1f1] bg-transparent pb-3 text-body-color placeholder:text-body-color/60 focus:border-primary focus:outline-hidden dark:border-dark-3 dark:text-dark-6"
                            />
                        </div>
                        <div class="mb-[22px]">
                            <label
                                for="phone"
                                class="block mb-4 text-sm text-body-color dark:text-dark-6"
                            >
                                @lang('public.contact.form.phone')*
                            </label>
                            <input
                                type="text"
                                name="phone"
                                placeholder="@lang('public.contact.form.placeholder.phone')"
                                class="w-full border-0 border-b border-[#f1f1f1] bg-transparent pb-3 text-body-color placeholder:text-body-color/60 focus:border-primary focus:outline-hidden dark:border-dark-3 dark:text-dark-6"
                            />
                        </div>
                        <div class="mb-[30px]">
                            <label
                                for="message"
                                class="block mb-4 text-sm text-body-color dark:text-dark-6"
                            >
                                @lang('public.contact.form.message')*
                            </label>
                            <textarea
                                name="message"
                                rows="1"
                                placeholder="@lang('public.contact.form.placeholder.message')"
                                class="w-full resize-none border-0 border-b border-[#f1f1f1] bg-transparent pb-3 text-body-color placeholder:text-body-color/60 focus:border-primary focus:outline-hidden dark:border-dark-3 dark:text-dark-6"
                            ></textarea>
                        </div>
                        <div class="mb-0">
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center px-10 py-3 text-base font-medium text-white transition duration-300 ease-in-out rounded-md bg-primary hover:bg-blue-dark"
                            >
                                @lang('public.contact.form.submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
