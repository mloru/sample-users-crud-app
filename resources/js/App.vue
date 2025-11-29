<template>
    <div v-if="showEditModal" class="modal">
        <div class="modal-content">
            <span class="close" @click="closeEditModal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </span>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" v-model="editedUser.name" required @keyup.enter="updateUser">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="editedUser.email" required @keyup.enter="updateUser">
            </div>
            <div class="form-actions">
                <button type="button" @click="closeEditModal">
                    Annulla
                </button>
                <button type="button" @click="updateUser" class="btn-confirm">
                    Salva
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="btn-container">
            <button class="btn-confirm">Crea utente</button>
        </div>
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
                        <button @click="openEditModal(user)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </button>
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

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 4px;
        width: 90%;
        max-width: 500px;
    }

    .close {
        float: right;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
    }

    .form-actions {
        margin-top: 20px;
        text-align: right;
    }

    .form-actions button {
        padding: 8px 15px;
        margin-left: 10px;
        cursor: pointer;
        border: 1px solid #ddd;
    }

    .btn-confirm {
        background: #04AA6D;
        color: white;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 4px;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .btn-container {
        margin-bottom: 20px;
    }

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
                users: [],
                showEditModal: false,
                editedUser: {
                    id: null,
                    name: '',
                    email: ''
                }
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

                if (!confirm(`Eliminare l'utente ${user.name}?`)) {
                    return;
                }

                await axios.delete(`/api/users/${id}`);
                await this.readUsersList();
            },
            openEditModal(user) {
                this.editedUser.id = user.id;
                this.editedUser.name = user.name;
                this.editedUser.email = user.email;

                this.showEditModal = true;
            },
            closeEditModal() {
                this.showEditModal = false;

                this.editedUser = {
                    id: null,
                    name: '',
                    email: ''
                };
            },
            async updateUser() {
                try {
                    await axios.patch(
                        `/api/users/${this.editedUser.id}`,
                        {
                            name: this.editedUser.name,
                            email: this.editedUser.email
                        }
                    );

                    this.closeEditModal();
                    await this.readUsersList();
                } catch (error) {
                    console.error(`Errore aggiornamento utente: `, error);
                    alert(`Si è verificato un errore durante l'aggiornamento dell'utente.`);
                }
            }
        }
    };
</script>
