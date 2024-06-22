<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useCartStore } from '@/stores/useCartStore.js';
import {useForm, Head} from "@inertiajs/vue3";
import {ref} from "vue";
import axios from "axios";

const cartStore = useCartStore();
cartStore.initCart();


const form = useForm({
    name: null,
    phone: null,
    email: null,
    delivery_location: null,

})

const resetForm = () => {
    form.name= '',
    form.phone= '',
    form.email= '',
    form.quantity= 1,
    form.delivery_location= ''
}



const loading = ref(false);

const sendEmail = () => {

    if(cartStore?.getCartItems?.length === 0 || cartStore?.getCartItems?.length === null) {
        $toast.error("Cart is empty")
    }
    else if(form.name === null) {
        $toast.error("Name field is required")
    }
    else if(form.phone === null) {
        $toast.error('Phone Number field is required')
    }
    else if(form.delivery_location === null) {
        $toast.error('Location filed is required')
    }else {
        loading.value=true
        axios.post('/inquiry-message', {...form, products: cartStore?.getCartItems})
            .then(response => {
                if(response.data){
                    loading.value = false;
                    $toast.success(response?.data?.message)
                    cartStore.clearCart()
                    resetForm()
                }
            })
            .catch(error => {
                console.error(error);
            });
    }
}
</script>

<template>
    <Head title="Send Inquiry" />
    <AppLayout>
        <section class="py-8">
            <div class="container px-0 px-lg-8">
                <h2 class="mb-4 text-uppercase">Products ({{ cartStore?.getCartItems?.length }})</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="d-flex gap-3 mb-3 bg-white shadow p-2 rounded" v-for="item in cartStore.getCartItems" :key="item.id">
                            <div>
                                <img :src="item.images[0].url" style="min-width: 150px;height:120px" class="rounded">
                            </div>
                            <div>
                                <h3>{{ item.title }}</h3>
                                <p>Quantity: {{item.quantity}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bg-white shadow p-4">
                            <h2 class="mb-4 text-uppercase text-center">Send Inquiry</h2>
                            <div>
                                <form>
                                    <div class="mb-3">
                                        <label for="name" class="text-dark">Name</label>
                                        <input
                                            type="text"
                                            class="p-2 bt-border rounded-1 w-100"
                                            v-model="form.name"
                                            required
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="text-dark">Phone</label>
                                        <input type="number"
                                               class="p-2  rounded w-100 bt-border"
                                               v-model="form.phone"
                                               required
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="text-dark">Email</label>
                                        <input type="email"
                                               class="p-2 rounded w-100 bt-border"
                                               v-model="form.email"
                                               required
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="text-dark">Delivery Location</label>
                                        <input type="text"
                                               class="p-2 rounded w-100 bt-border"
                                               v-model="form.delivery_location"
                                               required
                                        >
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start mt-4 gap-2">
                                        <button v-if="loading" class="btn primary-bg text-white" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                            <span role="status" class="test-white">Sending...</span>
                                        </button>
                                        <button v-else type="button" class="button-primary" @click="sendEmail">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
