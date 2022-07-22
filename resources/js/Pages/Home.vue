<template>
    <div>
        <div class="container">
            <div class="post-btn">
                <a href="/create-post" type="button" class="btn btn-primary">Create post</a>
            </div>
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(item) in this.posts">
                    <td>{{item.title}}</td>
                    <td>{{item.description}}</td>
                    <td>
                        <img :src="item.image" alt="image">
                    </td>
                    <td>
                        <a class="btn btn-primary" href="#" role="button">Details</a>
                        <a class="btn btn-primary" href="#" role="button">Add a comment</a>
                        <a class="btn btn-primary" :href="'/update-post/' + item.id">Update</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "home",
    data: () => {
        return {
            posts: [],
        }
    },
    created() {
        this.getUserData()
    },
    methods: {
        async getUserData() {
            try {
                const response = await axios.post("/get-posts");
                this.posts = response.data
            }
            catch (error) {
                console.log(error);
            }
        }
    }
}
</script>

<style scoped>
    .post-btn {
        display: flex;
        justify-content: flex-end;
        margin: 50px 0;
    }
    table {
        width: 100%;
    }
    .btn-primary {
        background: #0a53be !important;
    }
</style>
