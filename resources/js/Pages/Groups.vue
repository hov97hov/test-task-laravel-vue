<template>
    <v-app>
        <Header/>
        <div class="group-wrapper">
            <div class="container">
                <div class="group-content">
                    <v-breadcrumbs class="breadcrumbs" :items="breadcrumbs"></v-breadcrumbs>
                    <div class="add-group">
                        <v-btn
                            @click="addGroupsDialog = true"
                        >
                            Ավելացնել խումբ
                        </v-btn>
                    </div>
                    <div class="group-items">
                        <div class="group-item" v-for="item in groupsData" :style="`border: 3px solid ${item.color}`">
                            <div class="group-item-header">
                                <div class="group-title">
                                    <a :href="`/group/${item.id}`">
                                        <h3><b>{{item.name}}</b></h3>
                                    </a>
                                </div>
                                <div class="send-group-message">
                                    <v-btn
                                        class="email-btn"
                                        @click="dialog = true"
                                        small
                                    >
                                        <v-icon>mdi-email-outline</v-icon>
                                    </v-btn>
                                    <v-btn
                                        @click="deleteGroupDialog(item.id)"
                                        dark
                                        class="ml-1 delete-btn"
                                        small
                                    >
                                        <v-icon>mdi-close</v-icon>
                                    </v-btn>
                                </div>
                            </div>

                            <div class="group-count">
                                <span>Օգտատերերի քանակ</span>
                                <span>10</span>
                            </div>
                            <div class="group-btn-content">
                                <v-btn
                                    @click="addContactDialog(item.id)"
                                    small
                                    dark
                                    color="green accent-4"
                                >
                                    Ավելացնել օգտատեր խմբում
                                    <v-icon>mdi-plus</v-icon>
                                </v-btn>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--MESSAGE-->
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
                    Ջնջել Խումբը
                </v-card-title>
                <v-card-text>Համոզված եղեք, որ ուզում եք ջնջել խումբը։</v-card-text>
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
                        @click="deleteGroup"
                    >
                        Ջնջել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--ADD GROUPS-->
        <v-dialog
            v-model="addGroupsDialog"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-card-title>
                    <span class="text-h5">Ստեղծել խումբ</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-text-field
                                    v-model="defaultDataGroup.name"
                                    label="Անուն"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                                <p>Ընտրել գույն</p>
                                <v-color-picker
                                    v-model="defaultDataGroup.color"
                                    dot-size="10"
                                    mode="hexa"
                                    swatches-max-height="50"
                                ></v-color-picker>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="red darken-1"
                        text
                        @click="addGroupsDialog = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="createGroup"
                    >
                        Հաստատել
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!--ADD USER GROUP-->
        <v-dialog
            v-model="addUserGroupDialog"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-card-title>
                    <span class="text-h5">Ավելացնել օգտատեր տվյալ խմբում</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-autocomplete
                            v-model="contacts"
                            :disabled="isUpdating"
                            :items="people"
                            filled
                            chips
                            color="blue-grey lighten-2"
                            label="Ընտրել"
                            item-text="name"
                            item-value="id"
                            multiple
                        >
                            <template v-slot:selection="data">
                                <v-chip
                                    v-bind="data.attrs"
                                    :input-value="data.selected"
                                    close
                                    @click="data.select"
                                    @click:close="remove(data.item)"
                                >
                                    <v-avatar left>
                                        <v-img src="/images/user/user.png"></v-img>
                                    </v-avatar>
                                    {{ data.item.name }}
                                </v-chip>
                            </template>
                            <template v-slot:item="data">
                                <template v-if="typeof data.item !== 'object'">
                                    <v-list-item-content v-text="data.item"></v-list-item-content>
                                </template>
                                <template v-else>
                                    <v-list-item-avatar>
                                        <img style="object-fit: cover" src="/images/user/user.png">
                                    </v-list-item-avatar>
                                    <v-list-item-content>
                                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                                    </v-list-item-content>
                                </template>
                            </template>
                        </v-autocomplete>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="red darken-1"
                        text
                        @click="addUserGroupDialog = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="addContactGroup"
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
    name: "home",
    components: {
        Header,
        VueEditor
    },
    data: () => {
        return {
            groupId: '',
            defaultDataGroup: {
                color: '',
                name: '',
            },
            autoUpdate: true,
            contacts: [],
            isUpdating: false,
            name: 'Midnight Crew',
            people: [
                { header: 'Օգտատերեր' },
            ],
            addUserGroupDialog: false,
            dialog: false,
            deleteDialog: false,
            addGroupsDialog: false,
            notifications: false,
            sound: true,
            widgets: false,
            groupsData: [],
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
                    disabled: true,
                    href: '',
                },
            ],
        }
    },
    async created() {
        await this.getGroups()
    },
    methods: {
        remove (item) {
            const index = this.contacts.indexOf(item.id)
            if (index >= 0) this.contacts.splice(index, 1)
        },
        async getGroups() {
           await axios.post(`/api/get-groups`)
                .then(response => {
                    this.groupsData = response.data.groups
                })
                .catch(e => {
                    console.log(e)
                })
        },
        async createGroup() {
            await axios.post(`/api/create-group`, this.defaultDataGroup)
                .then(response => {
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        text: '<i class="fa fa-check-circle" aria-hidden="true"></i> Խումբը ավելացվել է',
                        duration: 1000,
                        speed: 1000
                    })
                    this.getGroups()
                    this.addGroupsDialog = false
                })
                .catch(e => {
                    console.log(e)
                })
        },
        deleteGroupDialog(id) {
            this.groupId = id
            this.deleteDialog = true
        },
        async deleteGroup() {
            await axios.post(`/api/delete-group`, {id:this.groupId})
                .then(response => {
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        text: '<i class="fa fa-check-circle" aria-hidden="true"></i> Խումբը ջնջված է',
                        duration: 1000,
                        speed: 1000
                    })
                    this.getGroups()
                    this.deleteDialog = false
                })
                .catch(e => {
                    console.log(e)
                })
        },
        async getAllContacts() {
            await axios.get(`/api/get-contacts`)
                .then(response => {
                    this.people = response.data.contacts
                })
                .catch(e => {
                    console.log(e)
                })
        },
        async addContactGroup() {
            const formData = new FormData()
            formData.append('contacts', this.contacts)
            formData.append('group_id', this.groupId)

            await axios.post(`/api/add-contact-group`, formData)
                .then(response => {
                    this.$notify({
                        group: 'auth',
                        type: 'success',
                        text: '<i class="fa fa-check-circle" aria-hidden="true"></i> Օգտատերերը ավելացվել են Խմբում',
                        duration: 1000,
                        speed: 1000
                    })
                })
                .catch(e => {
                    console.log(e)
                })
        },
        addContactDialog(id) {
            this.getAllContacts()
            this.groupId = id
            this.addUserGroupDialog = true
        }
    }
}
</script>

