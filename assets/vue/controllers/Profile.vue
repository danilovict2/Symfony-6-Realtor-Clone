<template>
    <section class="max-w-6xl mx-auto flex flex-col justify-center items-center">
        <h1 class="text-3xl text-center mt-6 font-bold">My Profile</h1>
        <div class="w-full md:w-[50%] mt-6 px-3">
            <form>
                <!-- Name Input  -->
                <input type="text" id="name" v-model="name" :disabled="!isEditable"
                    class="mb-6 w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition ease-in-out" />

                <!-- Email Input  -->
                <input type="email" id="email" :value="props.email" disabled
                    class="mb-6 w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition ease-in-out" />

                <div class="flex justify-between whitespace-nowrap text-sm sm:text-lg mb-6">
                    <p class="flex items-center ">
                        Do you want to change your name?
                        <span
                            class="text-red-600 hover:text-red-700 transition ease-in-out duration-200 ml-1 cursor-pointer"
                            @click="edit">
                            {{ editText }}
                        </span>
                    </p>
                    <p @click="logout"
                        class="text-blue-600 hover:text-blue-800 transition duration-200 ease-in-out cursor-pointer">
                        Sign out
                    </p>
                </div>
            </form>
        </div>
    </section>
</template>

<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useToast } from 'vue-toastify';

let props = defineProps({
    name: String,
    email: String
});
let isEditable = ref(false);
let editText = ref('Edit');
let name = ref(props.name);

function logout() {
    axios.post('/logout')
        .then(() => {
            window.location = '/';
        });
}

function edit() {
    if (isEditable.value) {
        axios.post('/profile/update', null, {
                params: {
                    name: name.value
                }
            })
            .catch(error => {
                name.value = error.response.data.name;
                useToast().notify({title: 'Error', body: error.response.data.error, type: "error"})
            });
    }
    isEditable.value = !isEditable.value;
    editText = isEditable.value ? 'Apply Changes' : 'Edit';
}
</script>

<style>
.flex-col {
    flex-direction: column;
}
</style>