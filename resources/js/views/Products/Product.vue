<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        List Categories
        <router-link class="btn btn-md btn-primary float-right" :to="{name: 'createProd'}">Create</router-link>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Description</th>
              <th scope="col">Price</th>
              <th scope="col">Category</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(prod, key) in prods" :key="key">
              <th scope="row">{{ key + 1 }}</th>
              <td>{{ prod.name }}</td>
              <td>{{ prod.description }}</td>
              <td>{{ prod.price }}</td>
              <td>{{ prod.category.name }}</td>
              <td>
                <router-link
                  :to="{ name:'editProd', params: {id:prod.id} }"
                  class="btn btn-sm btn-info"
                >Edit</router-link>
                <button small class="btn btn-sm btn-danger" @click="destroy(prod.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      prods: [],
    };
  },
  mounted() {
    this.Product();
  },
  methods: {
    Product() {
      axios
        .get(`/prod`)
        .then((response) => {
          this.prods = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    destroy(id) {
      axios
        .delete(`prod/${id}`)
        .then((response) => this.Product())
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },
  },
};
</script>