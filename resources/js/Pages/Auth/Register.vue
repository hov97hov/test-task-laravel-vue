<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card border-0 shadow rounded-3 my-5">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="card-title text-center mb-5 fw-light fs-5">Գրանցվել</h5>
                            <form>
                                <div class="form-floating mb-3">
                                    <input
                                        v-model="formData.name"
                                        type="text"
                                        class="form-control"
                                        id="floatingInput"
                                        placeholder="name@example.com"
                                    >
                                    <label for="floatingInput">Անուն</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        v-model="formData.email"
                                        type="text"
                                        class="form-control"
                                        id="floatingInput"
                                        placeholder="email@example.com"
                                    >
                                    <label for="floatingInput">Էլ․ Փոստ</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        v-model="formData.password"
                                        type="password"
                                        class="form-control"
                                        id="floatingPassword"
                                        placeholder="Password"
                                    >
                                    <label for="floatingPassword">Գաղտնաբառ</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input
                                        v-model="formData.password_confirmation"
                                        type="password"
                                        class="form-control"
                                        id="floatingPassword"
                                        placeholder="Password"
                                    >
                                    <label for="floatingPassword">Կրկնել գաղտնաբառ</label>
                                </div>
                                <div class="d-grid">
                                    <button
                                        @click.prevent="submit"
                                        class="btn btn-primary btn-login text-uppercase fw-bold"
                                        type="submit">Գրանցվել</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Login",
    data: () => {
        return {
            formData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        }
    },
    methods: {
        async submit() {
            await axios.post('/api/register', this.formData)
                .then(response => {
                    console.log(response)
                })
                .catch(e => {
                    console.log(e)
                })
        }
    }
}
</script>

<style scoped lang="scss">
    .btn-login {
        font-size: 0.9rem;
        letter-spacing: 0.05rem;
        padding: 0.75rem 1rem;
    }

    .btn-google {
        color: white !important;
        background-color: #ea4335;
    }

    .btn-facebook {
        color: white !important;
        background-color: #3b5998;
    }
</style>
