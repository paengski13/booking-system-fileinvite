<template>
  <div>
    <form @submit.prevent="updateRecord">
      <div class="mb-4">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
          Room
        </label>
        <div class="relative">
          <!-- TODO: Create a new API to fetch list of available rooms -->
          <select v-model="booking.room_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option>Select dropdown</option>
            <option value="1" :selected="booking.room_id === 1">Auckland</option>
            <option value="2" :selected="booking.room_id === 2">Wellington</option>
            <option value="4" :selected="booking.room_id === 4">Christchurch</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">
          Starts At
        </label>
        <input type="text" v-model="booking.starts_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">
          Ends At
        </label>
        <input type="text" v-model="booking.ends_at"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">
          Notes
          <textarea class="shadow form-textarea mt-1 block w-full border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3"></textarea>
        </label>
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Submit
        </button>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        booking: {}
      }
    },
    created() {
      this.axios
        .get(`https://booking-system-fileinvite.local/api/bookings/${this.$route.params.id}`)
        .then((response) => {
          this.booking = response.data.booking;
          this.booking.room_id = this.booking.room.id;
        })
    },
    methods: {
      updateRecord() {
        this.axios
            .put(`https://booking-system-fileinvite.local/api/bookings/${this.$route.params.id}`, {
              room_id: this.booking.room.id,
              starts_at: this.booking.starts_at,
              ends_at: this.booking.ends_at,
            })
            .then((response) => {
              this.$router.push({name: 'home'});
            });
      }
    }
  }
</script>