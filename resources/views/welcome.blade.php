<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alpine JS CRUD</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
  <div class="container-fluid mt-5" x-data="postCrud">
    <h2>CRUD with Laravel and Alpine JS</h2>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header text-light bg-primary">
              Create Post Table
          </div>
          <div class="card-body">
            <table class="table">
              <thead class="thead">
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <template x-for="post in posts" :key="index">
                  <tr>
                    <td x-text="post.id"></td>
                    <td x-text="post.title"></td>
                    <td x-text="post.body"></td>
                    <td>
                      <button @click="editData(post)"
                        class="btn btn-info">Edit</button>
                      <button @click="deleteData(post.id)"
                        class="btn btn-danger">Delete</button>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div> 
      <div class="col-4">
        <div class="card">
          <div class="card-header text-light bg-primary">
            <span x-show="addMode">Create Post</span>
            <span x-show="!addMode">Edit Post</span>
          </div>
          <div class="card-body">
            <form @submit.prevent="saveData" x-show="addMode" >
              <div class="form-group">
                <label>Title</label>
                <input x-model="form.title" type="text" class="form-control" placeholder="Enter Title">
                <template x-if="errors.title">
                  <p class="text-danger" x-text="errors.title"></p>
                </template>
              </div>
              <div class="form-group">
                <label>Content</label>
                <input x-model="form.body" type="text" class="form-control" placeholder="Enter Content">
                <template x-if="errors.body">
                  <p class="text-danger" x-text="errors.body"></p>
                </template>           
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
            <form @submit.prevent="updateData" x-show="!addMode">
              <div class="form-group">
                <label>Title</label>
                <input x-model="form.title" type="text" class="form-control" placeholder="Enter Title">
                <template x-if="errors.title">
                  <p class="text-danger" x-text="errors.title"></p>
                </template>
              </div>
              <div class="form-group">
                <label>Content</label>
                <input x-model="form.body" type="text" class="form-control" placeholder="Enter Content">
                <template x-if="errors.body">
                  <p class="text-danger" x-text="errors.body"></p>
                </template>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger" @click="cancelEdit">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
  function postCrud() {
    return {  
      addMode: true,
        form: {
          id: '',
          title: '',
          body: '',
        },
        errors:{},
        posts: [],
        init() {
         this.getData();
        },
        getData() {
          axios.get('/api/post')
          .then(response => {
            this.posts = response.data;
          })
        },
        saveData() {
          this.errors = {}
          axios.post('/api/post', this.form)
          .then(response => {
            this.getData();
            this.form = { 
              title: '', 
              body: '',
            };
          }).catch(error => {
            if (error.response) {
              let errors = error.response.data.errors;
              for (let key in errors) {
                console.log(errors[key])
                this.errors[key] = errors[key][0]
              }
              console.log(this.errors);
            }
          });
        },
        editData(post) {
          this.addMode = false
          this.form.title = post.title
          this.form.body = post.body
          this.form.id = post.id
        },
        updateData() {
          this.errors = {}
          axios.put(`/api/post/${this.form.id}`,this.form)
          .then(response => {
            this.getData()
            this.form = { 
              title: '', 
              body: '' 
            };
          }).catch(error => {
            if (error.response) {
              let errors = error.response.data.errors;
              for (let key in errors) {
                console.log(errors[key])
                this.errors[key] = errors[key][0]
              }
              console.log(this.errors);
            }
          });
        },
        deleteData(id) {
          axios.delete(`/api/post/${id}`)
          .then(response => {
            this.getData();
          })
        },
        cancelEdit(){
          this.resetForm()
        },
        resetForm() {
          this.addMode = true
          this.form.title = ''
          this.form.body = ''
        }
    }
  }
</script>
</body>
</html>