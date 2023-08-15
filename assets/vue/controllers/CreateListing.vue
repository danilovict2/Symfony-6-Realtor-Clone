<template>
    <main class="max-w-md px-2 mx-auto">
        <h1 class="text-3xl text-center mt-6 font-bold">Create a Listing</h1>
        <form>
            <p class="text-lg mt-6 font-semibold">Sell / Rent</p>
            <div class="flex">
                <button type="button" id="type" value="sale" class="mr-3 px-7 py-3 font-medium
                    text-sm uppercase shadow-md rounded hover:shadow-lg focus:shadow-lg active:shadow-lg transition
                    duration-150 ease-in-out w-full"
                    :class="type === 'rent' ? 'bg-white text-black' : 'bg-slate-600 text-white'" @click="type = 'sale';">
                    sell
                </button>
                <button type="button" id="type" value="rent" class="mr-3 px-7 py-3 font-medium
                    text-sm uppercase shadow-md rounded hover:shadow-lg focus:shadow-lg active:shadow-lg transition
                    duration-150 ease-in-out w-full"
                    :class="type === 'sale' ? 'bg-white text-black' : 'bg-slate-600 text-white'" @click="type = 'rent';">
                    rent
                </button>
            </div>
            <p class="text-lg mt-6 font-semibold">Name</p>
            <input type="text" id="name" v-model="name" placeholder="Name" maxLength="32" minLength="10" required
                class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:text-gray-700 focus:bg-white focus:border-slate-600 mb-6" />
            <div class="flex space-x-6 mb-6">
                <div>
                    <p class="text-lg font-semibold">Beds</p>
                    <input type="number" id="bedrooms" v-model="bedrooms" min="1" max="50" required
                        class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:text-gray-700 focus:bg-white focus:border-slate-600 text-center" />
                </div>
                <div>
                    <p class="text-lg font-semibold">Baths</p>
                    <input type="number" id="bathrooms" v-model="bathrooms" min="1" max="50" required
                        class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:text-gray-700 focus:bg-white focus:border-slate-600 text-center" />
                </div>
            </div>
            <p class="text-lg mt-6 font-semibold">Parking spot</p>
            <div class="flex">
                <button type="button" id="parking" class="mr-3 px-7 py-3 font-medium text-sm uppercase
                    shadow-md rounded hover:shadow-lg focus:shadow-lg active:shadow-lg transition duration-150 ease-in-out
                    w-full" :class="!parking ? 'bg-white text-black' : 'bg-slate-600 text-white'"
                    @click="parking = true;">
                    Yes
                </button>
                <button type="button" id="parking" class="`ml-3 px-7 py-3 font-medium text-sm uppercase
                    shadow-md rounded hover:shadow-lg focus:shadow-lg active:shadow-lg transition duration-150 ease-in-out
                    w-full" :class="parking ? 'bg-white text-black' : 'bg-slate-600 text-white'"
                    @click="parking = false;">
                    no
                </button>
            </div>
            <p class="text-lg mt-6 font-semibold">Furnished</p>
            <div class="flex">
                <button type="button" id="furnished" class="mr-3 px-7 py-3 font-medium text-sm uppercase
                    shadow-md rounded hover:shadow-lg focus:shadow-lg active:shadow-lg transition duration-150 ease-in-out
                    w-full" :class="!furnished ? 'bg-white text-black' : 'bg-slate-600 text-white'"
                    @click="furnished = true;">
                    yes
                </button>
                <button type="button" id="furnished" class="ml-3 px-7 py-3 font-medium text-sm uppercase
                    shadow-md rounded hover:shadow-lg focus:shadow-lg active:shadow-lg transition duration-150 ease-in-out
                    w-full" :class="furnished ? 'bg-white text-black' : 'bg-slate-600 text-white'"
                    @click="furnished = false;">
                    no
                </button>
            </div>
            <p class="text-lg mt-6 font-semibold">Address</p>
            <textarea type="text" id="address" v-model="address" placeholder="Address" required
                class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:text-gray-700 focus:bg-white focus:border-slate-600 mb-6" />
            <div class="flex space-x-6 justify-start mb-6">
                <div>
                    <p class="text-lg font-semibold">Latitude</p>
                    <input type="number" id="latitude" v-model="latitude" min="-90" max="90"
                        class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:bg-white focus:text-gray-700 focus:border-slate-600 text-center" />
                </div>
                <div>
                    <p class="text-lg font-semibold">Longitude</p>
                    <input type="number" id="longitude" v-model="longitude" min="-180"
                        max="180"
                        class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:bg-white focus:text-gray-700 focus:border-slate-600 text-center" />
                </div>
            </div>

            <p class="text-lg font-semibold">Description</p>
            <textarea type="text" id="description" v-model="description" placeholder="Description" required
                class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:text-gray-700 focus:bg-white focus:border-slate-600 mb-6" />
            <p class="text-lg font-semibold">Offer</p>
            <div class="flex mb-6">
                <button type="button" id="offer" @click="offer = true;"
                    class="mr-3 px-7 py-3 font-medium text-sm uppercase shadow-md
                    rounded hover:shadow-lg focus:shadow-lg active:shadow-lg transition duration-150 ease-in-out w-full"
                    :class="!offer ? 'bg-white text-black' : 'bg-slate-600 text-white'">
                    yes
                </button>
                <button type="button" id="offer" @click="offer = false;" class="ml-3 px-7 py-3 font-medium text-sm uppercase
                    shadow-md rounded hover:shadow-lg focus:shadow-lg active:shadow-lg transition duration-150 ease-in-out
                    w-full" :class="offer ? 'bg-white text-black' : 'bg-slate-600 text-white'">
                    no
                </button>
            </div>
            <div class="flex items-center mb-6">
                <div>
                    <p class="text-lg font-semibold">Regular price</p>
                    <div class="flex w-full justify-center items-center space-x-6">
                        <input type="number" id="regularPrice" v-model="regularPrice" min="50" max="400000000" required
                            class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:text-gray-700 focus:bg-white focus:border-slate-600 text-center" />
                        <div v-show="type === 'rent'">
                            <p class="text-md w-full whitespace-nowrap">$ / Month</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mb-6" v-show="offer">
                <div>
                    <p class="text-lg font-semibold">Discounted price</p>
                    <div class="flex w-full justify-center items-center space-x-6">
                        <input type="number" id="discountedPrice" v-model="discountedPrice" min="50" max="400000000"
                            :required="offer"
                            class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:text-gray-700 focus:bg-white focus:border-slate-600 text-center" />
                        <div v-show="type === 'rent'">
                            <p class="text-md w-full whitespace-nowrap">
                                $ / Month
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-lg font-semibold">Images</p>
                <p class="text-gray-600">
                    The first image will be the cover (max 6)
                </p>
                <input type="file" id="images" accept=".jpg,.png,.jpeg" multiple required
                    class="w-full px-3 py-1.5 text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:bg-white focus:border-slate-600"
                    @change="setImages" />
            </div>
            <button type="submit" @click.prevent="createListing"
                class="mb-6 w-full px-7 py-3 bg-blue-600 text-white font-medium text-sm uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                Create Listing
            </button>
        </form>
    </main>
