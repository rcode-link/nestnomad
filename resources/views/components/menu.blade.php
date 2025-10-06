<div
    x-data="{
        atTop: true,
        handleThemeChange(e) {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark')
                localStorage.setItem('theme', 'light')
                return
            }

            document.documentElement.classList.add('dark')
            localStorage.setItem('theme', 'dark')
        },
    }"
    x-init="atTop = (window.pageYOffset < 50) ? true:false"
    class="sticky top-0 left-0 z-40 flex items-center w-full ud-header"
    :class="{'bg-white/40 dark:bg-dark/40 shadow bg-blur': !atTop, 'text-white': atTop}"
    @scroll.window="atTop = (window.pageYOffset < 50) ? true:false"
>
    <div class="container px-4 mx-auto">
        <div class="relative flex items-center justify-between -mx-4">
            <div class="max-w-full px-4 w-60">
                <a href="index.html" class="block w-full py-5 navbar-logo">
                    <img
                        src="/svg/logo.svg"
                        alt="{{ config("app.name") }}"
                        :class="{'text-dark dark:text-white': !atTop}"
                    />
                </a>
            </div>

            <div class="flex items-center justify-between w-full px-4">
                <div x-data="{
                    open: false,
                }">
                    <button
                        id="navbarToggler"
                        @click="open = !open"
                        class="absolute right-4 top-1/2 block -translate-y-1/2 rounded-lg px-3 py-[6px] ring-primary focus:ring-2 lg:hidden"
                    >
                        <span
                            class="relative my-[6px] block h-[2px] w-[30px]"
                            :class="{'bg-dark dark:bg-white': !atTop, 'bg-white': atTop}"
                        ></span>
                        <span
                            class="relative my-[6px] block h-[2px] w-[30px]"
                            :class="{'bg-dark dark:bg-white': !atTop, 'bg-white': atTop}"
                        ></span>
                        <span
                            class="relative my-[6px] block h-[2px] w-[30px]"
                            :class="{'bg-dark dark:bg-white': !atTop, 'bg-white': atTop}"
                        ></span>
                    </button>
                    <nav
                        id="navbarCollapse"
                        class="absolute right-4 top-full w-full max-w-[250px] rounded-lg bg-white dark:bg-dark-2 py-5 shadow-lg dark:bg-dark-2 lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:px-4 lg:py-0 lg:shadow-none dark:lg:bg-transparent xl:px-6"
                        :class="{'hidden': !open}"
                    >
                        <ul
                            class="block lg:flex 2xl:ml-20"
                            @click="open = false"
                        >
                            <li class="relative group">
                                <a
                                    href="#home"
                                    class="flex py-2 mx-8 text-base font-medium ud-menu-scroll group-hover:text-primary lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"
                                >
                                    @lang("public.menu.home")
                                </a>
                            </li>
                            <li class="relative group">
                                <a
                                    href="#features"
                                    class="flex py-2 mx-8 text-base font-medium ud-menu-scroll group-hover:text-primary lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"
                                >
                                    @lang("public.menu.features")
                                </a>
                            </li>
                            <li class="relative group">
                                <a
                                    href="#price"
                                    class="flex py-2 mx-8 text-base font-medium ud-menu-scroll group-hover:text-primary lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"
                                >
                                    @lang("public.menu.price")
                                </a>
                            </li>
                            <li class="relative group">
                                <a
                                    href="#contact"
                                    class="flex py-2 mx-8 text-base font-medium ud-menu-scroll group-hover:text-primary lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"
                                >
                                    @lang("public.menu.contact")
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="flex items-center justify-end pr-16 lg:pr-0">
                        <div x-data="{
                            openLang: false,
                        }"
                        class="relative flex items-center mr-4"
                        >
                            <button @click="openLang = !openLang"                         >
                            {{config('app.available_locales')[$lanuage]}}
                           </button>
                                <ul
                                    class="absolute top-full max-w-[250px] text-dark dark:text-white rounded-lg bg-white dark:bg-dark-2 py-5 shadow-lg dark:bg-dark-2"
                                    :class="{'hidden': !openLang, 'lg:flex flex-col 2xl:ml-20 block': openLang}"
                                >
                                @foreach(config('app.available_locales') as $localeKey => $name)
                                    <li class="relative group px-4 hover:text-primary">
                                        <a href="{{route('lang', ['lang' => $localeKey])}}" >
                                        {{$name}}
                                        </a>
                                    </li>
                                @endforeach
                               </ul>
                        </div>
                    <div class="hidden sm:flex">


                        <div class="themeSelector flex items-center">
                            <x-filament::icon
                                icon="heroicon-o-sun"
                                class="w-6 hidden dark:block"
                                class="w-6 dark:hidden"
                                x-on:click="handleThemeChange"
                            />
                            <x-filament::icon
                                icon="heroicon-o-moon"
                                class="w-6 hidden dark:block"
                                x-on:click="handleThemeChange"
                            />
                        </div>
                        <a
                            href="/app/login"
                            class="loginBtn px-[22px] py-2 text-base font-medium hover:opacity-70"
                        >
                            Sign In
                        </a>
                        <a
                            href="app/register"
                            class="px-6 py-2 text-base font-medium duration-300 ease-in-out rounded-md bg-dark/20"
                        >
                            Sign Up
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
