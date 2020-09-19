<template>
  <div class="container">
    <form @submit.prevent="submit">
      <div class="card-header">
        <i class="fas fa-plus-circle text-dark">Add Product</i>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">
            <i class="fas fa-space-shuttle text-dark">Product Name</i>
          </label>
          <div class="col-md- 6">
            <input type="text" v-model="form.name" class="form-control" required />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">
            <i class="fas fa-space-shuttle text-dark">Product Description</i>
          </label>
          <div class="col-md- 6">
            <textarea v-model="form.description" cols="30" class="form-control" required></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">
            <i class="fas fa-space-shuttle text-dark">Product Price</i>
          </label>
          <div class="col-md- 6">
            <input type="number" min="0" v-model="form.price" class="form-control" required />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">
            <i class="fas fa-space-shuttle text-dark">Category</i>
          </label>
          <div class="col-md- 6">
            <select v-model="form.category_id" class="form-control" required>
              <option v-for="cat in categories" :value="cat.id">{{ cat.name }}</option>
            </select>
          </div>
        </div>
        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-2">
            <router-link
              class="btn btn-sm"
              style="background-color: grey !important"
              :to="{ name: 'products'}"
            >Cancel</router-link>
            <button type="submit" class="btn btn-sm btn-primary">Add Product</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null,
        description: null,
        price: null,
        category_id: null,
      },
      categories: null,
    };
  },
  mounted() {
    axios
      .get(`/cat`)
      .then((response) => {
        this.categories = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    submit() {
      axios
        .post(`/prod`, this.form)
        .then((response) => {
          this.$router.push({ name: "products" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>