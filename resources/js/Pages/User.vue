<template>
    <v-app>
        <Header/>
        <div class="user-wrapper">
            <div class="container">
                <v-breadcrumbs class="breadcrumbs" :items="breadcrumbs"></v-breadcrumbs>
                <div class="user-content">
                    <div class="user-avatar">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDJzEaxLN-jGRYYUO65pWu7Q9GXoNt4LUSSA&usqp=CAU" alt="">
                    </div>
                    <div class="user-data">
                        <p>Անուն Ազգանուն: Արման Սարգսյան</p>
                        <p>Տարիք: 42</p>
                        <p>Հեռախոսահամար: +374555555</p>
                        <p>Էլ․ Փոստ: armansargsyan2020@example.com</p>
                        <p>Խումբ: Vega</p>
                        <p>Գրանցված է: 07․25․2022</p>
                    </div>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
import axios from "axios";
import Header from '../../../resources/js/Components/Header'
import { VueEditor } from "vue2-editor";

export default {
    name: "home",
    components: {
        Header,
        VueEditor
    },
    data: () => {
        return {
            breadcrumbs: [
                {
                    text: 'Գլխավոր',
                    disabled: false,
                    href: '/',
                },
                {
                    text: 'Օգտատերեր',
                    disabled: false,
                    href: '/users',
                },
                {
                    text: 'Օգտատեր',
                    disabled: true,
                    href: '',
                },
            ],
        }
    },
    async created() {
        await this.getUsers()
    },
    methods: {
        openDialog(id){
            console.log(id)
        },
        async getUsers() {
           await axios.get(`/api/get-users`)
                .then(response => {
                    this.userData = response.data.users
                })
                .catch(e => {
                    console.log(e)
                })
        },
        updateList() {
            this.getUsers()
        }
    }
}
</script>

<style scoped lang="scss">
    //user
    .user-wrapper {
        margin-top: 50px;
        .user-content {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 3px 1px -2px
            rgb(0 0 0 / 20%), 0 2px 2px 0
            rgb(0 0 0 / 14%), 0 1px 5px 0
            rgb(0 0 0 / 12%);
            .user-avatar {
                margin-right: 20px;
                img {
                    width: 200px;
                    height: 200px;
                    border-radius: 50%;
                }
            }
            .user-data {
                p {
                    margin: 0 0 15px;
                    font-size: 18px;
                }
            }
        }
    }
</style>
