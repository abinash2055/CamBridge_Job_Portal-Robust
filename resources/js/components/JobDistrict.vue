<template>
    <div class="job-district">
        <h2 class="mb-3">Jobs by District</h2>
        <div class="form-group">
            <label for="district-select">Select District:</label>
            <select
                id="district-select"
                class="form-control"
                @change="filterJobsByDistrict"
            >
                <option disabled selected value="">
                    -- Select a District --
                </option>
                <option
                    v-for="district in districts"
                    :key="district"
                    :value="district"
                >
                    {{ district }}
                </option>
            </select>
        </div>

        <div v-if="posts.length === 0" class="alert alert-warning">
            No Jobs found for this district.
        </div>

        <div v-else>
            <SearchResult :posts="posts" />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import SearchResult from "./SearchResult";

export default {
    name: "JobDistrict",
    components: {
        SearchResult,
    },
    data() {
        return {
            districts: [
                // Include your 77 districts here
                "Achham",
                "Arghakhanchi",
                "Baglung",
                "Baitadi",
                "Bajhang",
                "Bajura",
                "Banke",
                "Bara",
                "Bardiya",
                "Bhaktapur",
                "Bhojpur",
                "Chitwan",
                "Dadeldhura",
                "Dailekh",
                "Dang",
                "Darchula",
                "Dhading",
                "Dhankuta",
                "Dhanusha",
                "Dolakha",
                "Dolpa",
                "Doti",
                "Eastern Rukum",
                "Gorkha",
                "Gulmi",
                "Humla",
                "Ilam",
                "Jajarkot",
                "Jhapa",
                "Jumla",
                "Kailali",
                "Kalikot",
                "Kanchanpur",
                "Kapilvastu",
                "Kaski",
                "Kathmandu",
                "Kavrepalanchok",
                "Khotang",
                "Lalitpur",
                "Lamjung",
                "Mahottari",
                "Makwanpur",
                "Manang",
                "Morang",
                "Mugu",
                "Mustang",
                "Myagdi",
                "Nawalpur",
                "Nuwakot",
                "Okhaldhunga",
                "Palpa",
                "Panchthar",
                "Parasi",
                "Parbat",
                "Parsa",
                "Pyuthan",
                "Ramechhap",
                "Rasuwa",
                "Rautahat",
                "Rolpa",
                "Rupandehi",
                "Salyan",
                "Sankhuwasabha",
                "Saptari",
                "Sarlahi",
                "Sindhuli",
                "Sindhupalchok",
                "Siraha",
                "Solukhumbu",
                "Sunsari",
                "Surkhet",
                "Syangja",
                "Tanahun",
                "Taplejung",
                "Terhathum",
                "Udayapur",
                "Western Rukum",
            ],
            posts: [],
        };
    },
    methods: {
        filterJobsByDistrict(event) {
            const selectedDistrict = event.target.value;
            this.getJobsByDistrict(selectedDistrict);
        },
        getJobsByDistrict(district) {
            this.$Progress.start();
            axios
                .get(`/api/jobs?district=${district}`)
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
.job-district {
    padding: 1rem;
}
</style>
