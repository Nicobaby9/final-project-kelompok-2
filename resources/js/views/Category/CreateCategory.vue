<template>
  <div class="container">
    <form @submit.prevent="submit">
      <div class="card-header">
        <i class="fas fa-plus-circle">Add Category</i>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">
            <i class="fas fa-space-shuttle">Category Name</i>
          </label>
          <div class="col-md- 6">
            <input type="text" v-model="form.name" class="form-control" required />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2 col-form-label text-md-right">
            <i class="fas fa-space-shuttle">Category Description</i>
          </label>
          <div class="col-md- 6">
            <textarea v-model="form.description" cols="30" class="form-control" required></textarea>
          </div>
        </div>
        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-2">
            <router-link
              class="btn btn-sm"
              style="background-color: grey !important"
              :to="{ name: 'category'}"
            >Cancel</router-link>
            <button type="submit" class="btn btn-sm btn-primary">Add Category</button>
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
      },
    };
  },
  methods: {
    submit() {
      axios
        .post(`/cat`, this.form)
        .then((response) => {
          this.$router.push({ name: "category" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>