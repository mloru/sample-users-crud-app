<template>
    <EditUserModal :close-edit-modal="closeEditModal"
                   :edited-user="editedUser"
                   :show-edit-modal="showEditModal"
                   :update-user="updateUser"
                   :insert-new-user="insertNewUser"
                   :errors="errors"
    />

    <div class="container">
        <div class="btn-container">
            <button @click="editNewUser" class="btn-confirm">Crea utente</button>
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
                        <button @click="editExistingUser(user)">
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

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
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
    import EditUserModal from "./EditUserModal.vue";

    export default {
        components: {
            EditUserModal
        },
        data() {
            return {
                users: [],
                showEditModal: false,
                editedUser: {
                    id: null,
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
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
            editNewUser() {
                this.showEditModal = true;
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
            editExistingUser(user) {
                this.editedUser.id = user.id;
                this.editedUser.name = user.name;
                this.editedUser.email = user.email;

                this.showEditModal = true;
            },
            closeEditModal() {
                this.showEditModal = false;
                this.clearEditModal();
            },
            clearEditModal() {
                this.editedUser = {
                    id: null,
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                };
            },
            async updateUser() {
                let payload = {
                    name: this.editedUser.name,
                    email: this.editedUser.email
                }

                if (this.editedUser.password) {
                    payload.password = this.editedUser.password;
                    payload.password_confirmation = this.editedUser.password_confirmation;
                }

                try {
                    await axios.patch(
                        `/api/users/${this.editedUser.id}`,
                        payload
                    );

                    this.closeEditModal();
                    await this.readUsersList();
                } catch (error) {
                    if (error.response && error.response.status === 422) {
                        this.errors = {};

                        Object.entries(error.response.data)
                            .forEach(([fieldName, errorMessages]) => { this.errors[fieldName] = errorMessages.join(' '); });
                    } else {
                        console.error('Errore aggiornamento utente:', error);
                        alert('Errore aggiornamento utente');
                    }
                }
            },
            async insertNewUser() {
                try {
                    await axios.post(
                        `/api/users`,
                        {
                            name: this.editedUser.name,
                            email: this.editedUser.email,
                            password: this.editedUser.password,
                            password_confirmation: this.editedUser.password_confirmation
                        }
                    );

                    this.closeEditModal();
                    await this.readUsersList();
                } catch (error) {
                    if (error.response && error.response.status === 422) {
                        this.errors = {};

                        Object.entries(error.response.data)
                            .forEach(([fieldName, errorMessages]) => { this.errors[fieldName] = errorMessages.join(' '); });
                    } else {
                        console.error('Errore creazione utente:', error);
                        alert('Errore aggiornamento utente');
                    }
                }
            }
        }
    };
</script>
