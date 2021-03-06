<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alpine JS CRUD</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
  <div class="container-fluid mt-5" x-data="postCrud">
    <h2>CRUD with Laravel and Alpine JS</h2>
    <div class="col-4 p-0 my-3">
      <button class="btn btn-primary" @click="create">Create Post</button>
    </div>
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
            <span x-show="!addMode">Create Post</span>
            <span x-show="addMode">Edit Post</span>
          </div>
          <div class="card-body">
            <form @submit.prevent="addMode ? updateData : saveData">
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
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
  function postCrud() {
    return {  
      addMode: false,
      posts: [],
      form: {
        id: '',
        title: '',
        body: '',
      },
      errors:{},
      init() {
       this.getData();
      },
      getData() {
        axios.get('/api/post')
        .then(response => {
          this.posts = response.data;
        })
      },
      create() {
        this.addMode = false;
        this.resetForm();
      },
      saveData() {
        this.clearError()
        axios.post('/api/post', this.form)
        .then(response => {
          this.getData();
          this.resetForm();
        }).catch(error => {
          if (error.response) {
            let errors = error.response.data.errors;
            for (let key in errors) {
              this.errors[key] = errors[key][0]
            }
          }
        });
      },
      editData(post) {
        this.addMode = true
        this.form.title = post.title
        this.form.body = post.body
        this.form.id = post.id
      },
      updateData() {
        this.clearError()
        axios.put(`/api/post/${this.form.id}`,this.form)
        .then(response => {
          this.getData()
          this.resetForm();
        }).catch(error => {
          if (error.response) {
            let errors = error.response.data.errors;
            for (let key in errors) {
              this.errors[key] = errors[key][0]
            }
          }
        });
      },
      deleteData(id) {
        axios.delete(`/api/post/${id}`)
        .then(response => {
          this.getData();
        })
      },
      resetForm() {
        this.addMode = false
        this.form.title = ''
        this.form.body = ''
      },
      clearError() {
        this.errors = {}
      }
    }
  }
</script>
<script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>