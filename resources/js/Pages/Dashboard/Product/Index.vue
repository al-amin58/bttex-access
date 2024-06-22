<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link, Head} from "@inertiajs/vue3";
const props = defineProps({

    products:Array
})
</script>

<template>
    <Head title="Products" />
    <AuthenticatedLayout>
        <div class="d-flex align-items-center justify-content-between">
            <h2>All Products({{ products?.length }})</h2>
            <Link  href="/dashboard/add-product" class="button-primary">
                <i class="bi bi-plus-lg fs-4"></i> Add New Product
            </Link>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex flex-wrap">
                    <div class=" col-lg-6 p-2" v-for="product in products" :key="product.id">
                        <div class="bg-white d-flex justify-content-between shadow p-2 rounded">
                            <div class="w-20">
                                <img :src="product.images[0]?.url" class="w-100 h-auto">
                            </div>
                            <div class="w-75">
                                <h3 class="property-detail-title mb-1">
                                    <Link  class="iso-hover-primary">{{ product.title }}</Link>
                                </h3>
                                <div class="py-2">
                                    <p>{{ product.category.name }}</p>
                                    <p>{{ product?.brand.name }}</p>
                                </div>
                                <ul class="d-flex align-items-center justify-content-end gap-2 actions">
                                    <li>
                                        <Link :href="`/dashboard/edit-product/${product.slug}`" class="edit" methods="get">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </Link>
                                    </li>
                                    <li>
                                        <Link :href="`/delete-product/${product.id}`" method="get"  class="delete" preserve-scroll>
                                            <i class="bi bi-trash"></i> Delete
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
