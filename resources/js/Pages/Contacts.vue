<template>
    <v-app>
        <Header/>
        <div class="users-wrapper">
               <div class="container">
                   <div class="users-content">
                       <v-breadcrumbs class="breadcrumbs" :items="breadcrumbs"></v-breadcrumbs>
                       <div class="mailing-right-list">
                           <div class="right-list-action">
                               <div class="action-btn-content">
                                   <v-btn
                                       @click="openDeleteContactsDialog"
                                       color="deep-orange darken-2"
                                       dark
                                   >
                                       Ջնջել
                                   </v-btn>
                               </div>
                               <div class="action-btn-content">
                                   <v-btn
                                       @click="dialog = true"
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
                                   :items="contacts"
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
                                           class="table-tr"
                                       >
                                           <td>
                                               <v-checkbox
                                                   :value="item.id"
                                                   item-value="id"
                                                   hide-details
                                                   color="green accent-4"
                                               />
                                           </td>
                                           <td>
                                               <b>{{item.name}}</b>
                                           </td>
                                           <td>
                                               <button>{{item.email}}</button>
                                           </td>
                                           <td>
                                               <button>{{item.created_at}}</button>
                                           </td>
                                           <td>
                                               <div class="table-action">
                                                    <div class="action-item">
                                                        <v-btn @click="openEditDialog(item)">
                                                            <v-icon>mdi-pencil</v-icon>
                                                        </v-btn>
                                                    </div>
                                                   <div class="action-item">
                                                       <v-btn @click="openDeleteDialog(item.id)">
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
        <!--DELETE CONTACT-->
        <v-dialog
            v-model="deleteDialog"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Ջնջել օգտատիրոջը
                </v-card-title>
                <v-card-text>Համոզված եղեք, որ ուզում եք ջնջել օգտատիրոջը։</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green accent-4"
                        text
                        @click="deleteDialog = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="deep-orange darken-2"
                        text
                        @click="deleteContact"
                    >
                        Ջնջել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--DELETE CONTACTS-->
        <v-dialog
            v-model="deleteContactsModal"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Ջնջել օգտատերերին
                </v-card-title>
                <v-card-text>Համոզված եղեք, որ ուզում եք ջնջել օգտատերերին։</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green accent-4"
                        text
                        @click="deleteContactsModal = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="deep-orange darken-2"
                        text
                        @click="deleteContacts"
                    >
                        Ջնջել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--EDIT CONTACT-->
        <v-dialog
            v-model="editContactDialog"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-card-title>
                    <span class="text-h5">Թարմացնել օգտատիրոջը</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="defaultEditData.name"
                                    label="Անուն"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="defaultEditData.email"
                                    label="Էլ․ Փոստ"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="red darken-1"
                        text
                        @click="editContactDialog = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="updateContact"
                    >
                        Հաստատել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--NOTIFICATION-->
        <notifications group="auth"/>
    </v-app>
</template>

<script>
import axios from "axios";
import Header from '../../../resources/js/Components/Header'
import { VueEditor } from "vue2-editor";

export default {
    name: "Contact",
    components: {
        Header,
        VueEditor
    },
    data: () => {
        return {
            dialog: false,
            deleteContactsModal: false,
            deleteDialog: false,
            deleteUser: false,
            editContactDialog: false,
            notifications: false,
            sound: true,
            widgets: false,
            contacts: [],
            search: '',
            singleSelect: false,
            selected: [],
            contactId: '',
            contactIds: [],
            breadcrumbs: [
                {
                    text: 'Գլխավոր',
                    disabled: false,
                    href: '/',
                },
                {
                    text: 'Օգտատերեր',
                    disabled: true,
                    href: '',
                },
            ],
            headers: [
                {
                    text: 'Անուն',
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                { text: 'Էլ․ փոստ', sortable: false, value: 'email' },
                { text: 'Գրանցման ամսաթիվ', sortable: false, value: 'created_at' },
                { text: 'Գործողություն', sortable: false, value: 'iron' },
            ],
            defaultEditData: {}
        }
    },
    async created() {
        await this.getContacts()
    },
    methods: {
        openEditDialog(data) {
            this.contactId = data.id
            this.defaultEditData = data
            this.editContactDialog = true
        },
        openDeleteDialog(id) {
            this.contactId = id
            this.deleteDialog = true
        },
        openDeleteContactsDialog() {
            this.deleteContactsModal = true
        },
        async getContacts() {
           await axios.get(`/api/get-contacts`)
                .then(response => {
                    this.contacts = response.data.contacts
                })
                .catch(e => {
                    console.log(e)
                })
        },
        async updateContact() {
            const formData = new FormData()
            formData.append('id', this.defaultEditData.id)
            formData.append('name', this.defaultEditData.name)
            formData.append('email', this.defaultEditData.email)

            await axios.post(`/api/update-contact`, formData)
                .then(response => {
                    this.getContacts()
                    this.editContactDialog = false
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        text: '<i class="fa fa-check-circle" aria-hidden="true"></i> Օգտատերը թարմացվել է',
                        duration: 1000,
                        speed: 1000
                    })
                })
                .catch(e => {
                    console.log(e)
                })
        },
        async deleteContact() {
            await axios.post(`/api/delete-contact`, {id:this.contactId})
                .then(response => {
                    this.getContacts()
                    this.deleteDialog = false
                })
                .catch(e => {
                    console.log(e)
                })
        },
        async deleteContacts() {
            await axios.post(`/api/delete-contacts`, {ids: this.contactIds})
                .then(response => {
                    this.getContacts()
                    this.deleteDialog = false
                })
                .catch(e => {
                    console.log(e)
                })
        },
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

</style>
