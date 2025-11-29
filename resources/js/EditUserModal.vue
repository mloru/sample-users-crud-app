<template>
    <div v-if="showEditModal" class="modal">
        <div class="modal-content">
            <span class="close" @click="closeEditModal">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </span>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" v-model="editedUser.name" required @keyup.enter="editedUser.id ? updateUser() : insertNewUser()">
                <div class="error-message"
                     v-text="errors.name">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="editedUser.email" required @keyup.enter="editedUser.id ? updateUser() : insertNewUser()">
                <div class="error-message"
                     v-text="errors.email">
                </div>
            </div>
            <div class="form-group">
                <label for="password"
                       v-text="editedUser.id ? 'Password (lasciare vuoto per non modificare):' : 'Password'"
                >
                </label>
                <input type="password"
                       id="password"
                       v-model="editedUser.password"
                       @keyup.enter="editedUser.id ? updateUser() : insertNewUser()"
                >
                <div class="error-message"
                     v-text="errors.password">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation"
                       v-text="editedUser.id ? 'Conferma password (lasciare vuoto per non modificare):' : 'Conferma password'"
                >
                </label>
                <input type="password"
                       id="password_confirmation"
                       v-model="editedUser.password_confirmation"
                       :required="editedUser.password.toString().length > 0"
                       @keyup.enter="editedUser.id ? updateUser() : insertNewUser()"
                >
                <div class="error-message"
                     v-text="errors.password_confirmation">
                </div>
            </div>
            <div class="form-actions">
                <button type="button" @click="closeEditModal">
                    Annulla
                </button>
                <button type="button"
                        @click="editedUser.id ? updateUser() : insertNewUser()"
                        class="btn-confirm"
                        v-text="editedUser.id ? 'Aggiorna' : 'Crea'"
                >
                </button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'EditUserModal',
        props: {
            closeEditModal: {},
            editedUser: {},
            showEditModal: {},
            updateUser: {},
            insertNewUser: {},
            errors: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
        }
    }
</script>
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

    .error-message {
        color: #d32f2f;
        font-size: 0.875rem;
        margin-top: 4px;
        min-height: 1.25rem;
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

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>
