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
                                    <a href="/register">
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
                                :items="desserts"
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
                                        <td @click="openDialog(item)">
                                            <b>{{item.name}}</b>
                                        </td>
                                        <td>
                                            {{item.calories}}
                                        </td>
                                        <td>
                                            {{item.fat}}
                                        </td>
                                        <td>
                                            {{item.carbs}}
                                        </td>
                                        <td>
                                            {{item.protein}}
                                        </td>
                                        <td>
                                            <div class="table-action">
                                                <div class="action-item">
                                                    <v-btn @click="addMessageArchive = true">
                                                        <v-icon>mdi-package-up</v-icon>
                                                    </v-btn>
                                                </div>
                                                <div class="action-item archive">
                                                    <v-btn @click="deleteMessage = true">
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
                                :items="desserts"
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
                                        <td @click="openDialog(item)">
                                            <b>{{item.name}}</b>
                                        </td>
                                        <td>
                                            {{item.calories}}
                                        </td>
                                        <td>
                                            {{item.fat}}
                                        </td>
                                        <td>
                                            {{item.carbs}}
                                        </td>
                                        <td>
                                           {{item.protein}}
                                        </td>
                                        <td>
                                            <div class="table-action">
                                                <div class="action-item">
                                                    <v-btn @click="addMessageArchive = true">
                                                        <v-icon>mdi-package-up</v-icon>
                                                    </v-btn>
                                                </div>
                                                <div class="action-item archive">
                                                    <v-btn @click="deleteMessage = true">
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
                        @click="deleteMessage = false"
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
                        color="green accent-4"
                        text
                        @click="addMessageArchive = false"
                    >
                        Չեղարկել
                    </v-btn>
                    <v-btn
                        color="deep-orange darken-2"
                        text
                        @click="addMessageArchive = false"
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
                    Lorem ipsum dolor sit amet, semper quis, sapien id natoque elit. Nostra urna at, magna at neque sed sed ante imperdiet, dolor mauris cursus velit, velit non, sem nec. Volutpat sem ridiculus placerat leo, augue in, duis erat proin condimentum in a eget, sed fermentum sed vestibulum varius ac, vestibulum volutpat orci ut elit eget tortor. Ultrices nascetur nulla gravida ante arcu. Pharetra rhoncus morbi ipsum, nunc tempor debitis, ipsum pellentesque, vitae id quam ut mauris dui tempor, aptent non. Quisque turpis. Phasellus quis lectus luctus orci eget rhoncus. Amet donec vestibulum mattis commodo, nulla aliquet, nibh praesent, elementum nulla. Sit lacus pharetra tempus magna neque pellentesque, nulla vel erat.
                    Justo ex quisque nulla accusamus venenatis, sed quis. Nibh phasellus gravida metus in, fusce aenean ut erat commodo eros. Ut turpis, dui integer, nonummy pede placeat nec in sit leo. Faucibus porttitor illo taciti odio, amet viverra scelerisque quis quis et tortor, curabitur morbi a. Enim tempor at, rutrum elit condimentum, amet rutrum vitae tempor torquent nunc. Praesent vestibulum integer maxime felis. Neque aenean quia vitae nostra, tempus elit enim id dui, at egestas pulvinar. Integer libero vestibulum, quis blandit scelerisque mattis fermentum nulla, tortor donec vestibulum dolor amet eget, elit nullam. Aliquam leo phasellus aliquam curabitur metus a, nulla justo mattis duis interdum vel, mollis vitae et id, vestibulum erat ridiculus sit pulvinar justo sed. Vehicula convallis, et nulla wisi, amet vestibulum risus, quam ac egestas.
                    Et vitae, nulla gravida erat scelerisque nullam nunc pellentesque, a dictumst cras augue, purus imperdiet non. Varius montes cursus varius vel tortor, nec leo a qui, magni cras, velit vel consectetuer lobortis vel. Nibh erat et wisi felis leo porttitor, sapien nibh sapien pede mi, sed eget porttitor, repellendus arcu ac quis. Luctus vulputate aut est sem magna, placerat accumsan nunc vestibulum ipsum ac auctor, maecenas lorem in ut nec mauris tortor, doloribus varius sem tortor vestibulum mollis, eleifend tortor felis tempus lacus eu eu. Eleifend vel eu, nullam maecenas mauris nec nunc euismod, tortor porta ridiculus potenti, massa tristique nam magna, et wisi placerat et erat ante. Eget pede erat in facilisis, fermentum venenatis sodales. Ac tortor sociis et non animi tristique, rhoncus malesuada, ut arcu volutpat scelerisque sollicitudin, elit curabitur dui pede purus dolor, integer aenean risus taciti nulla eleifend accumsan. At pulvinar diam parturient, interdum mi velit aliquet et a. Arcu at ac placerat eget justo semper, purus sociis curabitur mi ipsum consequat ut, mollis vestibulum, est ante ornare lacus sem. Neque magna mauris, commodo quisque, praesent semper suscipit lobortis nam. Justo malesuada cursus ac nunc litora nunc. Tellus ac, in lobortis nunc, montes lectus purus fermentum.
                    Ac sit wisi. Sodales aliquam, sed vestibulum nullam arcu sit risus arcu, id luctus vitae lorem nibh, integer nec nullam class cursus mi, purus arcu lectus. Vel ante suscipit volutpat potenti mattis sed, wisi eu placerat aliquam erat, lectus morbi lobortis at assumenda. Consequat neque purus ipsum voluptas odio, netus vestibulum ut nec, suspendisse pellentesque nec enim in. Wisi dictum sed semper a, ipsum erat tellus habitasse est, erat sem ornare, vitae quisque ultricies. Dui sed blandit. Tempor et faucibus justo sed luctus, nec vitae vitae. Nunc nibh pede, ipsum vestibulum aenean leo ante ultricies, nam cras quis sed penatibus amet. In mauris a. Integer metus mauris tortor, et rutrum vestibulum ultricies, ut phasellus in ullamcorper ut mollit, eu justo. Cursus pretium venenatis.
                    Cras pellentesque vel sodales accumsan aenean. Feugiat metus sit nec in aliquet amet, porttitor pretium vulputate massa. Consequat ipsum luctus quisque adipiscing libero. Wisi sollicitudin. Eget vitae ac lobortis, lorem natoque vestibulum et, aliquet faucibus at morbi nibh, vel condimentum. Massa unde orci sed id sed, odio donec congue nec praesent amet. Hymenaeos velit lacus, quis vivamus libero tempus duis, eu nisi eu, ipsum at accumsan pede justo morbi donec, massa et libero sit risus neque tortor. Ut sed sed etiam hendrerit dapibus, quis metus suspendisse nibh.
                    Fringilla tempor felis augue magna. Cum arcu a, id vitae. Pellentesque pharetra in cras sociis adipiscing est. Nibh nec mattis at maecenas, nisl orci aliquam nulla justo egestas venenatis, elementum duis vel porta eros, massa vitae, eligendi imperdiet amet. Nec neque luctus suscipit, justo sem praesent, ut nisl quisque, volutpat torquent wisi tellus aliquam reprehenderit, curabitur cras at quis massa porttitor mauris. Eros sed ultrices. Amet dignissim justo urna feugiat mauris litora, etiam accumsan, lobortis a orci suspendisse. Semper ac mauris, varius bibendum pretium, orci urna nunc ullamcorper auctor, saepe sem integer quam, at feugiat egestas duis. Urna ligula ante. Leo elementum nonummy. Sagittis mauris est in ipsum, nulla amet non justo, proin id potenti platea posuere sit ut, nunc sit erat bibendum. Nibh id auctor, ab nulla vivamus ultrices, posuere morbi nunc tellus gravida vivamus.
                    Mauris nec, facilisi quam fermentum, ut mauris integer, orci tellus tempus diam ut in pellentesque. Wisi faucibus tempor et odio leo diam, eleifend quis integer curabitur sit scelerisque ac, mauris consequat luctus quam penatibus fringilla dis, vitae lacus in, est eu ac tempus. Consectetuer amet ipsum amet dui, sed blandit id sed. Tellus integer, dignissim id pede sodales quis, felis dolorem id mauris orci, orci tempus ut. Nullam hymenaeos. Curabitur in a, tortor ut praesent placerat tincidunt interdum, ac dignissim metus nonummy hendrerit wisi, etiam ut.
                    Semper praesent integer fusce, tortor suspendisse, augue ligula orci ante asperiores ullamcorper. In sit per mi sed sed, mi vestibulum mus nam, morbi mauris neque vitae aliquam proin senectus. Ac amet arcu mollis ante congue elementum, inceptos eget optio quam pellentesque quis lobortis, sollicitudin sed vestibulum sollicitudin, lectus parturient nullam, leo orci ligula ultrices. At tincidunt enim, suspendisse est sit sem ac. Amet tellus molestie est purus magna augue, non etiam et in wisi id. Non commodo, metus lorem facilisi lobortis ac velit, montes neque sed risus consectetuer fringilla dolor. Quam justo et integer aliquam, cursus nulla enim orci, nam cursus adipiscing, integer torquent non, fringilla per maecenas. Libero ipsum sed tellus purus et. Duis molestie placerat erat donec ut. Dolor enim erat massa faucibus ultrices in, ante ultricies orci lacus, libero consectetuer mauris magna feugiat neque dapibus, donec pretium et. Aptent dui, aliquam et et amet nostra ligula.
                    Augue curabitur duis dui volutpat, tempus sed ut pede donec. Interdum luctus, lectus nulla aenean elit, id sit magna, vulputate ultrices pellentesque vel id fermentum morbi. Tortor et. Adipiscing augue lorem cum non lacus, rutrum sodales laoreet duis tortor, modi placerat facilisis et malesuada eros ipsum, vehicula tempus. Ac vivamus amet non aliquam venenatis lectus, sociosqu adipiscing consequat nec arcu odio. Blandit orci nec nec, posuere in pretium, enim ut, consectetuer nullam urna, risus vel. Nullam odio vehicula massa sed, etiam sociis mauris, lacus ullamcorper, libero imperdiet non sodales placerat justo vehicula. Nec morbi imperdiet. Fermentum sem libero iaculis bibendum et eros, eget maecenas non nunc, ad pellentesque. Ut nec diam elementum interdum. Elementum vitae tellus lacus vitae, ipsum phasellus, corporis vehicula in ac sed massa vivamus, rutrum elit, ultricies metus volutpat.
                    Semper wisi et, sollicitudin nunc vestibulum, cursus accumsan nunc pede tempus mi ipsum, ligula sed. Non condimentum ac dolor sit. Mollis eu aliquam, vel mattis mollis massa ut dolor ante, tempus lacinia arcu. Urna vestibulum lorem, nulla fermentum, iaculis ut congue ac vivamus. Nam libero orci, pulvinar nulla, enim pellentesque consectetuer leo, feugiat rhoncus rhoncus vel. Magna sociosqu donec, dictum cursus ullamcorper viverra. Ultricies quis orci lorem, suspendisse ut vestibulum integer, purus sed lorem pulvinar habitasse turpis.
                    +
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="dialog = false"
                    >
                        Disagree
                    </v-btn>
                    <v-btn
                        color="green darken-1"
                        text
                        @click="dialog = false"
                    >
                        Agree
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
        openAllMessages () {
            this.allMessages = true
            this.archive = false
        },
        openArchivedMessages () {
            this.archive = true
            this.allMessages = false
        },
        openDialog(id){
           this.messageDialog = true
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
