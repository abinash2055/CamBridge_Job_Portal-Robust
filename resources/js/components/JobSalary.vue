<template>
  <div class="job-salary">
    <h2 class="mb-3">Jobs by Salary Range</h2>
    <div class="form-group">
      <label for="salary-select">Select Salary Range:</label>
      <select id="salary-select" class="form-control" @change="filterJobsBySalary">
        <option disabled selected value="">-- Select Salary Range --</option>
        <option v-for="range in salaryRanges" :key="range" :value="range">
          {{ range }}
        </option>
      </select>
    </div>

    <div v-if="posts.length === 0" class="alert alert-warning">
      No Jobs found for this salary range.
    </div>

    <div v-else>
      <SearchResult :posts="posts" />
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import SearchResult from './SearchResult';

export default {
  name: 'JobSalary',
  components: {
    SearchResult,
  },
  data() {
    return {
      salaryRanges: [
        "10000 - 20000", "20000 - 30000", "30000 - 40000",
        "40000 - 50000", "50000 - 60000", "60000 - 70000",
        "70000 - 80000", "80000 - 90000", "90000 - 100000",
        "100000 - 110000", "110000 - 120000", "120000 - 130000",
        "130000 - 140000", "140000 - 150000", "150000 - 160000",
        "160000 - 170000", "170000 - 180000", "180000 - 190000",
        "190000 - 200000",
      ],
      posts: [],
    };
  },
  methods: {
    filterJobsBySalary(event) {
      const selectedSalaryRange = event.target.value;
      this.getJobsBySalary(selectedSalaryRange);
    },
    getJobsBySalary(range) {
      const [minSalary, maxSalary] = range.split(' - ').map(Number);
      this.$Progress.start();
      axios
        .get(`/api/jobs?min_salary=${minSalary}&max_salary=${maxSalary}`)
        .then((res) => {
          this.posts = res.data;
          this.$Progress.finish();
        })
        .catch((err) => {
          console.error(err);
          this.$Progress.fail();
        });
    },
  },
};
</script>

<style scoped>
.job-salary {
  padding: 1rem;
}
</style>
