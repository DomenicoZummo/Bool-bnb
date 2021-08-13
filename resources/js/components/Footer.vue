<template>
    <footer>
        <div class="container d-flex">
            <div class="col-md-6 d-flex align-items-end">
                © 2021 Boolbnb.
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <ul class="d-flex">
                    <li class="d-flex flex-column">
                        <div>
                            <a
                                href="https://www.linkedin.com/in/fabio-bollettini/"
                            >
                                <i class="fab fa-linkedin-in mr-1"></i>
                                Fabio Bollettini
                            </a>
                        </div>

                        <div>
                            <a
                                href="https://www.linkedin.com/in/emilianoproietti/"
                            >
                                <i class="fab fa-linkedin-in mr-1"></i>
                                Emiliano Proietti
                            </a>
                        </div>
                    </li>

                    <li class="d-flex flex-column ml-5">
                        <div>
                            <a
                                href="https://www.linkedin.com/in/domenico-zummo/"
                            >
                                <i class="fab fa-linkedin-in mr-1"></i>
                                Domenico Zummo
                            </a>
                        </div>
                        <div>
                            <a
                                href="https://www.linkedin.com/in/giuseppe-mandriani/"
                            >
                                <i class="fab fa-linkedin-in mr-1"></i>
                                Giuseppe Mandriani
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer"
};
</script>

<style scoped lang="scss">
footer {
    padding: 20px;
    background-color: #f7f7f7;
    li {
        list-style: none;
        a {
            color: black;
            i {
                color: #0a66c2;
            }
        }
    }
}

.title-footer {
    text-transform: uppercase;
}
</style>