<style scoped lang="scss">
    //groups
    .group-wrapper {
        .group-content {
            .add-group {
                margin: 0 0 20px;
                display: flex;
                justify-content: flex-end;
                button {
                    background: #ffffff !important;
                    border: 2px solid #00C853;
                    color: #00C853 !important;
                    text-transform: capitalize;
                    &:hover {
                        background: #00C853 !important;
                        color: #ffffff !important;;
                    }
                }
            }
            margin-top: 50px;
            .group-items {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
                .group-item {
                    display: block;
                    cursor: pointer;
                    margin-bottom: 20px;
                    width: calc(34% - 20px);
                    box-shadow: 0 3px 1px -2px
                    rgb(0 0 0 / 20%), 0 2px 2px 0
                    rgb(0 0 0 / 14%), 0 1px 5px 0
                    rgb(0 0 0 / 12%);
                    padding: 15px;
                    background: #ffffff;
                    .send-group-message {
                        .email-btn {
                            background: #ffffff !important;
                            border: 2px solid #00C853;
                            color: #00C853 !important;
                        }
                        .delete-btn {
                            background: #ffffff !important;
                            border: 2px solid #F4511E;
                            color: #F4511E !important;
                        }
                        button {
                            min-width: auto !important;
                            width: 35px !important;
                            height: 35px !important;
                            border-radius: 50%;
                            i {
                                font-size: 20px !important;
                            }
                        }
                    }
                    .group-btn-content {
                        button {
                            background: #ffffff !important;
                            border: 2px solid #00C853;
                            color: #00C853 !important;
                            &:hover {
                                background: #00C853 !important;
                                color: #ffffff !important;;
                            }
                        }
                    }
                    .group-item-header {
                        display: flex;
                        justify-content: space-between;
                        margin: 0 0 15px;
                        .group-title {
                            width: 50%;
                            word-break: break-word;
                        }
                    }
                    .group-count {
                        margin: 0 0 20px;
                        display: flex;
                        span {
                            margin-right: 5px;
                        }
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

</style>
