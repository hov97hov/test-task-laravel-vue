<template>
    <v-app>
        <Header/>
        <div class="mailing-wrapper">
            <div class="container">
                <div class="mailing-content">
                    <div class="nailing-left-menu">
                        <div class="menu-header">
                            <div class="write-message">
                                <v-btn
                                    @click="dialog = true"
                                    block
                                    elevation="2"
                                    dark
                                    color="green accent-4"
                                >
                                    <v-icon>mdi-email-edit-outline</v-icon>
                                    Գրել
                                </v-btn>
                            </div>
                            <div class="refresh">
                                <v-btn
                                    block
                                    color="green accent-4"
                                    elevation="2"
                                    @click="updateList"
                                    dark
                                >
                                    <v-icon>mdi-refresh</v-icon>
                                </v-btn>
                            </div>
                        </div>
                        <div class="menu">
                            <ul>
                                <li @click="openAllMessages">
                                    <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                    <span>Նամակներ</span>
                                </li>
                                <li @click="openArchivedMessages">
                                      <span><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
                                      <span>Արխիվ</span>
                                </li>
                                <li>
                                    <a href="/register">
                                        <span><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                        <span>Ավելացնել օգտատեր</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/add-contact">
                                        <span><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                        <span>Ավելացնել կոնտակտ</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mailing-right-list">
                        <div class="right-list-action">
                           <div class="action-btn-content">
                               <v-btn
                                   @click="deleteDialog = true"
                                   color="deep-orange darken-2"
                                   dark
                               >
                                   Ջնջել
                               </v-btn>
                           </div>
                          <div class="action-btn-content">
                              <v-btn
                                  color="teal lighten-1"
                                    dark
                              >
                                  Ավելացնել Արխիվ
                              </v-btn>
                          </div>
                        </div>
                        <v-card v-if="allMessages">
                            <v-card-title>
                                <p class="table-title">Բոլոր նամակները</p>
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
                                :items="allMessagesData"
                                :search="search"
                                :single-select="singleSelect"
                                item-key="name"
                                show-select
                                solo
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
                                                :value="item"
                                                item-value="id"
                                                hide-details
                                                color="green accent-4"
                                            />
                                        </td>
                                        <td @click="openDialog(item.id)">
                                            <b>{{item.message}}</b>
                                        </td>
                                        <td>
                                            {{item.created_at}}
                                        </td>
                                        <td>
                                            <div class="table-action">
                                                <div class="action-item">
                                                    <v-btn @click="addArchiveDialog(item.id)">
                                                        <v-icon>mdi-package-up</v-icon>
                                                    </v-btn>
                                                </div>
                                                <div class="action-item archive">
                                                    <v-btn @click="deleteMessageDialog(item.id)">
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
                        <v-card v-if="archive">
                            <v-card-title>
                                <p class="table-title">Արխիվ</p>
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
                                :items="archiveMessages"
                                :search="search"
                                :single-select="singleSelect"
                                item-key="name"
                                show-select
                                solo
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
                                                :value="item"
                                                item-value="id"
                                                hide-details
                                                color="green accent-4"
                                            />
                                        </td>
                                        <td @click="openDialog(item.id)">
                                            <b>{{item.message}}</b>
                                        </td>
                                        <td>
                                            {{item.created_at}}
                                        </td>
                                        <td>
                                            <div class="table-action">
                                                <div class="action-item">
                                                    <v-btn @click="addActiveDialog(item.id)">
                                                        <v-icon>mdi-arrow-up-bold-circle</v-icon>
                                                    </v-btn>
                                                </div>
                                                <div class="action-item archive">
                                                    <v-btn @click="deleteMessageDialog(item.id)">
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
        <!--DELETE DIALOG-->
        <v-dialog
            v-model="deleteDialog"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Ջնջել նամակները
                </v-card-title>
                <v-card-text>Համոզված եղեք, որ ուզում եք ջնջել նամակները։</v-card-text>
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
                        @click="deleteDialog = false"
                    >
                        Ջնջել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--DELETE MESSAGE-->
        <v-dialog
            v-model="deleteMessage"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Ջնջել նամակը
                </v-card-title>
                <v-card-text>Համոզված եղեք, որ ուզում եք ջնջել նամակը։</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green accent-4"
                        text
                        @click="deleteMessage = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="deep-orange darken-2"
                        text
                        @click="removeMessage"
                    >
                        Ջնջել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--ADD ARCHIVE-->
        <v-dialog
            v-model="addMessageArchive"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Ավելացնել արխիվ
                </v-card-title>
                <v-card-text>Համոզված եղեք, որ ուզում եք ավելացնել արխիվում։</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="red accent-4"
                        text
                        @click="addMessageArchive = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="green darken-2"
                        text
                        @click="addArchive"
                    >
                        Ավելացնել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--ADD ACTIVE-->
        <v-dialog
            v-model="addActiveMessage"
            persistent
            max-width="290"
        >
            <v-card>
                <v-card-title class="text-h5">
                   Հանել արխիվից
                </v-card-title>
                <v-card-text>Համոզված եղեք, որ ուզում եք հանել արխիվից։</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="red accent-4"
                        text
                        @click="addActiveMessage = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="green darken-2"
                        text
                        @click="addActive"
                    >
                        Ավելացնել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--MESSAGE-->
        <v-dialog
            v-model="messageDialog"
            width="600px"
        >
            <v-card>
                <v-card-title>
                    <span class="text-h5">Use Google's location service?</span>
                </v-card-title>
                <v-card-text>
                   fdsfdsfdsfsd
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="messageDialog = false"
                    >
                        Փակել
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
    name: "home",
    components: {
        Header,
        VueEditor
    },
    data: () => {
        return {
            addActiveMessage: false,
            messageDialog: false,
            deleteMessage: false,
            addMessageArchive: false,
            allMessages: true,
            archive: false,
            dialog: false,
            deleteDialog: false,
            notifications: false,
            sound: true,
            widgets: false,
            userData: [],
            search: '',
            singleSelect: false,
            selected: [],
            allMessagesData: [],
            archiveMessages: [],
            oneMessage: [],
            headers: [
                {
                    text: 'Նամակ',
                    align: 'start',
                    sortable: true,
                    value: 'message',
                },
                { text: 'Ամսաթիվ', value: 'created_at' },
                { text: 'Գործողություններ', value: 'iron' },
            ],
        }
    },
    async created() {
        await this.getAllMessages()
    },
    methods: {
         openDialog(id){
            this.messageDialog = true
            this.messageId = id
         },
        async getMessage() {
            await axios.get(`/api/get-message`, {id: this.messageId})
                .then(response => {
                    this.oneMessage = response.data.oneMessage
                })
                .catch(e => {
                    console.log(e)
                })
        },
        openAllMessages () {
            this.allMessages = true
            this.archive = false
        },
        openArchivedMessages () {
            this.getArchiveMessage()
            this.archive = true
            this.allMessages = false
        },
        async getAllMessages() {
           await axios.get(`/api/get-all-messages`)
                .then(response => {
                    this.allMessagesData = response.data.allMessages
                })
                .catch(e => {
                    console.log(e)
                })
        },
        updateList() {
            this.getAllMessages()
        },
        addArchiveDialog(id) {
            this.messageId = id
            this.addMessageArchive = true
        },
        async addArchive() {
            const formData = new FormData()
            formData.append('id', this.messageId)
            formData.append('archived', 0)
            await axios.post(`/api/add-archive-message`, formData)
                .then(response => {
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        text: '<i class="fa fa-check-circle" aria-hidden="true"></i> Օգտատերերը ավելացվել է արխիվում',
                        duration: 1000,
                        speed: 1000
                    })
                    this.addMessageArchive = false
                    this.getAllMessages()
                    this.getArchiveMessage()
                })
                .catch(e => {
                    console.log(e)
                })
        },
        async getArchiveMessage() {
            await axios.get(`/api/get-archive-message`)
                .then(response => {
                    this.archiveMessages = response.data.archiveMessages
                    this.getAllMessages()
                })
                .catch(e => {
                    console.log(e)
                })
        },
        addActiveDialog(id) {
            this.messageId = id
            this.addActiveMessage = true
        },
        async addActive() {
            const formData = new FormData()
            formData.append('id', this.messageId)
            formData.append('archived', 1)
            await axios.post(`/api/add-archive-message`, formData)
                .then(response => {
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        text: '<i class="fa fa-check-circle" aria-hidden="true"></i> Օգտատերերը հեռացվել է արխիվից',
                        duration: 1000,
                        speed: 1000
                    })
                    this.addActiveMessage = false
                    this.getAllMessages()
                    this.getArchiveMessage()
                })
                .catch(e => {
                    console.log(e)
                })
        },
        deleteMessageDialog(id) {
            this.deleteMessage = true
            this.messageId = id
        },
        async removeMessage() {
            await axios.post(`/api/delete-message`, {id:this.messageId})
                .then(response => {
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        text: '<i class="fa fa-check-circle" aria-hidden="true"></i> Օգտատերերը ջնջված է',
                        duration: 1000,
                        speed: 1000
                    })
                    this.deleteMessage = false
                    this.getAllMessages()
                    this.getArchiveMessage()
                })
                .catch(e => {
                    console.log(e)
                })
        },
    }
}
</script>

