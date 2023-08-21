<template>
    <slider :images="recentListingImages"></slider>
    
</template>

<script setup>
import Slider from '../components/Slider.vue';

let props = defineProps({
    recentListings: Array
});

let recentListingImages = props.recentListings.map((listing) => { return listing.images[0] });
</script>