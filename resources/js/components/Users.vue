<template>
    <div>
        <h4 class="text-center">All Users</h4><br/>
        <button type="button" class="btn btn-info" @click="this.$router.push('/users/add')">Add User</button>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="account in accounts" :key="account.id">
                <td>{{ account.id }}</td>
                <td>{{ account.name }}</td>
                <td>{{ account.email }}</td>
                <td>{{ account.phone_number }}</td>
                <td>{{ account.created_at }}</td>
                <td>{{ account.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'payments', params: { id: account.id }}" class="btn btn-success">Payments
                        </router-link>
                        <router-link :to="{name: 'edituser', params: { id: account.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteUser(account.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            accounts: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/users')
                .then(response => {
                    this.accounts = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteUser(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/users/${id}`)
                    .then(response => {
                        let i = this.accounts.map(item => item.id).indexOf(id);
                        this.accounts.splice(i, 1)
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
