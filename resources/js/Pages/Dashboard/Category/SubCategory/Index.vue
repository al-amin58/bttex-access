<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head } from '@inertiajs/vue3'
import { useForm } from "@inertiajs/vue3"
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'

const props = defineProps({
    categories:Array,
    subCategories:Array,
    errors:Array,
})

const iconImg = ref(null);
const bannerImg = ref(null);
const iconEditImg = ref(null);
const bannerEditImg = ref(null);
const parentIdError = ref(null);


const form = useForm({
    name: null,
    image:null,
    banner: null,
    parent_id:null,
})
const banner = (banner) => {
    const file = banner.target.files[0];
    form.banner = file;
    bannerImg.value = URL.createObjectURL(file);
}
const image = (image) => {
    const file = image.target.files[0];
    form.image = file;
    iconImg.value = URL.createObjectURL(file);
}

const editBanner = (bannerImage) => {
    const file = bannerImage.target.files[0];
    newCategory.banner = file;
    bannerEditImg.value = URL.createObjectURL(file);
}

const editImage = (iconImage) => {
    const file = iconImage.target.files[0];
    newCategory.image = file;
    iconEditImg.value = URL.createObjectURL(file);
}

const addCategory = () =>
{
    if(form.parent_id == null) {
        parentIdError.value = "The Parent Category Field is Required.";
    }else {
        router.post('/categories', {...form})
        form.reset()
        url.value = null
    }
}


const newCategory = useForm({
    id: null,
    name: null,
    image:null,
    banner:null,
    parent_id: 0,
});
const editCategory = (category) => {
    document.getElementById('editCategory').$vb.modal.show()
    newCategory.id = category.id,
    newCategory.parent_id = category.parent_id,
    newCategory.name = category.name,
    newCategory.image = category.image,
    newCategory.banner = category.banner,
    iconEditImg.value = category.image,
    bannerEditImg.value = category.banner
}

const updateCategory = (id) => {
    if(newCategory.parent_id === null){
        parentIdError.value = "The Parent Category Field is Required.";
    }else {
        iconEditImg.value = null,
        bannerEditImg.value = null,
        router.post(`/update-category/${id}`, newCategory);
        newCategory.reset();
        document.getElementById('editCategory').$vb.modal.hide()
    }
}
</script>

<template>
    <Head title="Categories" />
    <AuthenticatedLayout>
        <div class="category">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- All Category -->
                    <div class="category-all ">
                        <header class="p-4 bg-white shadow rounded">
                            <h2>Sub Categories</h2>
                        </header>
                        <transition name="fade" class="d-flex flex-column gap-3 my-3">
                            <div>
                                <div v-for="category in subCategories" class="category d-flex align-items-center gap-3 bg-white shadow rounded px-3 py-2">
                                    <div>
                                        <img :src="category.image" alt="Category" style="width:70px;height:50px;object-fit:cover;border-radius:4px">
                                    </div>
                                    <div>
                                        <img :src="category.banner" alt="Category" style="width:100px;height:50px;object-fit:cover;border-radius:4px">
                                    </div>
                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                        <h3 class="fs-4">{{ category.name }}</h3>
                                        <div class="d-flex gap-2 actions">
                                            <button @click="editCategory(category)" class="edit" style="width:30px;height:30px;">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <Link :href="`/categories/${category.id}`" method="delete"  class="delete" preserve-scroll style="width:30px;height:30px;">
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
                        <h2 class="mb-4">Add new Category</h2>
                        <form @submit.prevent="addCategory">
                            <div class="mb-3">
                                <InputLabel
                                    for="Parent Category"
                                    value="Parent Category"
                                    class="d-block mb-2"
                                />

                                <v-select
                                    label="name"
                                    v-model="form.parent_id"
                                    :reduce="category => category.id"
                                    :options="categories"
                                    :searchable="false"
                                    return-object
                                    class="bt-border-color"
                                ></v-select>
                                <InputError v-if="parentIdError" :message="parentIdError" />

                            </div>
                            <div class="mb-3">
                                <InputLabel
                                    for="name"
                                    value="Category Name"
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

                                            @change="image"
                                        />
                                    </label>
                                    <div class="category-image-preview">
                                        <img v-if="iconImg" :src="iconImg" alt="">
                                    </div>
                                </div>
                                <InputError :message="errors.image" />
                            </div>

                            <div class="mb-4">
                                <InputLabel
                                    for="name"
                                    value="Add Banner (1200px * 230px)"
                                    class="d-block mb-2"
                                />
                                <div class="category-image">
                                    <label for="category-banner">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                        <span>Upload Image</span>
                                        <TextInput
                                            type="file"
                                            id="category-banner"
                                            @change="banner"
                                        />
                                    </label>
                                    <div class="category-image-preview">
                                        <img v-if="bannerImg" :src="bannerImg" alt="">
                                    </div>
                                </div>
                                <InputError :message="errors.banner" />
                            </div>
                            <PrimaryButton type="submit" class="w-100"  :disabled="form.processing">Add Category</PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <Modal id="editCategory" v-vb-is:modal>
            <div class="category-add">
                <h2 class="mb-4">Update Category</h2>
                <form @submit.prevent="updateCategory(newCategory.id)">
                    <div class="mb-3">

                        <InputLabel
                            for="Parent Category"
                            value="Parent Category"
                            class="d-block mb-2"
                        />

                        <v-select
                            label="name"
                            v-model="newCategory.parent_id"
                            :reduce="category => category.id"
                            :options="categories"
                            :searchable="false"
                            return-object
                            class="bt-border-color"
                        ></v-select>

                        <InputError v-if="parentIdError" :message="parentIdError" />
                    </div>
                    <div class="mb-3">
                        <InputLabel
                            for="name"
                            value="Category Name"
                            class="d-block mb-2"
                        />

                        <TextInput
                            class="bt-border-color w-100 p-2"
                            v-model="newCategory.name"

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
                            <label for="category-edit-image">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <span>Upload Image</span>
                                <TextInput
                                    type="file"
                                    id="category-edit-image"
                                    @change="editImage"
                                />
                            </label>
                            <div class="category-image-preview">
                                <img v-if="iconEditImg" :src="iconEditImg" alt="">
                            </div>
                        </div>
                        <InputError :message="errors.image" />
                    </div>

                    <div class="mb-4">
                        <InputLabel
                            for="name"
                            value="Add Banner Image"
                            class="d-block mb-2"
                        />
                        <div class="category-image">
                            <label for="category-edit-banner">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <span>Upload Image</span>
                                <TextInput
                                    type="file"
                                    id="category-edit-banner"
                                    @change="editBanner"
                                />
                            </label>
                            <div class="category-image-preview">
                                <img v-if="bannerEditImg" :src="bannerEditImg" alt="">
                            </div>
                        </div>
                        <InputError :message="errors.banner" />
                    </div>
                    <PrimaryButton type="submit" class="w-100"  :disabled="form.processing">Update Category</PrimaryButton>
                </form>
            </div>
        </Modal>
    </AuthenticatedLayout>

    <Modal id="editCategory" v-vb-is:modal>
        <h3>Edit Category</h3>
    </Modal>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
