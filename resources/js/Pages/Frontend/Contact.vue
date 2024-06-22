<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {Head, useForm, router} from "@inertiajs/vue3";

const form = useForm({
   name: null,
   email: null,
   phone: null,
   message: null,
    company_name: null,
    company_detail: null
});

const sendMessage = () => {
    router.post('/contact-message', form, {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            $toast.success('Message Sent Successfully');
    }
    });
}
</script>

<template>
    <Head title="Contact US" />
    <AppLayout>
        <section class="bg-dark">
            <div class="container " style="background-color: #E9ECEF">
                <div class="row p-lg-5">
                    <div class="col-lg-9">
                        <h1 class="pt-4 pb-4">Quick Contact </h1>
                        <form @submit.prevent="sendMessage">
                            <div class="form">
                                <div class="mb-3">
                                    <label for="name" class="form-label"> Name </label>
                                    <input type="text" class="form-control border p-2 w-100" id="name" placeholder="Inter Your Full Name... " v-model="form.name" required>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="email" class="form-label"> Email </label>
                                        <input type="email" class="form-control border p-2 w-100" id="email" placeholder="Email Address" v-model="form.email" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="number" class="form-label"> Mobile No</label>
                                        <input type="number" class="form-control border p-2 w-100" id="number" placeholder="Mobile No " v-model="form.phone" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="company" class="form-label"> Company Name</label>
                                    <input type="text" class="form-control border mb-5 p-2 w-100" id="company" placeholder="Company Name " v-model="form.company_name" required>
                                </div>
                                <div>
                                    <label for="companyDetails" class="form-label">Company Details (Optional)</label>

                                    <textarea id="companyDetails" name="companyDetails" rows="4"  class="form-control  border mb-5 w-100" v-model="form.company_detail"></textarea>
                                </div>
                                <div>
                                    <label for="message" class="form-label">Message </label>

                                    <textarea id="message" name="message" rows="4"  class="form-control  border mb-5 w-100" v-model="form.message" required></textarea>
                                </div>

                                <button type="submit" class="button-primary"> Send </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-3">
                        <div class="side-info mb-3 mt-5">
                            <h2 class="mt-4 mb-2">:: Corporate Office ::</h2>
                            <ul class="ps-4 d-flex flex-column gap-2">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-geo-alt text-dark fs-3"></i>
                                    <address class="text-dark">
                                        Green Satmahal, House: 206-208, 4th Floor (402-403), Boro Moghbazar, Dhaka-1217, Bangladesh
                                    </address>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone-fill fs-4  text-dark"></i>
                                    <a href="tel:02222228529"  class="text-dark">+8802 222228529</a>
                                </li>
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <a href="tel:0248315919" class="text-dark">+8802 48315919</a>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <a href="mailto:aulad.btta@gmail.com" class="text-dark">aulad.btta@gmail.com</a>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <a href="mailto:bttexaccess@ymail.com" class="text-dark">bttexaccess@ymail.com</a>
                                </li>
                            </ul>

                            <h2 class="mt-4 mb-2">:: Sales Contact ::</h2>

                            <ul class="ps-4  d-flex flex-column gap-2">
                                
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <a href="mailto:aulad.btta@gmail.com" class="text-dark">aulad.btta@gmail.com</a>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <a  href="tel:01716284115" class="text-dark">+8801716 284115</a>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <a href="01670263465" class="text-dark">+8801670 263465</a>
                                </li>
                            </ul>


                            <h2 class="mt-4 mb-2">:: Sales Office ::</h2>
                            <ul class="ps-4  d-flex flex-column gap-2">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-geo-alt text-dark fs-3"></i>
                                    <address class="text-dark">
                                        House: 205, Level: 02, Wireless Railgate
                                        Moghbazar, Dhaka-1217
                                    </address>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <a  href="tel:01716284115" class="text-dark">+8801716-284115</a>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <a href="mailto:aulad.btta@gmail.com" class="text-dark">aulad.btta@gmail.com</a>
                                </li>
                            </ul>

                            <h2 class="mt-4 mb-2">:: Services Contact ::</h2>
                            <ul class="ps-4  d-flex flex-column gap-2">
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-envelope  fs-4 text-dark"></i>
                                    <a href="tel:technical.btta@gmail.com" class="text-dark">technical.btta@gmail.com</a>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone-fill fs-4 text-dark"></i>
                                    <a href="tel:01613722960" class="text-dark">+8801613 722960</a>
                                </li>
                            </ul>
                            <ul class="ps-4">
                                <li class="d-flex align-items-start gap-2">
                                    <i class="bi bi-geo-alt text-dark fs-3"></i>
                                    <address class="text-dark">
                                        House: 205, Level: 02, Wireless Railgate
                                        Moghbazar, Dhaka-1217
                                    </address>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>

</template>
<style scoped>
.side-info{
    text-align: left;
    ul{
        text-style:none;
    }
    h1{
        color: #E50102;
        font-weight: 400;
    }
    h2{
        font-weight: 400;
        color: #E50102;
    }
    p{
        text-align: left;
        padding-left: 90px;
        line-height: 28px;
        i{
            padding-right: 10px;
        }
    }
}

</style>
