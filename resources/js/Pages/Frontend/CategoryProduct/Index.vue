<script setup>
    import AppLayout from "@/Layouts/AppLayout.vue";
    import {Head, Link} from "@inertiajs/vue3";
    import {ref} from 'vue'
    import ProductCard from "@/Components/ProductCard.vue";
    const props = defineProps({
        category:Object,
        categories: Array,
    })


    const isActive = ref(false);
</script>

<template>
    <Head :title="category?.name" />
    <AppLayout>
        <section>
            
            <div class="container position-relative" style="min-height:400px">
                <div class="d-flex">
                    <div class="links-wrapper" :class="{'links-wrapper--toggled' : isActive}">
                        <ul class="bg-white shadow h-100">
                            <li v-for="category in  categories">
                                <Link :href="`/products/cat/${category.id}`" class="bg-white text-dark py-2 px-2 border-bottom d-flex align-items-center gap-2">
                                    <img :src="category?.image" alt="" style="width: 20px;height: 20px">
                                    <p class="fs-5 fw-normal">{{category.name}}</p>
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <div class="ps-lg-3 all-products  pb-lg-5">
                        <div class="category-banner mb-5">
                            <p class="fs-2 fw-semibold">{{category?.name}}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            
                            <button @click="isActive = !isActive" class="position-absolute d-lg-none z-3" style="top: 20px;right: 10px;">
                                <i class="bi" :class="isActive ? 'bi-x-lg' : 'bi-list'"></i>
                            </button>
                        </div>
                        <div class="row row-cols-2 row-cols-lg-4" v-if="category?.products?.length > 0">
                            <ProductCard class="px-2 mb-3" v-for="product in category?.products" :info="product" />
                        </div>
                        <h3 v-else class="text-secondary text-center pt-5 text-dark"> <span class="primary-color">{{ category?.name }}</span> Product Not Found !</h3>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
