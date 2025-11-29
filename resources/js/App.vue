<template>
    <div v-if="users.length">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data creazione</th>
                    <th>Data ultima modifica</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ new Date(user.created_at).toLocaleString('it-IT') }}</td>
                    <td>{{ new Date(user.updated_at).toLocaleString('it-IT') }}</td>
                    <td>
                        <button @click="deleteUser(user.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        Nessun utente presente sul database
    </div>
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
            await this.readUsersList();
        },
        methods: {
            async readUsersList() {
                const response = await axios.get('/api/users');
                this.users = response.data;
            },
            async deleteUser(id) {
                let user = this.users
                            .find(
                                user => user.id === id
                            );

                if (!confirm('Eliminare l\'utente ' + user.name + '?')) {
                    return;
                }

                await axios.delete('/api/users/' + id);
                await this.readUsersList();
            },
        }
    };
</script>
