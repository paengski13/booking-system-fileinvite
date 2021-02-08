<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <router-link to="/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Home</router-link>
          <router-link to="/add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Book a Room</router-link>
        </div>
      </div>
    </nav>
    <br/>
    <router-view></router-view>
  </div>
</template>

<script>
  export default {}
</script>