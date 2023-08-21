<template>
    <swiper :modules="[EffectFade, Navigation, Pagination]" :slides-per-view="1" navigation
        :pagination="{ type: 'progressbar' }" effect="fade">
        <swiper-slide v-for="(image, index) in images" :key="index">
            <img class="relative w-full overflow-hidden swiper-image" :src="'/uploads/photos/' + image">
        </swiper-slide>
    </swiper>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, EffectFade } from 'swiper/modules';
import 'swiper/css/bundle';

defineProps({
    images: Array
});
</script>