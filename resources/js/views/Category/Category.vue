<template>
  <div class="container">
    <div class="card">
      <div class="card-header text-dark">
        List Categories
        <router-link class="btn btn-md btn-primary float-right" :to="{name: 'createCat'}">Create</router-link>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Description</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(categ, key) in cats" :key="key">
              <th scope="row">{{ key + 1 }}</th>
              <td>{{ categ.name }}</td>
              <td>{{ categ.description }}</td>
              <td>
                <router-link
                  :to="{ name:'editCat', params: {id:categ.id} }"
                  class="btn btn-sm btn-info"
                >Edit</router-link>
                <button small class="btn btn-sm btn-danger" @click="destroy(categ.id)">Delete</button>
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
      cats: [],
    };
  },
  mounted() {
    this.Category();
  },
  methods: {
    Category() {
      axios
        .get(`/cat`)
        .then((response) => {
          this.cats = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    destroy(id) {
      axios
        .delete(`/cat/${id}`)
        .then((response) => console.log(response), this.Category())
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>