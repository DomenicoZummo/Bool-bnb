<template>
    <header
        :class="{
            fixedHeader: this.$route.name == 'apartment-details' || isFixed
        }"
        class="text-center  navbar-dark  fixed-top"
        ref="header"
    >
        <nav class="navbar navbar-expand-lg  d-flex align-items-center">
            <div class="container">
                <router-link class="navbar-brand d-flex align-items-center" :to="{ name: 'home' }"
                    >
                    <i class="fas fa-home"></i><span class="logo mx-2">Boolbnb</span>
                </router-link>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <router-link
                                id="text-header"
                                class="nav-link"
                                :to="{ name: 'home' }"
                                >Home</router-link
                            >
                        </li>
                        <li class="nav-item">
                            <router-link
                                id="text-header"
                                class="nav-link"
                                :to="{ name: 'advancedsearch' }"
                                >Advanced Search</router-link
                            >
                        </li>
                    </ul>
                    <div class="navbar-dark">
                        <ul class="navbar-nav">
                            <li v-if="!userLog" class="nav-item ">
                                <a class="nav-link" id="host" href="/admin"
                                    >Become a host</a
                                >
                            </li>

                            <li v-else class="nav-item ">
                                <a class="nav-link" id="user" href="/admin"
                                    ><i class="fas fa-user-circle mr-2"></i
                                    >{{ nameUser }}</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import axios from "axios";
export default {
    name: "Header",
    data() {
        return {
            isFixed: false,
            nameUser: "User",
            userLog: false
        };
    },
    created() {
        this.getUserName();
    },
    mounted() {
        // Update isFixed value on scroll
        window.onscroll = () => {
            let header = this.$refs.header;
            if (window.scrollY > header.offsetTop) {
                this.isFixed = true;
            } else {
                this.isFixed = false;
            }
        };
    },
    methods: {
        getUserName() {
            (this.userLog = false),
                axios
                    .get("http://127.0.0.1:8000/admin/user")
                    .then(res => {
                        this.userLog = true;
                        this.nameUser = res.data.name;
                    })
                    .catch(error => {
                        console.log(error);
                    });
        }
    }
};
</script>

<style scoped lang="scss">
header {
    background: transparent;
    height: 100px;
    box-shadow: 0px 85px 15px #000000ad inset;
    transition: background-color 0.7s, box-shadow 0.3s;
    &.fixedHeader {
        background: #ff385c;
        box-shadow: none;
        height: 80px;
    }
    #host {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
        width: 150px;
        color: #fff;
        border: 1px solid #fff;
        border-radius: 30px;
        padding: 0 10px 0 10px;
        transition: all 0.3s;

        &:hover {
            background: #fff;
            color: #ff385c;
        }
    }

    .navbar-expand-lg {
        height: 100%;
    }

    .navbar-nav {
        flex-basis: 100%;
    }
}

#user {
    i {
        font-size: 30px;
    }
    font-size: 20px;
    display: flex;
    align-items: center;
    color: #fff;
    border-radius: 10px;
    border-bottom: 2px solid transparent;
    transition: border 0.3s;

    &:hover {
        border-color: #fff;
    }
}

.fas.fa-home{
    font-size: 32px;
}
</style>