<style scoped lang="scss">
    .mailing-wrapper {
        .mailing-content {
            display: flex;
            margin: 50px 0;
            .nailing-left-menu {
                margin-right: 20px;
                width: 350px;
                .menu-header {
                    margin: 0 0 15px;
                    button {
                        width: 100%;
                        height: 36px;
                        border: 1px solid #ffce0b;
                        border-radius: 3px;
                        font-size: 16px;
                    }
                    display: flex;
                    .write-message {
                        button {
                            text-transform: capitalize;
                        }
                       span {
                          i {
                                margin-right: 5px;
                           }
                       }
                        width: 80%;
                        margin-right: 10px;
                    }
                    .refresh {
                        width: 20%;
                    }
                }
                .menu {
                    ul {
                        li {
                            span {
                                &:first-child {
                                    margin-right: 5px;
                                }
                            }
                            padding: 5px 8px;
                            background: #E8EBEC;
                            margin: 0 0 5px;
                            border-radius: 3px;
                            cursor: pointer;
                            &:hover {
                                background: #D1D3D3FF;
                            }
                            span {
                                cursor: pointer;
                            }
                            a {
                                display: block;
                                color: #000000;
                                span {
                                    &:first-child {
                                        margin-right: 5px;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            .mailing-right-list {
                .right-list-action {
                    display: flex;
                    justify-content: flex-end;
                    margin: 0 0 20px;
                    .action-btn-content {
                        margin-left: 10px;
                        button {
                            text-transform: capitalize;
                        }
                    }
                }
                .table-title {
                    margin-right: 20px;
                    margin-bottom: 0;
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
                    border: 2px solid #26A69A;
                    color: #26A69A !important;
                    &:hover {
                        background: #26A69A !important;
                        color: #ffffff !important;
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
