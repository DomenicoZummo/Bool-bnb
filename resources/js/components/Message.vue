<template>
    <div class="container">
        <h1 class="mb-3 title">Send a message to the host</h1>
        <div v-show="success" class="alert alert-success">
            Message sent succesfully
        </div>
        <form @submit.prevent="postForm(apartment.id)">
            <!-- Name -->
            <div class="form-group">
                <label for="name" class="title">Name</label>
                <input v-model="name" type="text" id="name" class="max-width" />
                <div
                    class="error-message"
                    v-for="(error, index) in errors.name"
                    :key="`err-name-${index}`"
                >
                    {{ error }}
                </div>
            </div>
            <!-- Surname -->
            <div class="form-group">
                <label for="surname" class="title">Surname</label>
                <input
                    v-model="surname"
                    type="text"
                    id="surname"
                    class="max-width"
                />
                <div
                    class="error-message"
                    v-for="(error, index) in errors.surname"
                    :key="`err-surname-${index}`"
                >
                    {{ error }}
                </div>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email" class="title">Email *</label>
                <input
                    v-model="email"
                    type="email"
                    id="email"
                    class="max-width"
                />
                <div
                    class="error-message"
                    v-for="(error, index) in errors.email"
                    :key="`err-email-${index}`"
                >
                    {{ error }}
                </div>
            </div>
            <!-- Message -->
            <div class="form-group">
                <label for="message" class="title">Message *</label>
                <textarea
                    class="max-width"
                    v-model="message"
                    type="text"
                    cols="30"
                    rows="10"
                    id="message"
                ></textarea>
                <div
                    class="error-message"
                    v-for="(error, index) in errors.message"
                    :key="`err-message-${index}`"
                >
                    {{ error }}
                </div>
            </div>
            <!-- Submit button -->
            <div class="d-flex justify-content-center">
                <button
                    type="submit"
                    :disabled="sending"
                    class="btn btn-boolbnb"
                >
                    {{ sending ? "Sending..." : "Send" }}
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Message",
    props: {
        apartment: Object
    },
    data() {
        return {
            name: "",
            surname: "",
            email: "",
            message: "",
            errors: {},
            success: false,
            sending: false
        };
    },

    created() {
        this.getUserInfos();
    },
    methods: {
        postForm(id) {
            this.sending = true;

            axios
                .post(`http://127.0.0.1:8000/api/messages`, {
                    name: this.name,
                    surname: this.surname,
                    email: this.email,
                    message: this.message,
                    apartment_id: id
                })
                .then(res => {
                    this.sending = false;

                    if (res.data.errors) {
                        this.errors = res.data.errors;
                        this.success = false;
                    } else {
                        this.name = "";
                        (this.surname = ""), (this.email = "");
                        this.message = "";
                        this.success = true;
                        this.errors = {};
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        },
        getUserInfos() {
            axios
                .get(`http://127.0.0.1:8000/admin/user`)
                .then(res => {
                    this.name = res.data.name;
                    this.surname = res.data.surname;
                    this.email = res.data.email;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
.title {
    font-weight: 600;
}

.max-width {
    width: 100%;
}

.success-message {
    margin-bottom: 2rem;
    color: limegreen;
    font-size: 1.2rem;
}

.form-group {
    margin-bottom: 1rem;
    label {
        display: block;
    }
    .error-message {
        color: red;
    }
}

.btn-boolbnb {
    background: #ff385c;
    outline: none;
    color: #fff;
    font-size: 18px;
    padding: 5px 20px;
    border-radius: 25px;
    border: 1px solid transparent;
    transition: color 0.3s, background-color 0.4s, border-color 0.4s;
    &:hover {
        color: #ff385c;
        border-color: #ff385c;
        background: #fff;
    }
}

button:disabled {
    cursor: not-allowed;
}
</style>
