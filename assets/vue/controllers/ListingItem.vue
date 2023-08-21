<template>
    <li
        class="relative bg-white flex flex-col justify-between items-center shadow-md hover:shadow-xl rounded-md overflow-hidden transition-shadow duration-150 m-[10px]">
        <a class="contents" :href="'/listing/' + listing.type + '/' + listing.id">
            <img class="h-[170px] w-full object-cover hover:scale-105 transition-scale duration-200 ease-in" loading="lazy"
                :src="'/uploads/photos/' + listing.images[0]" />
            <p
                class="absolute top-2 left-2 bg-[#3377cc] text-white uppercase text-xs font-semibold rounded-md px-2 py-1 shadow-lg">
                <timeago :datetime="listing.createdAt" />
            </p>
            <div class="w-full p-[10px]">
                <div class="flex items-center space-x-1">
                    <i class="fa-solid fa-location-dot text-green-600 h-4 w-4"></i>
                    <p class="font-semibold text-sm mb-[2px] text-gray-600 truncate">
                        {{ listing.address }}
                    </p>
                </div>
                <p class="font-semibold m-0 text-xl truncate">{{ listing.name }}</p>
                <p class="text-[#457b9d] mt-2 font-semibold">
                    $
                    {{ listing.discountedPrice ?
                        listing.discountedPrice
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        : listing.regularPrice
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
                    {{ listing.type === "rent" ? " / month" : "" }}
                </p>
                <div class="flex items-center mt-[10px] space-x-3">
                    <div class="flex items-center space-x-1">
                        <p class="font-bold text-xs">
                            {{ listing.bedrooms > 1 ? `${listing.bedrooms} Beds` : '1 Bed' }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-1">
                        <p class="font-bold text-xs">
                            {{ listing.bathrooms > 1 ? `${listing.bathrooms} Baths` : '1 Bath' }}
                        </p>
                    </div>
                </div>
            </div>
        </a>

        <form :action="'/listing/delete/' + listing.id" method="post">
            <button type="submit">
                <i class="fa-solid fa-trash absolute bottom-2 right-2 h-[14px] cursor-pointer text-red-500"></i>
            </button>
        </form>

        <a :href="'/listing/edit/' + listing.id">
            <i class="fa-solid fa-pen absolute bottom-2 right-7 h-4 cursor-pointer"></i>
        </a>
    </li>
</template>

<script setup>
import { ref } from 'vue';

let props = defineProps({
    listing: Object
});

console.log(props.listing.createdAt);
let listing = ref(props.listing);
listing.value.createdAt = new Date(listing.value.createdAt);
</script>