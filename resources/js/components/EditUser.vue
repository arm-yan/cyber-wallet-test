<template>
    <div>
        <h4 class="text-center">Edit User</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateAccount">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="account.name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" v-model="account.email">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" v-model="account.phone_number">
                    </div>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            account: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/users/${this.$route.params.id}`)
                .then(response => {
                    this.account = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateAccount() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/users/${this.$route.params.id}`, this.account)
                    .then(response => {
                        this.$router.push({name: 'users'});
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
