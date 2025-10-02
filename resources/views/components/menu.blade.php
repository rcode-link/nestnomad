<div
    x-data="{
        open: false,
    }"
    class="sticky shadow bg-blur-xs top-0 left-0 z-40 flex items-center w-full bg-white/20 dark:bg-dark backdrop-blur-md ud-header"
>
    <div class="container px-4 mx-auto">
        <div class="relative flex items-center justify-between -mx-4">
            <div class="max-w-full px-4 w-60">
                <a href="index.html" class="block w-full py-5 navbar-logo">
                    <img
                        src="assets/images/logo/logo-white.svg"
                        alt="{{ config("app.name") }}"
                        class="w-full header-logo"
                    />
                </a>
            </div>

            <div class="flex items-center justify-between w-full px-4">
                <div>
                    <button
                        id="navbarToggler"
                        @click="open = !open"
                        class="absolute right-4 top-1/2 block -translate-y-1/2 rounded-lg px-3 py-[6px] ring-primary focus:ring-2 lg:hidden"
                    >
                        <span
                            class="relative my-[6px] block h-[2px] w-[30px] bg-dark"
                        ></span>
                        <span
                            class="relative my-[6px] block h-[2px] w-[30px] bg-dark"
                        ></span>
                        <span
                            class="relative my-[6px] block h-[2px] w-[30px] bg-dark"
                        ></span>
                    </button>
                    <nav
                        id="navbarCollapse"
                        class="absolute right-4 top-full w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg dark:bg-dark-2 lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:px-4 lg:py-0 lg:shadow-none dark:lg:bg-transparent xl:px-6"
                        :class="{'hidden': !open}"
                    >
                        <ul
                            class="block lg:flex 2xl:ml-20"
                            @click="open = false"
                        >
                            <li class="relative group">
                                <a
                                    href="#home"
                                    class="flex py-2 mx-8 text-base font-medium ud-menu-scroll text-dark group-hover:text-primary  lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6  lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"
                                >
                                    @lang("public.menu.home")
                                </a>
                            </li>
                            <li class="relative group">
                                <a
                                    href="#features"
                                    class="flex py-2 mx-8 text-base font-medium ud-menu-scroll text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"
                                >
                                    @lang("public.menu.features")
                                </a>
                            </li>
                            <li class="relative group">
                                <a
                                    href="#price"
                                    class="flex py-2 mx-8 text-base font-medium ud-menu-scroll text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6  lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"
                                >
                                    @lang("public.menu.price")
                                </a>
                            </li>
                            <li class="relative group">
                                <a
                                    href="#contact"
                                    class="flex py-2 mx-8 text-base font-medium ud-menu-scroll text-dark group-hover:text-primary dark:text-white lg:ml-7 lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:group-hover:text-white lg:group-hover:opacity-70 xl:ml-10"
                                >
                                    @lang("public.menu.contact")
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="flex items-center justify-end pr-16 lg:pr-0">
                    <div class="hidden sm:flex">
                        <a
                            href="/app/login"
                            class="loginBtn px-[22px] py-2 text-base font-medium text-dark hover:opacity-70"
                        >
                            Sign In
                        </a>
                        <a
                            href="app/register"
                            class="px-6 py-2 text-base font-medium text-dark duration-300 ease-in-out rounded-md bg-dark/20    --color-white: #fff;"
                        >
                            Sign Up
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
