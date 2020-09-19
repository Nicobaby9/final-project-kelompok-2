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
          <button class="btn btn-primary float-right" @click="proses(cartid, total)">Proses</button>
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
      cartid: null,
    };
  },
  mounted() {
    this.getCart();
    let midtrans = document.createElement("script");
    midtrans.setAttribute(
      "src",
      "https://app.sandbox.midtrans.com/snap/snap.js"
    );
    midtrans.setAttribute("data-client-key", "SB-Mid-client-cX9qxpkQWBbjBIH4");
    document.head.appendChild(midtrans);
  },
  methods: {
    getCart() {
      axios
        .get(`/cart`)
        .then((res) => {
          this.carts = res.data;
          var jum = this.carts.map(({ jumlah }) => jumlah);
          var prod = this.carts.map(({ product }) => product.price);
          var carti = this.carts.map(({ id }) => id);
          this.cartid = carti;
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
    proses(c, t) {
      axios.post(`/order`, { cart: c, total: t }).then((res) => {
        axios.post(`/order/midtrans`, { data: res.data }).then((response) => {
          snap.pay(response.data.data.token);
        });
      });
    },
  },
};
</script>