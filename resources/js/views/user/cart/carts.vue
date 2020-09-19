<template>
  <div class="container">
    <div class="card">
      <div class="card-header text-dark">Carts</div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Product</th>
              <th scope="col">Harga Total</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(cart, key) in carts" :key="key">
              <td>{{ key +1 }}</td>
              <td>{{ cart.product.name }}</td>
              <td>{{ cart.product.price * cart.jumlah }}</td>
              <td>
                <button
                  class="btn btn-sm btn-info mr-1"
                  @click="updateCart(cart.id, cart.jumlah - 1)"
                >-</button>
                {{ cart.jumlah }}
                <button
                  class="btn btn-sm btn-info ml-1"
                  @click="updateCart(cart.id, cart.jumlah + 1)"
                >+</button>
              </td>
              <td>
                <button class="btn btn-sm btn-danger" @click="destroy(cart.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="d-inline">
          <h4 class="text-dark">
            Total :
            <span style="font-weight: 800;">{{ total }}</span>
          </h4>
          <button class="btn btn-primary float-right">Proses</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      carts: [],
      total: null,
    };
  },
  mounted() {
    this.getCart();
  },
  methods: {
    getCart() {
      axios
        .get(`/cart`)
        .then((res) => {
          this.carts = res.data;
          var jum = this.carts.map(({ jumlah }) => jumlah);
          var prod = this.carts.map(({ product }) => product.price);

          var sum = 0;
          for (var i = 0; i < jum.length; i++) {
            sum += jum[i] * prod[i];
          }
          this.total = sum;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    updateCart(id, jumlah) {
      axios.put(`/cart/${id}`, { jumlah: jumlah }).then((res) => {
        this.getCart();
      });
    },
    destroy(id) {
      axios.delete(`/cart/${id}`).then((res) => {
        this.getCart();
      });
    },
  },
};
</script>