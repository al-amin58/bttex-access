<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Switch from '@/Components/Switch.vue'
import Modal from '@/Components/Modal.vue'
import { ref, onMounted } from 'vue'
import Chart from "@/Components/Chart.vue";

const props = defineProps({
    products: Object,
    brands: Object,
    categories: Object
})
const showToast = () => {
    window.$toast.success('This is a success notification');
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="dashboard">
            <div class="overlay rounded-3 overflow-hidden position-relative">
                <img src="@/assets/images/slider.jpeg"
                     class="w-100 object-fit-cover"
                     style="height: 260px"
                     alt="">
                <div class="position-absolute z-3" style="left:20px;bottom: 20px;">
                    <h2 class="text-white">Hi {{ $page.props?.auth?.user?.name}}</h2>
                    <h3 class="text-white">Welcome to the Dashboard</h3>
                </div>
            </div>
            <div class="widgets py-5">
                <div class="widgets-item">
                    <div class="widgets-item-icon">
                        <i class="bi bi-box"></i>
                    </div>
                    <h4>Total Products</h4>
                    <h3>{{ products }}</h3>
                </div>
                <div class="widgets-item">
                    <div class="widgets-item-icon">
                        <i class="bi bi-list-task"></i>
                    </div>
                    <h4>Total Categories</h4>
                    <h3>{{ categories }}</h3>
                </div>
                <div class="widgets-item">
                    <div class="widgets-item-icon">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <h4>Total Brand</h4>
                    <h3>{{ brands }}</h3>
                </div>
            </div>
        </div>
        <Modal id="modal-1">
            <h1>ISO Modal 1</h1>
        </Modal>
        <Modal id="modal-2">
            <h1>ISO Modal 2</h1>
        </Modal>
    </AuthenticatedLayout>
</template>

