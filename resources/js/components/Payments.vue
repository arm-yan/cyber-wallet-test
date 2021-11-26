<template>
    <div>
        <h4 class="text-center">All payments</h4>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Number</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="payment in payments" :key="payment.id">
                    <td>{{ payment.id }}</td>
                    <td>{{ payment.number }}</td>
                    <td>{{ payment.amount }}</td>
                    <td>{{ payment.status }}</td>
                    <td>{{ payment.created_at }}</td>
                    <td>{{ payment.updated_at }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            payments: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/users/${this.$route.params.id}/payments`)
                .then(response => {
                    this.payments = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        generatePayment() {
                //
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
