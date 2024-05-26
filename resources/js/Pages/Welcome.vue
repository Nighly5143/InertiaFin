<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-white text-black/50 dark:bg-black dark:text-white/50">
        
        <div
            class=" flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-start lg:col-start-1">
                        
                    </div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end lg:col-start-3">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 btn-pink btn ring-1 ring-transparent transition text-white focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 btn-pink btn text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 btn-pink btn text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white ml-[2%]"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-20">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold pink">PORTFOLIO</h1>
                        <p class="mt-4 text-lg">Showcase your projects, skills, and achievements.</p>
                        <Link 
                            href="/login"
                            class="mt-6 inline-block rounded-md btn-pink px-6 py-3 text-white ring-1 ring-transparent transition hover:bg-[purple] focus:outline-none focus-visible:ring-white"
                        >
                            Get Started
                        </Link>
                    </div>
                </main>

                <footer class="py-4 text-gray-500 text-center mt-[20%]">
                    &nbsp;
                </footer>
            </div>
        </div>
    </div>
</template>
