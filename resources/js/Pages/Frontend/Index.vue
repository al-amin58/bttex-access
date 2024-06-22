<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { watch, ref, onMounted } from 'vue';
import {Link, useForm, Head} from '@inertiajs/vue3'
import ProductCard from "@/Components/ProductCard.vue";
import {useCartStore} from "@/stores/useCartStore.js";
import { Vue3Marquee } from 'vue3-marquee'
import { Autoplay, Pagination, Navigation } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
    import 'swiper/css';
    import 'swiper/css/pagination';
    import 'swiper/css/navigation';

    const modules = [Autoplay];

  // import required modules
const cartStore = useCartStore();

const boxOneProducts = ref(null);
const boxTwoProducts = ref(null);
const props = defineProps({
    products:Array,
    navCats: Array,
    categories: Array,
    boxOneCats: Array,
    boxTwoCats: Array,
    boxOneBrands: Array,
    boxTwoBrands: Array,
    topSellingProducts: Array,
    featuredProducts: Array,
    brands: Array,
    clients: Array,
    bSettings : Array,
    boxOne : String,
    boxTwo : String,
})

const query = useForm({
    category_id: null,
    brand_id: null,
    small_category_id: null,
    small_brand_id: null
})

const loadBoxOneData = async(events) => {
    const response = await axios.get('/get-box-one-products',{params:{...events}});
    boxOneProducts.value = response.data;
    mejorCategory.value=false;
}

