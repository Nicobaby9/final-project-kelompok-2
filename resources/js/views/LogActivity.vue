<template>
  <div class="container">
    <div class="card">
      <div class="card-header text-dark">Log Activity</div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Log Name</th>
              <th scope="col">Description</th>
              <th scope="col">Subject Type</th>
              <th scope="col">Properties</th>
              <th scope="col">Created At</th>
              <th scope="col">ID</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(log, key) in logs" :key="key">
              <td scope="row">{{ key + 1 }}</td>
              <td>{{ log.log_name }}</td>
              <td>{{ log.description }}</td>
              <td>{{ log.subject_type }}</td>
              <td>{{ log.properties }}</td>
              <td>{{ log.created_at }}</td>
              <td>{{ log.id }}</td>
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
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>