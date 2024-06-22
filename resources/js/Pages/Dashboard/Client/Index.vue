<script setup>
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import {ref} from "vue";



const props = defineProps({
    clients:Array,
    errors: Array,
})
const url = ref(null);
const newUrl = ref(null);



const form = useForm({
    name: null,
    image:null
})
const onFileChange = (e) => {
    const file = e.target.files[0];
    form.image = file;
    newClient.image = file;
    url.value = URL.createObjectURL(file);
    newUrl.value = URL.createObjectURL(file);
}

function addClient()
{
    router.post('/clients', {...form})
    form.reset()
    url.value = null
}

const newClient = useForm({
    id: null,
    name: null,
    image:null,
});
const editClient = (client) => {
    document.getElementById('editClient').$vb.modal.show()
    newClient.id = client.id,
        newClient.name = client.name,
        newClient.image = client.image,
        newUrl.value = cateclientgory.image
}

const updateClient = (id) => {
    url.value = null;
    newUrl.value = null;
    router.post(`/update-client/${id}`, newClient);
    newClinet.reset();
    document.getElementById('editClient').$vb.modal.hide()

}

</script>

<template>
    <Head title="Clients" />
    <AuthenticatedLayout>
        <div class="category">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- All Brands -->
                    <div class="category-all ">
                        <header class="p-4 bg-white shadow rounded">
                            <h2>Clients</h2>
                        </header>
                        <transition name="fade" class="d-flex flex-column gap-3 my-3">
                            <div>
                                <div v-for="client in clients" class="category d-flex align-items-center gap-3 bg-white shadow rounded px-3 py-2">
                                    <div>
                                        <img :src="client?.image" alt="Category" style="width:70px;height:50px;object-fit:cover;border-radius:4px">
                                    </div>
                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                        <h3 class="fs-4">{{ client?.name }}</h3>
                                        <div class="d-flex gap-2 actions">
                                            <button @click="editClient(client)" class="edit" style="width:30px;height:30px;">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <Link :href="`/clients/${client.id}`" method="delete"  class="delete" preserve-scroll style="width:30px;height:30px;">
                                                <i class="bi bi-trash"></i>
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-12">
                    <!-- Category Form -->
                    <div class="category-add bg-white shadow rounded p-4">
                        <h2 class="mb-4">Add Client</h2>
                        <form @submit.prevent="addClient">
                            <div class="mb-3">
                                <InputLabel
                                    for="name"
                                    value="Client Name"
                                    class="d-block mb-2"
                                />

                                <TextInput
                                    class="bt-border-color w-100 p-2"
                                    v-model="form.name"
                                />
                                <InputError :message="errors.name" />
                            </div>
                            <div class="mb-4">
                                <InputLabel
                                    for="name"
                                    value="Add Image"
                                    class="d-block mb-2"
                                />
                                <div class="category-image">
                                    <label for="category-image">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                        <span>Upload Image</span>
                                        <TextInput
                                            type="file"
                                            id="category-image"

                                            @change="onFileChange"
                                        />
                                    </label>
                                    <div class="category-image-preview">
                                        <img v-if="url" :src="url" alt="">
                                    </div>
                                </div>
                                <InputError :message="errors.image" />
                            </div>
                            <PrimaryButton type="submit" class="w-100"  :disabled="form.processing">Add Client</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <Modal id="editClient" v-vb-is:modal>
            <div class="category-add">
                <h2 class="mb-4">Update Client</h2>
                <form @submit.prevent="updateClient(newClient.id)">
                    <div class="mb-3">
                        <InputLabel
                            for="name"
                            value="Client Name"
                            class="d-block mb-2"
                        />

                        <TextInput
                            class="bt-border-color w-100 p-2"
                            v-model="newClient.name"
                        />
                        <InputError :message="errors.name" />
                    </div>
                    <div class="mb-4">
                        <InputLabel
                            for="name"
                            value="Add Image"
                            class="d-block mb-2"
                        />
                        <div class="category-image">
                            <label for="category-image">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <span>Upload Image</span>
                                <TextInput
                                    type="file"
                                    id="category-image"

                                    @change="onFileChange"
                                />
                            </label>
                            <div class="category-image-preview">
                                <img v-if="newUrl" :src="newUrl" alt="">
                            </div>
                        </div>
                        <InputError :message="errors.image" />
                    </div>
                    <PrimaryButton type="submit" class="w-100"  :disabled="form.processing">Submit Client</PrimaryButton>
                </form>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
