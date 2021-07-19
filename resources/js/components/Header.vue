<template>
    <header class="text-center  bg-primary navbar-dark  fixed-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">Boolbnb</a>
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
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'home' }"
                                >Home</router-link
                            >
                        </li>
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                :to="{ name: 'advancedsearch' }"
                                >Advanced Search</router-link
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Host</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header"
};
</script>

<style scoped lang="scss"></style>>
