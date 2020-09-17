<template>
  <div class="container">
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'category'}">Category</router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'products'}">Product</router-link>
    </li>
    <li class="nav-item">
      <router-link class="nav-link" :to="{ name: 'chat'}">Chat with Admin</router-link>
    </li>
  </div>
</template>
<script>
export default {};
</script>

<style lang="scss">
.container {
  border-radius: 10px;
  color: white;
}
</style>