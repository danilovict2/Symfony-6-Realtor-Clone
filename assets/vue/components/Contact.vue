<template>
    <div class="flex flex-col w-full" v-show="landlord">
        <p>
            Contact {{ landlord.name }} for the {{ props.listing.name.toLowerCase() }}
        </p>
        <div class="mt-3 mb-6">
            <textarea name="message" id="message" rows="2" v-model="message"
                class="w-full px-4 py-2 text-xl text-gray-700 bg-white border border-gray-300 rounded transition duration-150 ease-in-out focus:text-gray-700 focus:bg-white focus:border-slate-600"></textarea>
        </div>
        <button
            class="px-7 py-3 bg-blue-600 text-white rounded text-sm uppercase shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full text-center mb-6"
            @click="sendEmail"
        >
            Send Message
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';

let props = defineProps({
    listing: Object
});

let landlord = props.listing.landlord;
let message = ref("");

function sendEmail() {
    window.location = `mailto:${landlord.email}?Subject=${props.listing.name}&body=${message.value}`;
}
</script>