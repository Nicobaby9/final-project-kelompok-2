<template>
  <div class="container">
    <div class="card">
      <div class="card-header text-dark">
        <h3>Product</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="card col-md-3 m-4 text-center" v-for="prod in products">
            <h3 class="text-dark">{{ prod.name }}</h3>
            <h6 class="text-dark">{{ prod.category.name }}</h6>
            <br />
            <a href="#">OrderNow</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: null,
    };
  },
  mounted() {
    axios.get(`/prod`).then((res) => (this.products = res.data));
  },
};
</script>