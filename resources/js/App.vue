<template>
    <div v-if="!users.length">
        Nessun utente presente sul database
    </div>
    <table v-if="users.length">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Data creazione</th>
                <th>Data ultima modifica</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ new Date(user.created_at).toLocaleString('it-IT') }}</td>
                <td>{{ new Date(user.updated_at).toLocaleString('it-IT') }}</td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2;}

    tr:hover {background-color: #ddd;}

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>

<script>
    export default {
        data() {
            return {
                users: []
            };
        },
        async mounted() {
            const response = await axios.get('/api/users');
            this.users = response.data;
        }
    };
</script>
