<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ProductCard from "@/Components/ProductCard.vue";
import {useForm, Head} from "@inertiajs/vue3";
import {onMounted, watch, ref} from "vue";

const props = defineProps({
    categories: Array,
    brands: Array,
})


const products = ref(null);

const query = useForm({
    category_id: null,
})

const loadBesicData = async(events) => {
    const response = await axios.get('/get-all-products',{params:{...events}});

    products.value = response.data;
    isActive.value=false;
}

onMounted(async () => {
    await loadBesicData();
});
watch(() => {
    return [query.category_id, query.brand_id];
}, async ([category_id, brand_id]) => {
    try {
        await loadBesicData({
            category_id,
            brand_id
        })
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});
const isActive = ref(false);
</script>

<template>
    <Head title="All Product" />
    <AppLayout>
        <section>
            <div class="container product-filter-section">
                <div class="d-flex justify-content-between position-relative mx-0">
                    <div class="links-wrapper shadow p-0 bg-white" :class="{'links-wrapper--toggled' : isActive}">
                        <div>
                            <div class="mt-2 mb-1 px-2">
                                <button @click="query.category_id=null, query.brand_id=null" class="primary-color fs-6 fw-normal d-flex align-items-center gap-1">
                                    <i class="bi bi-arrow-repeat"></i>
                                    Reset
                                </button>
                            </div>
                            <div class="mb-3">
                                <ul class="links h-100">
                                    <li v-for="category in categories" :key="category.id">

                                        <input
                                            type="radio"
                                            :id="`category-${category.id}`"
                                            :value="category.id"
                                            v-model="query.category_id"
                                            name="category"
                                            hidden>

                                        <label :for="`category-${category.id}`" class="links-item border-bottom d-flex items-center gap-1">
                                            <img :src="category.image" style="width:25px;height:25px;">
                                            {{ category.name }}</label>
                                    </li>
                                </ul>
                            </div>
                            <!-- <div class="mb-3">
                                <h3 class="mb-2">Brands</h3>
                                <ul class="d-flex flex-column links">
                                    <li class="brand">
                                        <input
                                            type="radio"
                                            id="all"
                                            value="all"
                                            name="brand"
                                            @click="query.brand_id = null"
                                            checked
                                            hidden>
                                        <label for="all" class="shadow links-item  border-bottom d-block w-100 rounded-0" >All</label>
                                    </li>
                                    <li v-for="brand in brands" :key="brand.id" class="brand">
                                        <input
                                            type="radio"
                                            :id="`brand-${brand.id}`"
                                            :value="brand.id"
                                            v-model="query.brand_id"
                                            name="brand"
                                            hidden >
                                        <label :for="`brand-${brand.id}`" class="links-item border-bottom d-block w-100 rounded-0">{{ brand.name }}</label>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                    <div class="all-products">
                        <div class="text-end py-2">
                            <button @click="isActive = !isActive" class="d-lg-none z-3 primary-bg pt-1 px-1 rounded" style="top: 20px;right: 10px;">
                                <i class="bi bi-funnel text-white"></i>
                            </button>
                        </div>
                        <div class="row row-cols-2 row-cols-lg-4" v-if="products?.length > 0">
                            <ProductCard class="px-2 mb-3" v-for="product in products" :info="product" :key="product.id"/>
                        </div>
                        
                        <h3 v-else class="text-secondary text-center pt-5 text-dark">Product Not Found</h3>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
