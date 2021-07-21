<template>
    <div class="container">
        <h1 class="mb-5">Send us a message</h1>

        <div v-show="success" class="succes-message">
            Message sent succesfully
        </div>
        <form @submit.prevent="postForm(apartment.id)">
            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input v-model="name" type="text" id="name" class="max-width" />
                <div
                    class="error-message"
                    v-for="(error, index) in errors.name"
                    :key="`err-name-${index}`"
                >
                    {{ error }}
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
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
                <label for="message">Message</label>
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
                    class="btn btn-success"
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
                        this.email = "";
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
                    console.log(res.data);
                    this.name = res.data.name;
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

button:disabled {
    cursor: not-allowed;
}
</style>
