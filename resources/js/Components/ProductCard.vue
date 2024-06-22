<script setup>
import { Link } from '@inertiajs/vue3'

const { info } = defineProps({
    info:Object,
    default: {},
    required: false
})

</script>

<template>
    <div class="col px-0">
        <div class="product-card bt-border-dark d-flex flex-column justify-content-between rounded-0 h-100">
            <Link :href="`/product/${info?.category?.id}/${info?.slug}`" class="product-card-top w-100">
                <img :src="info?.images[0]?.url" :alt="info?.title">
            </Link>
            <div class="product-card-body p-0">
                <h3 class="text-center">
                    <Link :href="`/product/${info?.category?.id}/${info?.slug}`">{{ info?.title.slice(0, 70) }}</Link>
                </h3>
            </div>
        </div>
    </div>
</template>


