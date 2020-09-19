<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        Log Activity
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Log Name</th>
              <th scope="col">Description</th>
              <th scope="col">Subject Type</th>
              <th scope="col">Properties</th>
              <th scope="col">Created At</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(log, key) in logs" :key="key">
              <!-- <th scope="row">{{ key + 1 }}</th> -->
              <td>{{ log.id }}</td>
              <td>{{ log.log_name }}</td>
              <td>{{ log.description }}</td>
              <td>{{ log.subject_type }}</td>
              <td>{{ log.properties }}</td>
              <td>{{ log.created_at }}</td>
              <td>
                <button small class="btn btn-sm btn-danger" @click="destroy(log.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import BusEvent from "../components/bus";
export default {
  data() {
    return {
      logs: [],
    };
  },
  mounted() {
    this.Activity();
  },
  methods: {
    Activity() {
      axios
        .get(`/log`)
        .then((response) => {
          this.logs = response.data;
          console.log(this.log);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    destroy(id) {
      axios
        .delete(`/log/${id}`)
        .then((response) => this.Activity())
        .catch((error) => {
          console.log(error);
          this.errored = true;
        });
    },
  },
};
</script>