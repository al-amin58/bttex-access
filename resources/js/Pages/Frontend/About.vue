<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import {Head} from "@inertiajs/vue3";

    const props = defineProps({
        bSettings : Array,
    });
</script>
<template>
    <Head title="About US" />
    <AppLayout>
        <section style="background: #F8F8F8;" class="my-5">
            <div class="container" >
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="shadow-lg p-3 bg-white">
                            <div v-html="bSettings?.about_content">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
<style scoped>
</style>
