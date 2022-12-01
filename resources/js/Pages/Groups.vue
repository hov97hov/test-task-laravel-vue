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
                        <div class="group-item" v-for="item in 20">
                            <div class="group-item-header">
                                <div class="group-title">
                                    <a :href="`/group/${item}`">
                                        <h3><b>Company {{item}}</b></h3>
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
                                        dark
                                        class="ml-1 delete-btn"
                                        @click="deleteDialog = true"
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
                                    @click="addUserGroupDialog = true"
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
                        @click="deleteDialog = false"
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
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                            >
                                <v-text-field
                                    label="Legal first name*"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                            >
                                <v-text-field
                                    label="Legal middle name"
                                    hint="example of helper text only on focus"
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                                md="4"
                            >
                                <v-text-field
                                    label="Legal last name*"
                                    hint="example of persistent helper text"
                                    persistent-hint
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Email*"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Password*"
                                    type="password"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                            >
                                <v-select
                                    :items="['0-17', '18-29', '30-54', '54+']"
                                    label="Age*"
                                    required
                                ></v-select>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                            >
                                <v-autocomplete
                                    :items="['Skiing', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                                    label="Interests"
                                    multiple
                                ></v-autocomplete>
                            </v-col>
                        </v-row>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="addGroupsDialog = false"
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="addGroupsDialog = false"
                    >
                        Save
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
                    <span class="text-h5">Ստեղծել խումբ</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-autocomplete
                            v-model="friends"
                            :disabled="isUpdating"
                            :items="people"
                            filled
                            chips
                            color="blue-grey lighten-2"
                            label="Ընտրել"
                            item-text="name"
                            item-value="name"
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
                                        <v-img :src="data.item.avatar"></v-img>
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
                                        <img :src="data.item.avatar">
                                    </v-list-item-avatar>
                                    <v-list-item-content>
                                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                                        <v-list-item-subtitle v-html="data.item.group"></v-list-item-subtitle>
                                    </v-list-item-content>
                                </template>
                            </template>
                        </v-autocomplete>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="addUserGroupDialog = false"
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="addUserGroupDialog = false"
                    >
                        Save
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
        const srcs = {
            1: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
            2: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
            3: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
            4: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
            5: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
        }
        return {
            //
            autoUpdate: true,
            friends: ['Sandra Adams', 'Britta Holt'],
            isUpdating: false,
            name: 'Midnight Crew',
            people: [
                { header: 'Group 1' },
                { name: 'Sandra Adams', group: 'Group 1', avatar: srcs[1] },
                { name: 'Ali Connors', group: 'Group 1', avatar: srcs[2] },
                { name: 'Trevor Hansen', group: 'Group 1', avatar: srcs[3] },
                { name: 'Tucker Smith', group: 'Group 1', avatar: srcs[2] },
                { divider: true },
                { header: 'Group 2' },
                { name: 'Britta Holt', group: 'Group 2', avatar: srcs[4] },
                { name: 'Jane Smith ', group: 'Group 2', avatar: srcs[5] },
                { name: 'John Smith', group: 'Group 2', avatar: srcs[1] },
                { name: 'Sandra Williams', group: 'Group 2', avatar: srcs[3] },
            ],
            title: 'The summer breeze',
            //
            addUserGroupDialog: false,
            dialog: false,
            deleteDialog: false,
            addGroupsDialog: false,
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
        remove (item) {
            const index = this.friends.indexOf(item.name)
            if (index >= 0) this.friends.splice(index, 1)
        },
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
