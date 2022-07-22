<template>
    <div>
       <div class="container d-flex justify-content-center">
           <form>
               <div class="mb-3">
                   <label for="title" class="form-label">Title</label>
                   <input
                       v-model="title"
                       type="text"
                       class="form-control"
                       id="title"
                   >
               </div>
               <div class="mb-3">
                   <label for="description" class="form-label">Description</label>
                   <textarea
                       v-model="description"
                       type="text"
                       class="form-control"
                       id="description"
                   ></textarea>
               </div>
               <div class="mb-3">
                   <label for="formFileMultiple" class="form-label">Image</label>
                   <input type="file" id="file" ref="file" @change="onChangeFileUpload()"/>
               </div>
               <a
                   @click="createPost()"
                   class="btn btn-primary mt-3"
               >Submit</a>
           </form>
       </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "CreatePost",
    data: () => {
        return {
           posts: [],
           title: '',
           description: '',
           file: '',
        }
    },
    methods: {
        async createPost() {
            const formData = new FormData()
            formData.append('title', this.title)
            formData.append('description', this.description)
            formData.append('image', this.file)

            try {
               const data =  await axios.post('/save-post', formData)
                if (data.data.status === 200) {
                    alert('Post was created successfully')
                    window.location.href = "/"
                } else  {
                    alert('Error')
                }
            }catch (e) {
                console.log(e)
            }
        },
        onChangeFileUpload(){
            this.file = this.$refs.file.files[0];
        },
    }
}
</script>

<style scoped>
    form {
        width: 50%;
        margin-top: 50px;
    }
</style>
