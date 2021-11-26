<template>
    <div>
        <h4 class="text-center">Add User</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addAccount">
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
                    <button type="submit" class="btn btn-primary">Add User</button>
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
    methods: {
        addAccount() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/users', this.account)
                    .then(response => {
                        this.$router.push({name: 'users'})
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