</template>

<script setup>
import { ref } from 'vue';
import { useToast } from 'vue-toastify';
import axios from 'axios';

let type = ref("rent");
let name = ref("");
let bedrooms = ref(1);
let bathrooms = ref(1);
let parking = ref(false);
let furnished = ref(false);
let address = ref("");
let description = ref("");
let offer = ref(false);
let regularPrice = ref(50);
let discountedPrice = ref(49);
let images = ref({});
let latitude = ref(0);
let longitude = ref(0);

function setImages(e) {
    images.value = e.target.files;
}

function createListing() {
    if (!isValid()) {
        return;
    }
    axios.post('/listing/store', {
            type: type.value,
            name: name.value,
            bedrooms: bedrooms.value,
            bathrooms: bathrooms.value,
            parking: parking.value,
            furnished: furnished.value,
            address: address.value,
            description: description.value,
            regularPrice: regularPrice.value,
            discountedPrice: offer.value ? discountedPrice.value : null,
            latitude: latitude.value,
            longitude: longitude.value,
        })
        .then((response) => {
            window.location = '/listing/' + response.data.id;
        })
        .catch(error => {
            console.log(error);
            useToast().notify({ title: 'Error', body: error.response.data.error, type: "error" })
        });
}

function isValid() {
    if (images.value.length > 6) {
        useToast().notify({ title: 'Error', body: 'Maximum 6 images are allowed', type: "error" })
        return false;
    }
    if (+discountedPrice.value >= +regularPrice.value && offer.value) {
        useToast().notify({ title: 'Error', body: 'Discounted price needs to be less than regular price', type: "error" })
        return false;
    }
    return true;
}
</script>

<style>
.bg-slate-600 {
    background-color: rgb(75 85 99);
}
</style>