const loadBoxTwoData = async(events) => {
    const response = await axios.get('/get-box-two-products',{params:{...events}});
    boxTwoProducts.value = response.data;
}
onMounted(async () => {
    await loadBoxOneData();
    await loadBoxTwoData();
});
watch(() => {
    return [query.category_id, query.brand_id, query.small_category_id, query.small_brand_id];
}, async ([category_id, brand_id, small_category_id, small_brand_id]) => {
    try {
        await loadBoxOneData({
            category_id,
            brand_id,
        });

        await loadBoxTwoData({
            small_category_id,
            small_brand_id
        });
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});
const mejorCategory = ref(false);

</script>

<template>
    <Head title="B.T. TEX. ACCESS." />
    <AppLayout>
        <section>
            <div class="container">
                <div class="d-flex gap-5">
                    <div class="d-none d-lg-block">
                        <ul class="header-links shadow vh-60">
                            <li v-for="category in navCats" :key="category.id">
                                <Link :href="`/products/cat/${category.id}`" class="header-links-item border-bottom d-flex align-items-center gap-2  fs-4 fw-medium" preserve-scroll >
                                    <img :src="category.image" style="width:20px;height:20px;">
                                    {{ category.name }}

                                    <div class="dropDown shadow" v-if="category?.children_recursive?.length > 0">
                                        <ul class="dropDownItem">
                                            <li v-for="item in category.children_recursive">
                                                <Link :href="`/products/cat/${item.id}`" method="get" class="header-links-item border-bottom d-flex align-items-center gap-2 fs-4 fw-medium" preserve-scroll >
                                                    <img :src="item.image" style="width:20px;height:20px;">
                                                    {{ item.name }}
                                                </Link>
                                            </li>
                                        </ul>
                                    </div>
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 p-0 ps-0">
                            <div class="ms-lg-3 vh-25 vh-lg-60">
                                <div id="carouselExampleAutoplaying" class="carousel slide w-100 h-100" data-bs-ride="carousel">
                                    <div class="carousel-inner h-100">
                                        <div class="carousel-item active h-100">
                                            <img src="@/assets/images/slider/consumables.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/GSM-cutter.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/Lamp.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/Detergent.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/chemical-regent.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="@/assets/images/slider/light-box.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/pantone.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/machinerys-2.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/machinerys.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/meter-tester.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/washing-deyer.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                        <div class="carousel-item h-100">
                                            <img src="@/assets/images/slider/weight-balance.jpg" class="w-100" style="min-height: 100%" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 px-0 px-lg-3 mt-4 mt-lg-0">
                            <div class="d-flex flex-lg-column vh-lg-60 gap-2 gap-lg-0">
                                <div class="h-lg-50 pb-lg-2">
                                    <img src="@/assets/images/slider-1.jpeg"
                                         class="d-block w-100 h-100"
                                         alt="">
                                </div>
                                <div class="h-lg-50 pt-lg-2">
                                    <img src="@/assets/images/slider-2.jpg"
                                         class="d-block w-100 h-100"
                                         alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-lg-2 py-5">
            <div class="container p-5">
                <div class="text-center pb-5">
                    <div class="bt-title">
                        <h2>Why Choose US</h2>
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-2">
                            <span style="background-color: red"></span>
                            <span style="background-color: green"></span>
                            <span style="background-color: yellow"></span>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon">
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div>
                                <h4>HIGHEST QUALITY</h4>
                                <p>Guaranteed Excellence We ensure 100% quality with products.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h4>CUSTOMER SUPPORT</h4>
                                <p>Dedicated Service Team Our team is available from 9.30am to 7pm</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M15 4a2 2 0 0 1 2 2v1h1.52a2 2 0 0 1 1.561.75l1.48 1.851a2 2 0 0 1 .439 1.25V15a2 2 0 0 1-2 2h-1a3 3 0 1 1-6 0h-3a3 3 0 1 1-6 0a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zM7 16a1 1 0 1 0 0 2a1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2a1 1 0 0 0 0-2m2.52-7H17v4h3v-2.15z"/></g></svg>
                            </div>
                            <div>
                                <h4>DELIVERY</h4>
                                <p>Fastest Delivery across Bangladesh Fast delivery within 2-48 hours</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <div class="icon-box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M4 20v-2h2.75l-.4-.35q-1.3-1.15-1.825-2.625T4 12.05q0-2.775 1.662-4.938T10 4.25v2.1Q8.2 7 7.1 8.563T6 12.05q0 1.125.425 2.188T7.75 16.2l.25.25V14h2v6zm10-.25v-2.1q1.8-.65 2.9-2.212T18 11.95q0-1.125-.425-2.187T16.25 7.8L16 7.55V10h-2V4h6v2h-2.75l.4.35q1.225 1.225 1.788 2.663T20 11.95q0 2.775-1.662 4.938T14 19.75"/></svg>
                            </div>
                            <div>
                                <h4>EASY RETURN & REFUND</h4>
                                <p>Easy Retrun & Refund You Will Get a Return and Refund within 7 Days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="category-section pt-0 py-5">
            <div class="container">
                <div class="text-center pb-5">
                    <div class="bt-title">
                        <h2>Categories</h2>
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-2">
                            <span style="background-color: red"></span>
                            <span style="background-color: green"></span>
                            <span style="background-color: yellow"></span>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-lg-6">
                    <div class="col mb-3" v-for="category in categories"  :key="category.id">
                        <Link :href="`/products/cat/${category.id}`"  class="category-section-card h-100  bg-white w-100 mx-2 overflow-hidden">
                            <div class="mb-2">
                                <img :src="category.image" :alt="category.name">
                            </div>
                            <div>
                                <h3 class="text-center">{{  category.name }}</h3>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 index">
            <div class="container">
                <div class="text-center pb-2">
                    <div class="bt-title">
                        <h2>Featured Products</h2>
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-2">
                            <span style="background-color: red"></span>
                            <span style="background-color: green"></span>
                            <span style="background-color: yellow"></span>
                        </div>
                    </div>
                </div>
                <div>
                    <Swiper
                        :centeredSlides="true"
                        :speed= "3000"
                        :freeMode="true"
                        :freeModeMomentum="false"
                        :freeModeMomentumBounce="false"
                        :grabCursor="true"
                        :autoplay= "{
                            delay: 0,
                            disableOnInteraction: true,
                        }"
                        :breakpoints="{
                            '640': {
                                slidesPerView: 1,
                                spaceBetween: 0,
                            },
                            '768': {
                                slidesPerView: 3,
                                spaceBetween: 5,
                            },
                            '1024': {
                                slidesPerView: 4,
                                spaceBetween:10,
                            },
                        }"
                        :loop="true"
                        :allowTouchMove="true"
                        :disableOnInteraction="true"
                        :modules="modules"
                        class="mySwiper"
                    >
                        <SwiperSlide v-for="product in featuredProducts"  :key="product?.id">
                            <ProductCard  :info="product" class="mx-2"  />
                        </SwiperSlide>
                    </Swiper>
                </div>
            </div>
        </section>
        <section class="py-5 index">
            <div class="container">
                <div class="text-center pb-2">
                    <div class="bt-title">
                        <h2>Top Selling Products</h2>
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-2">
                            <span style="background-color: red"></span>
                            <span style="background-color: green"></span>
                            <span style="background-color: yellow"></span>
                        </div>
                    </div>
                </div>
                <div>

                    <Swiper
                        :centeredSlides="true"
                        :speed= "3000"
                        :freeMode="true"
                        :freeModeMomentum="false"
                        :freeModeMomentumBounce="false"
                        :grabCursor="true"
                        :autoplay= "{
                            delay: 0,
                            disableOnInteraction: true,
                            reverseDirection: true,
                        }"
                        :breakpoints="{
                            '640': {
                                slidesPerView: 1,
                                spaceBetween: 0,
                            },
                            '768': {
                                slidesPerView: 3,
                                spaceBetween: 5,
                            },
                            '1024': {
                                slidesPerView: 4,
                                spaceBetween:10,
                            },
                        }"
                        :loop="true"
                        :allowTouchMove="true"
                        :disableOnInteraction="true"
                        :modules="modules"
                        class="mySwiper"
                    >
                        <SwiperSlide v-for="product in topSellingProducts"  :key="product?.id" class="h-100">
                            <ProductCard  :info="product" class="mx-2"  />
                        </SwiperSlide>
                    </Swiper>
                </div>
            </div>
        </section>
        <section class="py-5 mb-lg-5 product-filter-section index">
            <div class="container bt-border-dark overflow-hidden rounded" >
                <div class="position-relative d-lg-flex align-items-center justify-content-between p-3 bt-border-bottom-dark  mx-n4" style="background-color: #E0E0E0;">
                    <button @click="mejorCategory = !mejorCategory" class="position-absolute d-lg-none z-3" style="top: 20px;right: 10px;">
                        <i class="bi" :class="mejorCategory ? 'bi-x-lg' : 'bi-list'"></i>
                    </button>
                    <h3 class="box-title" style="min-width: 300px">{{  boxOne }}</h3>
                    <ul class="d-flex gap-lg-3 gap-2 flex-lg-wrap overflow-x-scroll">
                        <li class="brand">
                            <input
                                type="radio"
                                id="all"
                                value="all"
                                name="brand"
                                @click="query.brand_id = null"
                                checked
                                hidden>
                            <label for="all" class="shadow" >All</label>
                        </li>
                        <li v-for="brand in boxOneBrands" :key="brand.id" class="brand">
                            <input
                                type="radio"
                                :id="`brand-${brand.id}`"
                                :value="brand.id"
                                v-model="query.brand_id"
                                name="brand"
                                hidden>
                            <label :for="`brand-${brand.id}`" class="shadow">{{ brand.name }}</label>
                        </li>
                    </ul>
                </div>
                <div class="row p-0 position-relative" style="min-height: 700px;">
                    <div class="col-lg-2 p-0 ms-n2 bg-black links-wrapper link-wrapper--box" :class="{'links-wrapper--toggled' : mejorCategory}">
                        <ul class="links shadow h-100  ">
                            <li v-for="category in boxOneCats" :key="category.id">
                                <input
                                    type="radio"
                                    :id="`category-${category.id}`"
                                    :value="category.id"
                                    v-model="query.category_id"
                                    name="category"
                                    hidden>
                                <label :for="`category-${category.id}`" class="links-item links-item--mejor-home">{{ category.name }}</label>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 pe-0">
                        <div class="row row-cols-2 row-cols-lg-4 products py-1">
                            <ProductCard class="px-2 mb-3"  v-for="product in boxOneProducts" :info="product" :key="product.id"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 mb-lg-5 product-filter-section index">
            <div class="container bt-border-dark overflow-hidden rounded">
                <div class="position-relative d-lg-flex align-items-center justify-content-between p-3 bt-border-bottom-dark  mx-n4" style="background-color: #E0E0E0;">
                    <button @click="mejorCategory = !mejorCategory" class="position-absolute d-lg-none z-3" style="top: 20px;right: 10px;">
                        <i class="bi" :class="mejorCategory ? 'bi-x-lg' : 'bi-list'"></i>
                    </button>
                    <h3 class="mb-2 lg-mb-0" style="min-width:300px">{{ boxTwo}}</h3>
                    <ul class="d-flex gap-lg-3 gap-2 flex-lg-wrap overflow-x-scroll">
                        <li class="brand">
                            <input
                                type="radio"
                                id="box-2-all"
                                value="all"
                                name="brand"
                                @click="query.small_brand_id = null"
                                checked
                                hidden>
                            <label for="box-2-all" class="shadow" >All</label>
                        </li>
                        <li v-for="brand in boxTwoBrands" :key="brand.id" class="brand">
                            <input
                                type="radio"
                                :id="`box-2-brand-${brand.id}`"
                                :value="brand.id"
                                v-model="query.small_brand_id"
                                name="brand"
                                hidden>
                            <label :for="`box-2-brand-${brand.id}`" class="shadow">{{ brand.name }}</label>
                        </li>
                    </ul>
                </div>
                <div class="row p-0 position-relative" style="min-height: 700px;">
                    <div class="col-lg-2 p-0 ms-n2 bg-black links-wrapper" :class="{'links-wrapper--toggled' : mejorCategory}">
                        <ul class="links shadow h-100  ">
                            <li v-for="category in boxTwoCats" :key="category.id">
                                <input
                                    type="radio"
                                    :id="`category-${category.id}`"
                                    :value="category.id"
                                    v-model="query.small_category_id"
                                    name="category"
                                    hidden>
                                <label :for="`category-${category.id}`" class="links-item links-item--mejor-home">{{ category.name }}</label>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 pe-0">
                        <div class="row row-cols-2 row-cols-lg-4 products py-1">
                            <ProductCard class="px-2 mb-3" v-for="product in boxTwoProducts" :info="product" :key="product.id"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5">
            <div class="container index">
                <div class="text-center pb-2">
                    <div class="bt-title">
                        <h2>Our Brands</h2>
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-2">
                            <span style="background-color: red"></span>
                            <span style="background-color: green"></span>
                            <span style="background-color: yellow"></span>
                        </div>
                    </div>
                </div>
                <Swiper
                    :centeredSlides="true"
                    :speed= "3000"
                    :freeMode="true"
                    :freeModeMomentum="false"
                    :freeModeMomentumBounce="false"
                    :grabCursor="true"
                    :autoplay= "{
                        delay: 0,
                        disableOnInteraction: true,
                    }"
                    :breakpoints="{
                        '640': {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        '768': {
                            slidesPerView: 4,
                            spaceBetween: 40,
                        },
                        '1024': {
                            slidesPerView: 6,
                            spaceBetween: 50,
                        },
                    }"
                    :loop="true"
                    :allowTouchMove="true"
                    :disableOnInteraction="true"
                    :modules="modules"
                    class="mySwiper"
                >
                    <SwiperSlide v-for="brand in brands"  :key="brand?.id">
                        <div class="d-flex flex-column align-items-center justify-content-between h-100">
                                <div class="mb-2">
                                    <img :src="brand?.image" :alt="brand?.name"   style="width:170px; height: 50px">
                                </div>
                                <h3 class="text-center fs-5 fw-normal">{{  brand.name }}</h3>
                            </div>
                    </SwiperSlide>
                </Swiper>
            </div>
        </section>
        <section class="py-5 index">
            <div class="container">
                <div class="text-center pb-2">
                    <div class="bt-title">
                        <h2>Our Clients</h2>
                        <div class="d-flex align-items-center justify-content-center gap-2 mt-2">
                            <span style="background-color: red"></span>
                            <span style="background-color: green"></span>
                            <span style="background-color: yellow"></span>
                        </div>
                    </div>
                </div>
                <Swiper
                    :centeredSlides="true"
                    :speed= "3000"
                    :freeMode="true"
                    :freeModeMomentum="false"
                    :freeModeMomentumBounce="false"
                    :grabCursor="true"
                    :autoplay= "{
                        delay: 0,
                        disableOnInteraction: true,
                        reverseDirection: true,
                    }"
                    :breakpoints="{
                        '640': {
                            slidesPerView: 2,
                            spaceBetween: 20,
                        },
                        '768': {
                            slidesPerView: 4,
                            spaceBetween: 40,
                        },
                        '1024': {
                            slidesPerView: 6,
                            spaceBetween: 50,
                        },
                    }"
                    :loop="true"
                    :allowTouchMove="true"
                    :disableOnInteraction="true"
                    :modules="modules"
                    class="mySwiper"
                >
                    <SwiperSlide v-for="client in clients"  :key="client?.id">
                        <div class="d-flex flex-column align-items-center justify-content-between h-100">
                            <div class="mb-2">
                                <img :src="client?.image" :alt="client?.name"  style="width:170px; height: 50px">
                            </div>
                            <h3 class="text-center fs-5 fw-normal">{{  client?.name }}</h3>
                        </div>
                    </SwiperSlide>
                </Swiper>



            </div>
        </section>
        <section class="py-5">
            <div class="container">
                <div v-html="bSettings?.seo_content">
                </div>
            </div>
        </section>
    </AppLayout>
</template>
<style  lang="scss" scoped>
</style>
