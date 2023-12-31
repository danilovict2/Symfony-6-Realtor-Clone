<template>
  <slider :images="listing.images"></slider>
  <div class="m-4 flex max-w-6xl lg:mx-auto p-4 rounded-lg shadow-lg bg-white lg:space-x-5">
    <div class="w-full">
      <p class="text-2xl font-bold mb-3 text-blue-900">
        {{ listing.name }} - $&nbsp;
        {{ listing.discountedPrice ?
          listing.discountedPrice
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
          : listing.regularPrice
            .toString()
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
        {{ listing.type === "rent" ? " / month" : "" }}
      </p>
      <p class="flex items-center mt-6 mb-3 font-semibold">
        <i class="fa-solid fa-location-dot text-green-700 mr-1"></i>
        {{ listing.address }}
      </p>
      <div class="flex justify-start items-center space-x-4 w-[75%]">
        <p class="bg-red-800 w-full max-w-[200px] rounded-md p-1 text-white text-center font-semibold shadow-md">
          {{ listing.type === "rent" ? "For Rent" : "For Sale" }}
        </p>
        <p class="w-full max-w-[200px] bg-green-800 rounded-md p-1 text-white text-center font-semibold shadow-md"
          v-show="listing.discountedPrice">
          ${{ +listing.regularPrice - +listing.discountedPrice }} discount
        </p>
      </div>
      <p class="mt-3 mb-3">
        <span class="font-semibold">Description - </span>
        {{ listing.description }}
      </p>
      <ul class="flex items-center space-x-2 sm:space-x-10 text-sm font-semibold mb-6">
        <li class="flex items-center whitespace-nowrap">
          <i class="fa-solid fa-bed mr-1"></i>
          {{ +listing.bedrooms > 1 ? `${listing.bedrooms} Beds` : "1 Bed" }}
        </li>
        <li class="flex items-center whitespace-nowrap">
          <i class="fa-solid fa-bath mr-1"></i>
          {{ +listing.bathrooms > 1 ? `${listing.bathrooms} Baths` : "1 Bath" }}
        </li>
        <li class="flex items-center whitespace-nowrap">
          <i class="fa-solid fa-square-parking mr-1"></i>
          {{ listing.parking ? "Parking spot" : "No parking" }}
        </li>
        <li class="flex items-center whitespace-nowrap">
          <i class="fa-solid fa-chair mr-1"></i>
          {{ listing.furnished ? "Furnished" : "Not furnished" }}
        </li>
      </ul>
      <div class="mt-6" v-if="!isContactLandlordEnabled">
        <button @click="isContactLandlordEnabled = true;"
          class="px-7 py-3 bg-blue-600 text-white font-medium text-sm uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg w-full text-center transition duration-150 ease-in-out ">
          Contact Landlord
        </button>
      </div>
      <contact :listing="listing" v-else />
    </div>
    <div className="w-full h-[200px] md:h-[400px] z-10 overflow-x-hidden mt-6 md:mt-0 md:ml-2">
      <l-map :center="[listing.latitude, listing.longitude]" :zoom="13"
        style="height: 100%; width: 100%;">
        <l-tile-layer
          attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
        <l-marker :lat-lng="[listing.latitude, listing.longitude]">
          <l-popup>
            A pretty CSS3 popup. <br /> Easily customizable.
          </l-popup>
        </l-marker>
      </l-map>
    </div>
  </div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, EffectFade } from 'swiper/modules';
import 'swiper/css/bundle'
import { ref } from 'vue';
import Contact from '../components/Contact.vue';
import { LMap, LTileLayer, LMarker, LPopup } from "@vue-leaflet/vue-leaflet";
import Slider from '../components/Slider.vue';


defineProps({
  listing: Object
})

let isContactLandlordEnabled = ref(false);
</script>