<template>
    <v-app>
        <Header/>
           <div class="users-wrapper">
               <div class="container">
                   <v-breadcrumbs class="breadcrumbs" :items="breadcrumbs"></v-breadcrumbs>
                   <div class="users-content">
                       <div class="mailing-right-list">
                           <div class="right-list-action">
                               <div class="action-btn-content">
                                   <v-btn
                                       color="deep-orange darken-2"
                                       dark
                                   >
                                       Ջնջել
                                   </v-btn>
                               </div>
                               <div class="action-btn-content">
                                   <v-btn
                                       class="send-message"
                                       dark
                                   >
                                       <span>Ուղարկել նամակ</span>
                                       <v-icon>mdi-email-outline</v-icon>
                                   </v-btn>
                               </div>
                           </div>
                           <v-card>
                               <v-card-title>
                                   <v-text-field
                                       v-model="search"
                                       append-icon="mdi-magnify"
                                       label="Որոնել"
                                       single-line
                                       hide-details
                                       color="green accent-4"
                                   ></v-text-field>
                               </v-card-title>
                               <v-data-table
                                   :headers="headers"
                                   :items="desserts"
                                   :search="search"
                                   :single-select="singleSelect"
                                   item-key="name"
                                   solo
                                   show-select
                                   :footer-props="{
                                    showFirstLastPage: true,
                                    'items-per-page-text':'Գնալ',
                                 }"
                               >
                                   <template v-slot:body="{ items, options }">
                                       <tbody>
                                       <tr
                                           v-for="item in items"
                                           :key="item.id"
                                           @click="openDialog(item)"
                                           class="table-tr"
                                       >
                                           <td>
                                               <v-checkbox
                                                   :value="item"
                                                   item-value="id"
                                                   hide-details
                                                   color="green accent-4"
                                               />
                                           </td>
                                           <td>
                                               <button>{{item.name}}</button>
                                           </td>
                                           <td>
                                               <button>{{item.calories}}</button>
                                           </td>
                                           <td>
                                               <button>{{item.fat}}</button>
                                           </td>
                                           <td>
                                               <button>{{item.carbs}}</button>
                                           </td>
                                           <td>
                                               <button>{{item.protein}}</button>
                                           </td>
                                           <td>
                                               <div class="table-action">
                                                   <div class="action-item">
                                                       <v-btn @click="deleteUser = true">
                                                           <v-icon>mdi-delete</v-icon>
                                                       </v-btn>
                                                   </div>
                                               </div>
                                           </td>
                                       </tr>
                                       </tbody>
                                   </template>
                               </v-data-table>
                           </v-card>
                       </div>
                   </div>
               </div>
           </div>
        <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
        >
            <v-card>
                <v-toolbar
                    color="green accent-4"
                >
                    <v-btn
                        icon
                        dark
                        @click="dialog = false"
                    >
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title class="text-white">Գրել Նոր նամակ</v-toolbar-title>
                </v-toolbar>
                    <v-container>
                        <div class="message-dialog-content">
                            <div class="write-message-content">
                                <div class="mailing-field-content">
                                    <v-text-field
                                        label="ում"
                                        solo
                                        hide-details
                                    ></v-text-field>
                                </div>
                                <div class="mailing-field-content">
                                    <v-text-field
                                        label="Թեմա"
                                        solo
                                        hide-details
                                    ></v-text-field>
                                </div>
                                <div class="mailing-field-content">
                                    <vue-editor
                                    >
                                    </vue-editor>
                                </div>
                                <div class="mailing-button-field-content">
                                    <v-btn color="green accent-4" dark>
                                        Ուղարկել
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                    </v-container>
            </v-card>
        </v-dialog>
        <!--DELETE USER-->
        <v-dialog
            v-model="deleteUser"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Ջնջել օգտատիրոջը խմբից
                </v-card-title>
                <v-card-text>Համոզված եղեք, որ ուզում եք ջնջել օգտատիրոջը խմբից։</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green accent-4"
                        text
                        @click="deleteUser = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="deep-orange darken-2"
                        text
                        @click="deleteUser = false"
                    >
                        Ջնջել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
            deleteUser: false,
            dialog: false,
            notifications: false,
            sound: true,
            widgets: false,
            userData: [],
            search: '',
            singleSelect: false,
            selected: [],
            breadcrumbs: [
                {
                    text: 'Գլխավոր',
                    disabled: false,
                    href: '/',
                },
                {
                    text: 'Խմբեր',
                    disabled: false,
                    href: '/groups',
                },
                {
                    text: 'Խումբ',
                    disabled: true,
                    href: '',
                },
            ],
            headers: [
                {
                    text: 'Dessert (100g serving)',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Calories', value: 'calories' },
                { text: 'Fat (g)', value: 'fat' },
                { text: 'Carbs (g)', value: 'carbs' },
                { text: 'Protein (g)', value: 'protein' },
                { text: 'Iron (%)', value: 'iron' },
            ],
            desserts: [
                {
                    name: 'Frozen Yogurt',
                    calories: 159,
                    fat: 6.0,
                    carbs: 24,
                    protein: 4.0,
                    iron: '1%',
                },
                {
                    name: 'Ice cream sandwich',
                    calories: 237,
                    fat: 9.0,
                    carbs: 37,
                    protein: 4.3,
                    iron: '1%',
                },
                {
                    name: 'Eclair',
                    calories: 262,
                    fat: 16.0,
                    carbs: 23,
                    protein: 6.0,
                    iron: '7%',
                },
                {
                    name: 'Cupcake',
                    calories: 305,
                    fat: 3.7,
                    carbs: 67,
                    protein: 4.3,
                    iron: '8%',
                },
                {
                    name: 'Gingerbread',
                    calories: 356,
                    fat: 16.0,
                    carbs: 49,
                    protein: 3.9,
                    iron: '16%',
                },
                {
                    name: 'Jelly bean',
                    calories: 375,
                    fat: 0.0,
                    carbs: 94,
                    protein: 0.0,
                    iron: '0%',
                },
                {
                    name: 'Lollipop',
                    calories: 392,
                    fat: 0.2,
                    carbs: 98,
                    protein: 0,
                    iron: '2%',
                },
                {
                    name: 'Honeycomb',
                    calories: 408,
                    fat: 3.2,
                    carbs: 87,
                    protein: 6.5,
                    iron: '45%',
                },
                {
                    name: 'Donut',
                    calories: 452,
                    fat: 25.0,
                    carbs: 51,
                    protein: 4.9,
                    iron: '22%',
                },
                {
                    name: 'KitKat',
                    calories: 518,
                    fat: 26.0,
                    carbs: 65,
                    protein: 7,
                    iron: '6%',
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
    //groups
    .users-wrapper {
        margin-top: 50px;
        .users-content {
            .mailing-right-list {
                .right-list-action {
                    display: flex;
                    justify-content: flex-end;
                    margin: 0 0 20px;
                    .action-btn-content {
                        margin-left: 10px;
                        .send-message {
                            background: #ffffff !important;
                            border: 2px solid #00C853;
                            color: #00C853 !important;
                            &:hover {
                                background: #00C853 !important;
                                color: #ffffff !important;;
                            }
                        }
                        button {
                            text-transform: capitalize;
                            i {
                                margin-left: 5px;
                            }
                        }
                    }
                }
                width: 100%;
                .table-tr {
                    cursor: pointer;
                    .v-input--checkbox{
                        margin-top: 0 !important;
                    }
                    &:hover {
                        background: #43a0474d !important;
                    }
                }
            }
        }
    }

    //mailing dialog
    .v-card {
        overflow: auto;
        overscroll-behavior-x: none;
    }
    .v-card::-webkit-scrollbar{
        display: none !important;
    }
    .message-dialog-content {
        display: flex;
        justify-content: center;
        .write-message-content {
            width: 70%;
        }
        .mailing-field-content {
        margin-top: 20px;
        }
        .mailing-button-field-content {
            margin-top: 20px;
            margin-bottom: 50px;
            display: flex;
            justify-content: flex-end;
        }
    }
    //table action
    .table-action {
        display: flex;
        .action-item {
            &:first-child {
                margin-right: 5px;
                button {
                    background: #ffffff !important;
                    border: 2px solid #ffeb00;
                    color: #ffeb00 !important;
                    &:hover {
                        background: #ffeb00 !important;
                        color: #000000 !important;
                    }
                }
            }
            &:last-child {
                button {
                    background: #ffffff !important;
                    border: 2px solid #F4511E;
                    color: #F4511E !important;
                    &:hover {
                        background: #F4511E !important;
                        color: #ffffff !important;
                    }
                }
            }
            button {
                min-width: auto !important;
                width: 35px !important;
                height: 35px !important;
                border-radius: 50% !important;
                i {
                    font-size: 18px !important;
                }
            }
        }
    }
</style>
