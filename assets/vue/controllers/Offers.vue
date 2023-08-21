<template>
    <div class="max-w-6xl mx-auto px-3">
        <h1 class="text-3xl text-center mt-6 font-bold mb-6">Offers</h1>
        <div v-if="listings.length > 0">
            <main>
                <ul class="sm:grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                    <listing-item v-for="listing in listings" :key="listing.id" :listing="listing"></listing-item>
                </ul>
            </main>

            <div class="flex justify-center items-center" v-if="areListingsFetchable">
                <button 
                    class="bg-white px-3 py-1.5 text-gray-700 border border-gray-300 mb-6 mt-6 hover:border-slate-600 rounded transition duration-150 ease-in-out"
                    @click="fetchListings"
                >
                    Load more
                </button>
            </div>
        </div>
        <p v-else>There are no current offers</p>
    </div>
</template>

<script setup>
import { ref, onBeforeMount} from 'vue';
import ListingItem from './ListingItem.vue';
import axios from 'axios';

let listings = ref([]);
let areListingsFetchable = ref(true);
let offset = 0;

function fetchListings() {
    areListingsFetchable.value = false;
    axios.get('/listing/api/fetch/' + offset)
        .then(response => {
            listings.value = response.data.listings;
            areListingsFetchable.value = true;
            offset += response.data.listings.length;
        });
}

onBeforeMount(() => {
    fetchListings(); 
});
</script>